<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $fillable = [
        'user_id', 'age', 'position', 'preferred_foot', 'height', 'weight', 'bio', 'profile_photo', 'stats'
    ];

    protected $casts = [
        'stats' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function performanceReports()
    {
        return $this->hasMany(PerformanceReport::class);
    }}
