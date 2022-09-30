<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsCategory extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function products() 
    {
        return $this->hasMany(Products::class, 'category_id', 'id');
    }
}
