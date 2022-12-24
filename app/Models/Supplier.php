<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $table = 'suppliers';
    protected $guarded = ['id'];
    
    public function purchaseOrder()
    {
        return $this->hasMany(PurchaseOrder::class, 'supplier_id', 'id');
        // return $this->belongsTo('App\Models\Product', 'product_id');
    }
}
