<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wards extends Model
{
    use HasFactory;
    public $timestamps = false ; // set time to false

    protected $fillable = [
        'name_xaphuongthitran',
        'type',
        'maqh',
    ];
    protected $primaryKey = 'xaid';
    protected $table ='devvn_xaphuongthitran';
}
