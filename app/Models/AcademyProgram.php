<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcademyProgram extends Model
{
    protected $fillable = [
        'name',
        'image',
        'description',
        'training_schedule',
        'order',
    ];
}
