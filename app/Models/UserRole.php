<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;
    
    protected $table   = 'user_roles';
    protected $guarded = ['id'];

    public function users() 
    {
        return $this->hasMany(User::class, 'role_id', 'id');
    }
}
