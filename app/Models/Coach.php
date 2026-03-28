<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coach extends Model
{
    protected $fillable = [
        'user_id', 'certification', 'certificate_file', 'experience', 'photo', 'specialization', 'phone', 'custom_fields'
    ];

    protected $casts = [
        'custom_fields' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }}
