<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $table='blogs';
    protected $fillable=[
        'blog_name',
        'blog_title',
        'blog_discription',
        'blog_image'
    ];
}
