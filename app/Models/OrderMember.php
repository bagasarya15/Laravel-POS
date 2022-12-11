<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderMember extends Model
{
    use HasFactory;
    protected $table = 'order_members';
    protected $guarded = ['id'];

    public function getMember()
    {
        return $this->belongsTo(Members::class, 'member_id' , 'id');
    }
}
