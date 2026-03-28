<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\MatchFixture;
use App\Models\SiteSetting;
use App\Models\HeroSlider;
use App\Models\AcademyProgram;

class HomeController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::first() ?? SiteSetting::create();
        $sliders = HeroSlider::where('is_active', true)->orderBy('order')->get();
        $programs = AcademyProgram::orderBy('order')->get();
        $posts = Post::latest()->take(3)->get();
        $upcomingMatches = MatchFixture::where('status', 'scheduled')->orderBy('match_date')->take(3)->get();
        
        return view('welcome', compact('settings', 'sliders', 'programs', 'posts', 'upcomingMatches'));
    }
}
