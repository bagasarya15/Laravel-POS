<?php

namespace App\Models;

use App\Models\Members;
use App\Models\OrderProduct;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $guarded = ['id'];

    public function productOrder()
    {
        return $this->hasMany(OrderProduct::class, 'order_id', 'id');
        
        // return $this->hasMany('App\Models\OrderProduct', 'order_id');
    }

    public function member()
    {
        return $this->belongsTo(Members::class, 'member_id' , 'id');
    }
}
