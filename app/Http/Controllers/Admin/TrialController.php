<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use Illuminate\Http\Request;

class TrialController extends Controller
{
    public function index()
    {
        $registrations = Registration::latest()->paginate(10);
        return view('admin.trials.index', compact('registrations'));
    }

    public function updateStatus(Request $request, Registration $registration)
    {
        $request->validate(['status' => 'required|in:approved,rejected,pending']);
        $registration->update(['status' => $request->status, 'admin_notes' => $request->notes]);
        return back()->with('success', 'Registration status updated!');
    }
}
