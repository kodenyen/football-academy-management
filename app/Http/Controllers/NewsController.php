<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        $settings = SiteSetting::first();
        
        // Fetch recent posts for sidebar
        $recentPosts = Post::where('id', '!=', $post->id)
            ->latest()
            ->take(5)
            ->get();

        return view('news.show', compact('post', 'settings', 'recentPosts'));
    }
}
