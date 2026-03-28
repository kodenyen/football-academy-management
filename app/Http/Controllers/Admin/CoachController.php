<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Coach;
use App\Models\FormField;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class CoachController extends Controller
{
    public function index()
    {
        $coaches = Coach::with('user')->paginate(10);
        return view('admin.coaches.index', compact('coaches'));
    }

    public function create()
    {
        $customFields = FormField::where('form_type', 'coach')->orderBy('order')->get();
        return view('admin.coaches.create', compact('customFields'));
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'certification' => 'nullable|string',
            'experience' => 'nullable|string',
            'specialization' => 'nullable|string',
            'phone' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
            'certificate_file' => 'nullable|file|mimes:pdf,jpg,png,jpeg|max:5120',
        ];

        $customFields = FormField::where('form_type', 'coach')->get();
        foreach($customFields as $field) {
            if($field->is_required) {
                $rules['custom_' . $field->field_name] = 'required';
            }
        }

        $request->validate($rules);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'coach',
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('coaches', 'public');
        }

        $certificatePath = null;
        if ($request->hasFile('certificate_file')) {
            $certificatePath = $request->file('certificate_file')->store('certificates', 'public');
        }

        $customData = [];
        foreach($customFields as $field) {
            $key = 'custom_' . $field->field_name;
            if($request->has($key)) {
                if($field->field_type == 'file' && $request->hasFile($key)) {
                    $customData[$field->field_name] = $request->file($key)->store('coaches/custom', 'public');
                } else {
                    $customData[$field->field_name] = $request->input($key);
                }
            }
        }

        Coach::create([
            'user_id' => $user->id,
            'certification' => $request->certification,
            'certificate_file' => $certificatePath,
            'experience' => $request->experience,
            'specialization' => $request->specialization,
            'phone' => $request->phone,
            'photo' => $photoPath,
            'custom_fields' => $customData,
        ]);

        return redirect()->route('admin.coaches.index')->with('success', 'Coach registered successfully!');
    }

    public function show(Coach $coach)
    {
        return view('admin.coaches.show', compact('coach'));
    }

    public function edit(Coach $coach)
    {
        return view('admin.coaches.edit', compact('coach'));
    }

    public function update(Request $request, Coach $coach)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $coach->user_id,
            'certification' => 'nullable|string',
            'experience' => 'nullable|string',
            'specialization' => 'nullable|string',
            'phone' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
            'certificate_file' => 'nullable|file|mimes:pdf,jpg,png,jpeg|max:5120',
        ]);

        $coach->user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        if ($request->filled('password')) {
            $coach->user->update(['password' => Hash::make($request->password)]);
        }

        if ($request->hasFile('photo')) {
            if ($coach->photo) {
                Storage::disk('public')->delete($coach->photo);
            }
            $coach->photo = $request->file('photo')->store('coaches', 'public');
        }

        if ($request->hasFile('certificate_file')) {
            if ($coach->certificate_file) {
                Storage::disk('public')->delete($coach->certificate_file);
            }
            $coach->certificate_file = $request->file('certificate_file')->store('certificates', 'public');
        }

        $coach->update([
            'certification' => $request->certification,
            'experience' => $request->experience,
            'specialization' => $request->specialization,
            'phone' => $request->phone,
        ]);

        return redirect()->route('admin.coaches.index')->with('success', 'Coach updated successfully!');
    }

    public function destroy(Coach $coach)
    {
        if ($coach->photo) {
            Storage::disk('public')->delete($coach->photo);
        }
        if ($coach->certificate_file) {
            Storage::disk('public')->delete($coach->certificate_file);
        }
        $coach->user->delete(); // This will cascade delete coach profile
        return redirect()->route('admin.coaches.index')->with('success', 'Coach deleted successfully!');
    }
}
