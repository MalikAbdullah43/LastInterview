<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auth extends Model
{
    protected $fillable = [
    	'email_code',
        'mobile_code',	
        'auth_code',
        'kyc_img',	
        'user_id',
    ];
    
    protected $hidden = [
        'exp_time',	
        'active1',
        'user_id',
    ];

    protected $casts = [
        'exp_time' => 'datetime',
    ];

}
