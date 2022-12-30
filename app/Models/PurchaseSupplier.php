<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseSupplier extends Model
{
    use HasFactory;
    
    protected $table = 'purchase_suppliers';
    protected $guarded = ['id'];

    public function getSupplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id' , 'id');
    }
}
