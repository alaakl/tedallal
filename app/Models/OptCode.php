<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OptCode extends Model
{
    protected $table = 'otp_codes';
    protected $fillable = [
      'code',
      'user_id'
    ];
    use HasFactory;


}
