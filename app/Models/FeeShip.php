<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\City;
use App\Models\Province;
use App\Models\Wards;

class FeeShip extends Model
{
    use HasFactory;

    public $timestamps = false ; // set time to false

    protected $fillable = [
        'fee_matp',
        'fee_maqh',
        'fee_xaid',
        'fee_feeship',
    ];
    protected $primaryKey = 'fee_id';

    protected $table ='fee_ships';

    public function city(){
        return $this->belongsTo(City::class, 'fee_matp'); 
    }
    
    public function province(){
        return $this->belongsTo(Province::class, 'fee_maqh');
    }
    
    public function wards(){
        return $this->belongsTo(Wards::class, 'fee_xaid');
    }
}
