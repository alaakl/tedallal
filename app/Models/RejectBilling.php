<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RejectBilling extends Model
{
    protected $table = 'rejected_billings';
    protected $primaryKey = 'id';
    protected $fillable = [
        'billing_id',
        'cause'
    ];
    use HasFactory;
}
