<?php

namespace App\Models;

use App\Traits\RatingTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, RatingTrait;

    protected $fillable = [
        'name',
        'image',
        'price',
        'description',
        'type_id',
        'quantity'
    ];
    protected $appends = ['rating'];
    public function getRatingAttribute(){
        return $this->ratings()->average('rating_value');
    }

    public function offers() {
        return $this->morphMany(Offer::class, 'offerable');
    }

    public function ratings() {
        return $this->morphMany(Rating::class, 'ratingable');
    }

    public function type() {
        return $this->belongsTo(Type::class, 'type_id');
    }

    public function favourites() {
        return $this->belongsToMany(User::class, 'favourits','product_id','user_id')->withTimestamps();
    }
}
