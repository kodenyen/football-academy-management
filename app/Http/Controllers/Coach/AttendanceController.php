<?php

namespace App\Http\Controllers\Coach;

use App\Http\Controllers\Controller;
use App\Models\Player;
use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        $players = Player::with('user')->get();
        return view('coach.attendance.index', compact('players'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'attendance' => 'required|array',
        ]);

        foreach ($request->attendance as $playerId => $status) {
            Attendance::updateOrCreate(
                ['player_id' => $playerId, 'date' => $request->date],
                ['status' => $status]
            );
        }

        return back()->with('success', 'Attendance marked successfully!');
    }
}
