<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $table = 'attendance';

    protected $fillable = [
        'player_id',
        'date',
        'status',
    ];

    public function player()
    {
        return $this->belongsTo(Player::class);
    }
}
