<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FundingCampaign extends Model
{
    protected $fillable = [
        'title', 'description', 'target_amount', 'current_amount', 'image', 'is_active', 'show_progress'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'show_progress' => 'boolean',
        'target_amount' => 'decimal:2',
        'current_amount' => 'decimal:2',
    ];

    public function getProgressAttribute()
    {
        if (!$this->target_amount || $this->target_amount <= 0) return 0;
        return min(100, round(($this->current_amount / $this->target_amount) * 100));
    }
}
