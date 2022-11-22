<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemCategories extends Model
{
    use HasFactory;

    protected $table = 'system_categories';
    protected $guarded = ['id'];

    public function systemUpdate() 
    {
        return $this->hasMany(SystemUpdate::class, 'category_id', 'id');
    }
}
