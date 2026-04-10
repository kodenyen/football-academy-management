<?php

namespace App\Http\Controllers;

use App\Models\FundingCampaign;
use App\Models\Payment;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DonationController extends Controller
{
    public function index(Request $request)
    {
        $campaign = null;
        if ($request->campaign) {
            $campaign = FundingCampaign::findOrFail($request->campaign);
        }
        $settings = SiteSetting::first();
        return view('donate.index', compact('campaign', 'settings'));
    }

    public function initialize(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:100',
            'email' => 'required|email',
            'campaign_id' => 'nullable|exists:funding_campaigns,id',
        ]);

        $settings = SiteSetting::first();
        if (!$settings || !$settings->paystack_secret_key) {
            return back()->with('error', 'Payment gateway not configured.');
        }

        $amount = $request->amount * 100; // Paystack amount is in kobo
        $email = $request->email;
        $reference = 'DON-' . time() . '-' . rand(1000, 9999);

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $settings->paystack_secret_key,
            'Content-Type' => 'application/json',
        ])->post('https://api.paystack.co/transaction/initialize', [
            'amount' => $amount,
            'email' => $email,
            'reference' => $reference,
            'callback_url' => route('donate.callback'),
            'metadata' => [
                'campaign_id' => $request->campaign_id,
                'payment_type' => 'donation',
            ]
        ]);

        if ($response->successful()) {
            $data = $response->json();
            
            // Create pending payment record
            Payment::create([
                'user_id' => auth()->id(),
                'email' => $email,
                'amount' => $request->amount,
                'reference' => $reference,
                'status' => 'pending',
                'payment_type' => 'donation',
                'campaign_id' => $request->campaign_id,
            ]);

            return redirect($data['data']['authorization_url']);
        }

        return back()->with('error', 'Could not initialize payment. Please try again.');
    }

    public function callback(Request $request)
    {
        $reference = $request->reference;
        if (!$reference) {
            return redirect()->route('home')->with('error', 'No reference supplied.');
        }

        $settings = SiteSetting::first();
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $settings->paystack_secret_key,
        ])->get("https://api.paystack.co/transaction/verify/{$reference}");

        if ($response->successful()) {
            $data = $response->json();
            if ($data['data']['status'] === 'success') {
                $payment = Payment::where('reference', $reference)->first();
                if ($payment && $payment->status !== 'success') {
                    $payment->update(['status' => 'success']);
                    
                    // Update campaign balance if linked
                    if ($payment->campaign_id) {
                        $campaign = FundingCampaign::find($payment->campaign_id);
                        if ($campaign) {
                            $campaign->increment('current_amount', $payment->amount);
                        }
                    }
                    
                    return redirect()->route('home')->with('success', 'Thank you for your generous donation!');
                }
            }
        }

        return redirect()->route('home')->with('error', 'Payment verification failed.');
    }
}
