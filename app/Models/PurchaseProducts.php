<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseProducts extends Model
{
    use HasFactory;

    protected $table = "purchase_products";
    protected $guarded = ['id'];

    public function getProduct()
    {
        return $this->belongsTo(Products::class, 'product_id', 'id');
        // return $this->belongsTo('App\Models\Product', 'product_id');
        
    }

    public function getOrder()
    {
        return $this->belongsTo(PurchaseOrder::class, 'purchase_id' , 'id');
    }
}
