<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Members extends Model
{
    use HasFactory;

    protected $table = 'Members';
    protected $guarded = ['id'];

    public function orderMember() 
    {
        return $this->hasMany(OrderMember::class, 'member_id', 'id');
    }
}
