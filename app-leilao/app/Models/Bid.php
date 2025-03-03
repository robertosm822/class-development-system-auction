<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    use HasFactory;
    protected $fillable = [
        'seller_id',
        'announcement_id',
        'amount',
        'status_bid',
        'price_initial',
        'price_incremental',
        'price_now_bid',
        'time_expiration'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function announcement()
    {
        return $this->belongsTo(Annoucement::class);
    }
}
