<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;
    protected $fillable = [
        'value',
        'offerable_id',
        'offerable_type'
    ];

    public function offerable() {
        return $this->morphTo();
    }
}
