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

        PerformanceReport::create([
            'player_id' => $request->player_id,
            'coach_id' => Auth::id(),
            'date' => $request->date,
            'rating' => $request->rating,
            'feedback' => $request->feedback,
            'detailed_metrics' => $request->metrics,
        ]);

        return back()->with('success', 'Performance report uploaded!');
    }
}
