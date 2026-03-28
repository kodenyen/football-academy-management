<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coach extends Model
{
    protected $fillable = [
        'user_id', 'certification', 'certificate_file', 'experience', 'photo', 'specialization', 'phone'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }}
