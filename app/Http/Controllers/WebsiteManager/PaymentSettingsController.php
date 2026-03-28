<?php

namespace App\Http\Controllers\WebsiteManager;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class PaymentSettingsController extends Controller
{
    public function update(Request $request)
    {
        $settings = SiteSetting::first();
        $data = $request->validate([
            'paystack_public_key' => 'nullable|string|max:255',
            'paystack_secret_key' => 'nullable|string|max:255',
        ]);

        $settings->update($data);
        return back()->with('success', 'Paystack keys updated successfully!');
    }
}
