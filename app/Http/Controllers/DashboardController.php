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
        } else {
            return view('dashboard.player');
        }
    }
}
