<?php

namespace App\Http\Controllers\WebsiteManager;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'file' => 'required|image|max:5120', // Max 5MB
        ]);

        $path = $request->file('file')->store('gallery', 'public');

        Gallery::create([
            'title' => $request->title,
            'file_path' => $path,
            'type' => 'image',
        ]);

        return back()->with('success', 'Image added to gallery!');
    }

    public function destroy(Gallery $gallery)
    {
        if ($gallery->file_path) {
            Storage::disk('public')->delete($gallery->file_path);
        }
        $gallery->delete();
        return back()->with('success', 'Gallery item removed!');
    }
}
