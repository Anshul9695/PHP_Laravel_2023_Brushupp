<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comments extends Model
{
    use HasFactory;
    protected $table='comments';
    protected $fillable=[
        'c_name',
        'c_email',
        'comment',
        'blog_id'
    ];
}
