<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Models\FormField;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function create()
    {
        $customFields = FormField::where('form_type', 'trial')->orderBy('order')->get();
        return view('registration.create', compact('customFields'));
    }

    public function direct()
    {
        $customFields = FormField::where('form_type', 'trial')->orderBy('order')->get();
        $isDirect = true;
        return view('registration.create', compact('customFields', 'isDirect'));
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:5|max:25',
            'position' => 'required|string',
            'contact_number' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'trial_date' => 'required|date|after:today',
        ];

        $customFields = FormField::where('form_type', 'trial')->get();
        foreach($customFields as $field) {
            if($field->is_required) {
                $rules['custom_' . $field->field_name] = 'required';
            }
        }

        $validated = $request->validate($rules);

        $customData = [];
        foreach($customFields as $field) {
            $key = 'custom_' . $field->field_name;
            if($request->has($key)) {
                $customData[$field->field_name] = $request->input($key);
            }
        }

        Registration::create(array_merge($validated, ['custom_fields' => $customData]));

        return back()->with('success', 'Registration submitted successfully!');
    }

    public function storeDirect(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:5|max:25',
            'position' => 'required|string',
            'contact_number' => 'required|string',
            'email' => 'required|email|unique:users,email',
        ];

        $customFields = FormField::where('form_type', 'trial')->get();
        foreach($customFields as $field) {
            if($field->is_required) {
                $rules['custom_' . $field->field_name] = 'required';
            }
        }

        $validated = $request->validate($rules);

        $customData = [];
        foreach($customFields as $field) {
            $key = 'custom_' . $field->field_name;
            if($request->has($key)) {
                $customData[$field->field_name] = $request->input($key);
            }
        }

        $registration = Registration::create(array_merge($validated, [
            'status' => 'approved', 
            'trial_date' => now(),
            'custom_fields' => $customData
        ]));

        // Auto-create user and player
        $password = $registration->contact_number;
        $user = \App\Models\User::create([
            'name' => $registration->name,
            'email' => $registration->email,
            'password' => \Illuminate\Support\Facades\Hash::make($password),
            'role' => 'player',
        ]);

        \App\Models\Player::create([
            'user_id' => $user->id,
            'age' => $registration->age,
            'position' => $registration->position,
            'stats' => ['speed' => 50, 'dribbling' => 50, 'shooting' => 50, 'passing' => 50],
        ]);

        return back()->with('success', 'Registration complete! You can now log in with your email and phone number as password.');
    }
}
