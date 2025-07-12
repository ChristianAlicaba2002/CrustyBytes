<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'name',
        'description',
        'category',
        'size',
        'price',
        'image',
        'is_available',
    ];
}
