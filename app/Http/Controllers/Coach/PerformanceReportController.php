<?php

namespace App\Http\Controllers\Coach;

use App\Http\Controllers\Controller;
use App\Models\Player;
use App\Models\PerformanceReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerformanceReportController extends Controller
{
    public function create()
    {
        $players = Player::with('user')->get();
        return view('coach.reports.create', compact('players'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'player_id' => 'required|exists:players,id',
            'date' => 'required|date',
            'rating' => 'required|integer|min:1|max:10',
            'feedback' => 'nullable|string',
            'metrics' => 'nullable|array',
        ]);

        $report = PerformanceReport::create([
            'player_id' => $request->player_id,
            'coach_id' => Auth::id(),
            'date' => $request->date,
            'rating' => $request->rating,
            'feedback' => $request->feedback,
            'detailed_metrics' => $request->metrics,
        ]);

        // Sync player's core stats based on this report
        if ($request->has('metrics')) {
            $player = Player::find($request->player_id);
            $newStats = [];
            foreach ($request->metrics as $key => $value) {
                // Convert 1-10 rating to 1-100 percentage
                $newStats[$key] = (int)$value * 10;
            }
            
            // Merge with existing stats or just overwrite with latest
            $player->stats = array_merge($player->stats ?? [
                'speed' => 50, 'dribbling' => 50, 'shooting' => 50, 'passing' => 50
            ], $newStats);
            $player->save();
        }

        return back()->with('success', 'Performance report uploaded and player stats updated!');
    }
}
