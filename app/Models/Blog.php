<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $fillable = [
        'blog_name',
        'blog_slug',
        'blog_status',
    ];
    protected $primaryKey = 'blog_id';
}
