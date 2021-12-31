<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $fillable = [
    	'card_n',
        'cvc',
        'exp_date',
        'user_id',	
    ];

    protected $casts = [
        'exp_date' => 'date',
    ];
    
}
