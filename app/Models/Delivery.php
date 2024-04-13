<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;
    protected $fillable =[
        'delivery_name',
        'delivery_phone',
        'delivery_pass',
        'delivery_status',
        'added_on',
    ];

    protected $primaryKey = 'delivery_id';
}
