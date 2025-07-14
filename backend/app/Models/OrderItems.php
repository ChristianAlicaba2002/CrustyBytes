<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    protected $table = 'order_items';
    protected $primaryKey = 'order_item';
    protected $fillable = [
        'order_id',
        'product_id',
        'product_name',
        'size',
        'price',
        'quantity',
        'total_price',
        'product_image',
    ];
}
