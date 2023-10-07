<?php

namespace App\Models;

 use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'phone_number',
        'email',
        'role_id',
        'password',
        'gender'
    ];


    protected $hidden = [
        'email',
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function addresses()
    {
        return $this->hasMany(Address::class, 'user_id');
    }


    public function favourites() {
        return $this->belongsToMany(Product::class, 'favourits','user_id','product_id')->as('user_id')->withTimestamps();
    }

    public function code() {
        return $this->hasOne(OptCode::class, 'user_id');
    }

    public function role() {
        return $this->belongsTo(roles::class, 'role_id');
    }



}
