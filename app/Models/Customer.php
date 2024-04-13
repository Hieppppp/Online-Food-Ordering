<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'phone_num',
        'password',
        'conf_pass',
        'email_verified',
        'verified',
        'image',
        'status'
    ];

    protected $primaryKey = 'customer_id';

    protected $hidden =[
        'password',
        'remember_token',
    ];

    public function getPictureAttribute($value){
        if($value){
            return asset('/images/users/customer'.$value);
        }
        else{
            return asset('/images/users/default-avatar.png');
        }
    }
}
