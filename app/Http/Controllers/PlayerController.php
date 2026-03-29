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
}
