<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $fillable = [
        'name', 'age', 'position', 'contact_number', 'email', 'trial_date', 'status', 'admin_notes', 'custom_fields',
        'registration_type', 'first_name', 'surname', 'middle_name', 'date_of_birth', 'gender', 'address', 'lga',
        'state_of_origin', 'passport_number', 'passport_issuing_date', 'passport_expiry_date', 'passport_photo',
        'player_signature', 'guardian_name', 'guardian_contact', 'guardian_address', 'guardian_signature'
    ];

    protected $casts = [
        'custom_fields' => 'array',
        'date_of_birth' => 'date',
        'trial_date' => 'date',
        'passport_issuing_date' => 'date',
        'passport_expiry_date' => 'date',
    ];
}
