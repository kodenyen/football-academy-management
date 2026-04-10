<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function downloadPdf(Player $player)
    {
        $data = [
            'player' => $player->load('user'),
            'stats' => $player->stats ?? ['speed' => 50, 'dribbling' => 50, 'shooting' => 50, 'passing' => 50],
        ];
        
        $pdf = Pdf::loadView('player.pdf', $data);
        return $pdf->download($player->user->name . '_Profile.pdf');
    }

    public function generateQr(Player $player)
    {
        $url = route('showcase', ['player' => $player->id]); // Link to public profile in showcase
        $qrCode = QrCode::create($url);
        $writer = new PngWriter();
        $result = $writer->write($qrCode);
        
        return response($result->getString())->header('Content-Type', 'image/png');
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        
        $data = $request->validate([
            'age' => 'nullable|integer',
            'position' => 'nullable|string|max:255',
            'preferred_foot' => 'nullable|string|max:255',
            'height' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
            'bio' => 'nullable|string',
            'profile_photo' => 'nullable|image|max:2048',
        ]);

        $player = $user->player()->firstOrCreate(['user_id' => $user->id]);

        if ($request->hasFile('profile_photo')) {
            if ($player->profile_photo) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($player->profile_photo);
            }
            $data['profile_photo'] = $request->file('profile_photo')->store('players/photos', 'public');
        }

        $player->update($data);

        return redirect()->back()->with('status', 'player-profile-updated');
    }
}
