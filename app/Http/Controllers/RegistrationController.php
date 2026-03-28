<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function create()
    {
        return view('registration.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:5|max:25',
            'position' => 'required|string',
            'contact_number' => 'required|string',
            'email' => 'nullable|email',
            'trial_date' => 'required|date|after:today',
        ]);

        Registration::create($validated);

        return back()->with('success', 'Registration submitted successfully! We will contact you soon.');
    }
}
