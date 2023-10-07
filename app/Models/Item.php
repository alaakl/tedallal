<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'state_id',
        'user_id',
        'distination_id',
        'source_id',
    ];

    public function user() {
        return $this
            ->belongsTo(User::class, 'user_id');
    }

    public function status() {
        return $this
            ->belongsTo(Light_Delivery_State::class, 'state_id');
    }

    public function distinationAddresse() {
        return $this
            ->belongsTo(Light_Delivery_Addresse::class, 'distination_id');
    }

    public function sourceAddresse() {
        return $this
            ->belongsTo(Light_Delivery_Addresse::class, 'source_id');
    }

    public function images()
    {
        return $this->hasMany(Light_Delivery_Image::class, 'item_id');
    }


}
