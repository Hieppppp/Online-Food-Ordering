<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'blog_id',
        'blogdetail_name',
        'blogdetail_content',
        'blogdetail_detail',
        'blogdetail_image',
        'blogdetail_status',
        'added_on',
    ];


    protected $primaryKey = 'blogdetail_id';
}
