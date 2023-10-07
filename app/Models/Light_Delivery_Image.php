<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Light_Delivery_Image extends Model
{
    use HasFactory;
    protected $table = 'light_delivery_images';

    protected $fillable = [
        'url','item_id',
    ];

    public function items() {
        return $this
            ->belongsTo(Item::class, 'item_id');
    }
}
