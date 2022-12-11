<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
   use HasFactory;

   protected $table = 'transactions';
   protected $guarded = ['id'];

   public function products()
   {
      return $this->belongsTo(Products::class, 'product_id' , 'id');
   }
}
