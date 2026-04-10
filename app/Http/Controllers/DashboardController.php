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
            $totalPlayers = \App\Models\Player::count();
            $totalCoaches = \App\Models\Coach::count();
            $pendingTrialsCount = \App\Models\Registration::where('status', 'pending')->count();
            $recentTrials = \App\Models\Registration::latest()->take(5)->get();
            return view('dashboard.admin', compact('totalPlayers', 'totalCoaches', 'pendingTrialsCount', 'recentTrials'));
        } elseif ($user->isCoach()) {
            $fixtures = \App\Models\MatchFixture::where('match_date', '>=', now())
                ->orderBy('match_date', 'asc')
                ->take(3)
                ->get();
            $recentReports = \App\Models\PerformanceReport::with('player.user')
                ->where('coach_id', $user->id)
                ->latest()
                ->take(5)
                ->get();
            return view('dashboard.coach', compact('fixtures', 'recentReports'));
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
