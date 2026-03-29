<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Player;
use App\Models\SiteSetting;

class ShowcaseController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::first();
        $players = Player::with('user')->has('user')->paginate(12);
        return view('showcase.index', compact('players', 'settings'));
    }
}
