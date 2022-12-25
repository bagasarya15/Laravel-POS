<?php

namespace App\Models;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PurchaseOrder extends Model
{
    use HasFactory;
    
    protected $table = 'purchase_orders';
    protected $guarded = ['id'];

    public function getCreatedAtAttribute()
    {
        return \Carbon\Carbon::parse($this->attributes['created_at'])
            ->translatedFormat('d F Y G:i');
    }

    public function productOrder()
    {
        return $this->hasMany(PurchaseProducts::class, 'purchase_id', 'id');
    }

    public function getSupplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }
}
