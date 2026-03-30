<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroSlider extends Model
{
    protected $fillable = [
        'image_path',
        'heading',
        'sub_heading',
        'order',
        'is_active',
    ];
}
