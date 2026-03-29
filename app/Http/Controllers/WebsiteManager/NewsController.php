<?php

namespace App\Http\Controllers\WebsiteManager;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->paginate(10);
        return view('website_manager.news.index', compact('posts'));
    }

    public function create()
    {
        return view('website_manager.news.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('news', 'public');
        }

        Post::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . time(),
            'content' => $request->content,
            'category' => $request->category,
            'featured_image' => $imagePath,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('website.news.index')->with('success', 'News post created successfully!');
    }

    public function edit(Post $news)
    {
        return view('website_manager.news.edit', ['post' => $news]);
    }

    public function update(Request $request, Post $news)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($news->featured_image) {
                Storage::disk('public')->delete($news->featured_image);
            }
            $news->featured_image = $request->file('image')->store('news', 'public');
        }

        $news->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . time(),
            'content' => $request->content,
            'category' => $request->category,
        ]);

        return redirect()->route('website.news.index')->with('success', 'News post updated successfully!');
    }

    public function destroy(Post $news)
    {
        if ($news->featured_image) {
            Storage::disk('public')->delete($news->featured_image);
        }
        $news->delete();
        return redirect()->route('website.news.index')->with('success', 'News post deleted!');
    }
}
