<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProductSubCategory extends Model
{
    protected $fillable = [
        'name', 'slug', 'status',
    ];

    public function productcategory(){
      return  $this->belongsTo('App\Model\ProductCategory');
    }

    public function products(){
        return $this->hasMany('App\Model\Product','subcategory_id');
    }
}
