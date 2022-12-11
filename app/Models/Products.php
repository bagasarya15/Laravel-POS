<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
   use HasFactory;

   protected $table = 'products';
   protected $guarded = ['id'];

   public function category() 
   {
      return $this->belongsTo(ProductsCategory::class, 'category_id', 'id');
   }

   public function transaction()
   {
      return $this->hasMany(Transaction::class, 'product_id', 'id');
   }

   public function orderProduct()
   {
      return $this->hasMany(OrderProduct::class, 'product_id', 'id');
      // return $this->belongsTo('App\Models\Product', 'product_id');
   }
}
