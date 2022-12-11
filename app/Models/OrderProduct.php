<?php

namespace App\Models;

use App\Models\Products;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderProduct extends Model
{
    use HasFactory;

    protected $table = 'order_products';
    protected $guarded = ['id'];

    public function getProduct()
    {
        return $this->belongsTo(Products::class, 'product_id', 'id');
        // return $this->belongsTo('App\Models\Product', 'product_id');
        
    }
}
