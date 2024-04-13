<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'product_name',
        'product_detail',
        'product_image',
        'product_status',
        'added_on',
        'full',
        'full_price',
        'half',
        'half_price',
    ];
    protected $primaryKey = 'product_id';
  

}
