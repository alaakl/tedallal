<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Light_Delivery_State extends Model
{
    use HasFactory;

    public $table = 'light_delivery_status';


    protected $fillable = [
        'state',
    ];

}
