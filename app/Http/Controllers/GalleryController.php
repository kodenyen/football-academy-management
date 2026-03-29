<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Gallery;
use App\Models\SiteSetting;

class GalleryController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::first();
        $items = Gallery::latest()->paginate(12);
        return view('gallery.index', compact('items', 'settings'));
    }
}
