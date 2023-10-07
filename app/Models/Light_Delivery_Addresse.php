<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Light_Delivery_Addresse extends Model
{
    use HasFactory;
    public $table = 'light_delivery_addresses';

    protected $fillable = [
        'city' ,
        'street' ,
        'block' ,
        'building' ,
        'floor' ,
        'site',
        'type',
        'longitude',
        'latitude',
    ];

    // public function items() {
    //     return $this
    //         ->hasMany(Item::class, 'user_id');
    // }

}
