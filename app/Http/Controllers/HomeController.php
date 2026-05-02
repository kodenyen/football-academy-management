<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\MatchFixture;
use App\Models\SiteSetting;
use App\Models\HeroSlider;
use App\Models\AcademyProgram;
use App\Models\FundingCampaign;

class HomeController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::first() ?? SiteSetting::create();
        $sliders = HeroSlider::where('is_active', true)->orderBy('order')->get();
        $programs = AcademyProgram::orderBy('order')->get();
        $posts = Post::latest()->take(3)->get();
        $upcomingMatches = MatchFixture::orderBy('match_date', 'desc')->take(3)->get();
        $campaigns = FundingCampaign::where('is_active', true)->latest()->get();
        
        return view('welcome', compact('settings', 'sliders', 'programs', 'posts', 'upcomingMatches', 'campaigns'));
    }
}
