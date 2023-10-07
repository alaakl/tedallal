<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
      'name', 'store_id'
    ];
//    protected $with = ['types'];

    public function types() {
        return $this
            ->hasMany(Type::class, 'category_id');
    }

    public function store() {
        return $this->belongsTo(Store::class, 'store_id');
    }
}
