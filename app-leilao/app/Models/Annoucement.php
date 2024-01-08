<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Annoucement extends Model
{
    use HasFactory;

    protected $fillable = [
        'seller_id',
        'category_id',
        'title',
        'product_bid_increment',
        'product_attribute_condition',
        'product_attribute_mileage',
        'product_attribute_year_fabric',
        'product_attribute_engine',
        'product_attribute_fuel',
        'product_attribute_transmission',
        'product_number_doors',
        'current_price',
        'product_color',
        'define_favorite',
        'description',
        'date_started',
        'date_expiration',
        'status'
    ];

    public function categories()
    {
        return $this->hasMany(Category::class, 'id','category_id');
    }
}
