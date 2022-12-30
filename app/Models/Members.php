<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Members extends Model
{
    use HasFactory;

    protected $table = 'members';
    protected $guarded = ['id'];

    public function getCreatedAtAttribute()
    {
        return \Carbon\Carbon::parse($this->attributes['created_at'])
            ->translatedFormat('d F Y');
    }

    public function orderMember() 
    {
        return $this->hasMany(OrderMember::class, 'member_id', 'id');
    }

    public function memberOrder()
    {
        return $this->hasMany(Order::class, 'member_id', 'id');
    }
}
