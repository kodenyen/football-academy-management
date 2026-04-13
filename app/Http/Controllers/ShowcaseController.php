<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Player;
use App\Models\SiteSetting;
use App\Models\ShowcaseVideo;

class ShowcaseController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::first();
        $videos = ShowcaseVideo::with('player.user')
            ->where('is_active', true)
            ->orderBy('order')
            ->get();
            
        return view('showcase.index', compact('videos', 'settings'));
    }
}
