<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
   use HasFactory;

   protected $guarded = ['id'];

   public function category() 
   {
      return $this->belongsTo(ProductsCategory::class, 'category_id', 'id');
   }

   public function users() 
   {
      return $this->belongsTo(User::class);
   }
}
