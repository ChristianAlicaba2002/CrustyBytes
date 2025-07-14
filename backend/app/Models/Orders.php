<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    
    protected $table = 'orders';
    protected $fillable = [
        'user_id',
        'total_price',
        'status',
        'payment_method',
    ];
}
