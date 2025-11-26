<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'prod_name',
        'prod_image',
        'parent_category_name',
        'sub_category_name'
    ];
}

