<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Player;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TrialController extends Controller
{
    public function index()
    {
        $registrations = Registration::latest()->paginate(10);
        return view('admin.trials.index', compact('registrations'));
    }

    public function updateStatus(Request $request, Registration $registration)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected,pending',
            'notes' => 'nullable|string'
        ]);
        
        $oldStatus = $registration->status;
        $registration->update(['status' => $request->status, 'admin_notes' => $request->notes]);

        // If approved, create user and player profile if not exists
        if ($request->status === 'approved' && $oldStatus !== 'approved') {
            $user = User::where('email', $registration->email)->first();
            
            if (!$user) {
                $password = $registration->contact_number ?? Str::random(10);
                $user = User::create([
                    'name' => $registration->name,
                    'email' => $registration->email,
                    'password' => Hash::make($password),
                    'role' => 'player',
                ]);
            }

            if (!$user->player) {
                Player::create([
                    'user_id' => $user->id,
                    'age' => $registration->age,
                    'position' => $registration->position,
                    'stats' => ['speed' => 50, 'dribbling' => 50, 'shooting' => 50, 'passing' => 50],
                ]);
            }
            
            return back()->with('success', 'Registration approved! User account and player profile have been created. Temporary password: ' . ($registration->contact_number ?? 'randomly generated'));
        }

        return back()->with('success', 'Registration status updated!');
    }
}
