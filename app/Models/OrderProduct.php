<?php

namespace App\Models;

use App\Models\Products;
use App\Models\Order;
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

    public function getOrder()
    {
        return $this->belongsTo(Order::class, 'order_id' , 'id');
    }
}
