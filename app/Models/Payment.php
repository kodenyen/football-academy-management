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
        'campaign_id',
    ];

    protected $casts = [
        'payment_data' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function campaign()
    {
        return $this->belongsTo(FundingCampaign::class, 'campaign_id');
    }
}
