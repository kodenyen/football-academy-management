<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\SiteSetting;

class ContactController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::first();
        return view('contact', compact('settings'));
    }
}
