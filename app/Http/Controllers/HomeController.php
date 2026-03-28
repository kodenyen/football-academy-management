<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\MatchFixture;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->take(3)->get();
        $upcomingMatches = MatchFixture::where('status', 'scheduled')->orderBy('match_date')->take(3)->get();
        return view('welcome', compact('posts', 'upcomingMatches'));
    }
}
