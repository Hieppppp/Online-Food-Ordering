<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactSettings extends Model
{
    use HasFactory;
    public $timestamps = false ; // set time to false

    protected $fillable = [
        'address',
        'gmap',
        'pn1',
        'pn2',
        'email',
        'fb',
        'insta',
        'tw',
        'iframe',
    ];
    protected $primaryKey = 'id';
    protected $table ='contact_settings';
}
