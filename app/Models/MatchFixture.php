<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MatchFixture extends Model
{
    protected $fillable = [
        'opponent',
        'team_category',
        'match_date',
        'venue',
        'status',
        'our_score',
        'opponent_score',
        'match_summary',
    ];
}
