<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kyc extends Model
{
    protected $fillable = [
    	'id_image',
        'utility_bill_image',
        'user_id',	
    ];

    protected $casts = [
        'exp_time' => 'datetime',
    ];
}
