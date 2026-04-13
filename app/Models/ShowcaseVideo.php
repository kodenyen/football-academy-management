<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShowcaseVideo extends Model
{
    protected $fillable = [
        'player_id', 'title', 'position', 'youtube_url', 'video_id', 'order', 'is_active'
    ];

    public function player()
    {
        return $this->belongsTo(Player::class);
    }
}
