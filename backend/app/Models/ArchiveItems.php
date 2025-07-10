<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArchiveItems extends Model
{

    protected $table = 'archive_items';
     protected $fillable = [
        'product_id',
        'name',
        'description',
        'category',
        'size',
        'price',
        'image',
        'is_available',
    ];
}
