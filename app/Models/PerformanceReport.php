<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerformanceReport extends Model
{
    protected $fillable = [
        'player_id',
        'coach_id',
        'date',
        'rating',
        'feedback',
        'detailed_metrics',
    ];

    protected $casts = [
        'detailed_metrics' => 'array',
    ];

    public function player()
    {
        return $this->belongsTo(Player::class);
    }

    public function coach()
    {
        return $this->belongsTo(User::class, 'coach_id');
    }
}
