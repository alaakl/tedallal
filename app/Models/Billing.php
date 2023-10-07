<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    use HasFactory;

    protected $fillable = [
        'address_id',
        'delivery_price',
        'total_price',
        'items_price',
        'payment_method_id',
        'status_id',
        'notes'
    ];

    public function paidProducts() {
        return $this->hasMany(PaidProduct::class, 'billing_id');
    }

    public function address() {
        return $this->belongsTo(Address::class, 'address_id');
    }
}
