<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'announcement_id',
        'name_archive',
        'url_archive'
    ];

    public function annoucements()
    {
        return $this->belongsTo(Annoucement::class);
    }
}
