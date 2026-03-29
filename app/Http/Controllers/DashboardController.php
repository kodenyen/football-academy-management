<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->isAdmin()) {
            return view('dashboard.admin');
        } elseif ($user->isCoach()) {
            return view('dashboard.coach');
        } elseif ($user->isWebsiteManager()) {
            return redirect()->route('website.settings.index');
        } else {
            $player = $user->player;
            $attendances = $player ? $player->attendances()->latest()->take(10)->get()->reverse() : collect();
            $reports = $player ? $player->performanceReports()->latest()->take(5)->get() : collect();
            return view('dashboard.player', compact('player', 'attendances', 'reports'));
        }
    }
}
