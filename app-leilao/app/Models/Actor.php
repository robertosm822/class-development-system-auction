<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    use HasFactory;

    protected $table =  'actioneers';

    protected $fillable = [
        'user_id',
        'full_name',
        'phone'
    ];
}
