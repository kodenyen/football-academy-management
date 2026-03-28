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

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:5|max:25',
            'position' => 'required|string',
            'contact_number' => 'required|string',
            'email' => 'nullable|email',
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
                if($field->field_type == 'file' && $request->hasFile($key)) {
                    $customData[$field->field_name] = $request->file($key)->store('registrations', 'public');
                } else {
                    $customData[$field->field_name] = $request->input($key);
                }
            }
        }

        $registration = Registration::create(array_merge($validated, ['custom_fields' => $customData]));

        return back()->with('success', 'Registration submitted successfully!');
    }
}
