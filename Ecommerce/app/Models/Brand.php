<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    protected $table = 'brands';
    protected $primaryKey = 'brand_id';
    protected $guarded = ['brand_id']; 
    use HasFactory;
    use SoftDeletes;

    public function setBrandNameAttribute($value){
        $this->attributes['brand_name']=ucwords($value);
    }

    public function setBrandDescriptionAttribute($value){
        $this->attributes['brand_description']=ucwords($value);
    }
    public function getBrandDescriptionAttribute($value){
        return strtoupper($value);
    }
    public function getCreatedAtAttribute($value){
        return date('d-m-y',strtotime($value));
    }
 
}
