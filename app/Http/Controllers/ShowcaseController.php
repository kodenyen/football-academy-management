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
        $settings = SiteSetting::first() ?? new SiteSetting();
        $videos = ShowcaseVideo::where('is_active', '!=', 0)
            ->orderBy('order', 'asc')
            ->get();
            
        return view('showcase.index', compact('videos', 'settings'));
    }
}
