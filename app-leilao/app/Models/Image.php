<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'announcement_id',
        'name_archive',
        'url_archive'
    ];

     // Relacionamento correto com Announcement
     public function announcement(): BelongsTo
     {
         return $this->belongsTo(Annoucement::class, 'announcement_id', 'id');
     }
}
