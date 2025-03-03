<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    use HasFactory;
    protected $fillable = [
        'auction_uuid', 'annoucement_id', 'seller_id', 'auction_name', 'auction_start', 'auction_end', 'status_auction'
    ];

    protected $casts = [
        'auction_start' => 'datetime',
        'auction_end' => 'datetime',
    ];
}
