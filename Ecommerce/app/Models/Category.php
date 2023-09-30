<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table='categories';
    protected $fillable=[
        'cat_name',
        'cat_discription',
        'cat_image',
    ];
    use HasFactory;
 
}
