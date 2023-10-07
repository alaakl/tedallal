<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaidProduct extends Model
{
    use HasFactory;
    protected $table = 'paid_products';

    protected $fillable = [
        'name',
        'image',
        'price',
        'description',
        'store',
        'category',
        'type',
        'billing_id',
        'quantity',
    ];
}
