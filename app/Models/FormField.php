<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormField extends Model
{
    protected $fillable = [
        'form_type', 'label', 'field_name', 'field_type', 'is_required', 'options', 'order'
    ];

    protected $casts = [
        'options' => 'array',
    ];}
