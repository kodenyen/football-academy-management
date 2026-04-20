<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Models\FormField;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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

        Registration::create(array_merge($validated, [
            'registration_type' => 'trial',
            'custom_fields' => $customData
        ]));

        return back()->with('success', 'Registration submitted successfully!');
    }

    public function storeDirect(Request $request)
    {
        $rules = [
            'first_name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|string',
            'address' => 'required|string',
            'lga' => 'required|string',
            'state_of_origin' => 'required|string',
            'position' => 'required|string',
            'contact_number' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'passport_number' => 'nullable|string',
            'passport_issuing_date' => 'nullable|date',
            'passport_expiry_date' => 'nullable|date',
            'passport_photo' => 'required|image|max:2048',
            'guardian_name' => 'required|string',
            'guardian_contact' => 'required|string',
            'guardian_address' => 'required|string',
        ];

        $validated = $request->validate($rules);

        // Calculate age from DOB
        $dob = new \DateTime($request->date_of_birth);
        $now = new \DateTime();
        $age = $now->diff($dob)->y;
        $validated['age'] = $age;

        // Handle Passport Photo
        if ($request->hasFile('passport_photo')) {
            $validated['passport_photo'] = $request->file('passport_photo')->store('passports', 'public');
        }

        // Handle Signatures (Base64 from canvas)
        $validated['player_signature'] = $request->player_signature;
        $validated['guardian_signature'] = $request->guardian_signature;

        $fullName = $request->first_name . ' ' . $request->surname;
        $validated['name'] = $fullName;
        $validated['registration_type'] = 'player';
        $validated['status'] = 'approved';
        $validated['trial_date'] = now();

        $registration = Registration::create($validated);

        // Auto-create user and player
        $password = $registration->contact_number;
        $user = \App\Models\User::create([
            'name' => $fullName,
            'email' => $registration->email,
            'password' => Hash::make($password),
            'role' => 'player',
        ]);

        \App\Models\Player::create([
            'user_id' => $user->id,
            'age' => $registration->age,
            'position' => $registration->position,
            'profile_photo' => $registration->passport_photo,
            'stats' => ['speed' => 50, 'dribbling' => 50, 'shooting' => 50, 'passing' => 50],
        ]);

        return back()->with('success', 'Registration complete! You can now log in with your email and phone number as password.');
    }
}
