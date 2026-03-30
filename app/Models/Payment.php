<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'user_id',
        'email',
        'amount',
        'reference',
        'status',
        'payment_type',
        'payment_data',
    ];

    protected $casts = [
        'payment_data' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
