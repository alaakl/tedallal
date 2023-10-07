<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use App\Models\User;
use App\Models\Product;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Favourit extends Pivot
{
    use HasApiTokens, HasFactory, Notifiable;
    public $incrementing = true;
    public $table = 'favourits';
    protected $fillable = [
        'user_id', 'product_id'
      ];


    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

}
