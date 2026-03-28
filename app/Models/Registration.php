<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $fillable = [
        'name', 'age', 'position', 'contact_number', 'email', 'trial_date', 'status', 'admin_notes', 'custom_fields'
    ];

    protected $casts = [
        'custom_fields' => 'array',
    ];}
