<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;
use App\Models\BlogDetail;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'blogdetail_id',
        'prent_id',
        'comment',
    ];

    protected $primaryKey = 'id';

    protected $table ='comments';

    public function customer(){
        return $this->belongsTo(Customer::class,'customer_id');
    }

    public function blogdetail(){
        return $this->belongsTo(BlogDetail::class);
    }

    // public function replies(){
    //     return $this->hasMany(Comment::class,'prent_id');
    // }



}
