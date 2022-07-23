<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $fillable = [
        'name', 'slug', 'is_popular', 'status',
    ];

    public function productsubcategories(){
      return  $this->hasMany('App\Model\ProductSubCategory', 'category_id');
    }

    public function products(){
        return $this->hasMany('App\Model\Product','category_id');
    }

    public function ebanners(){
        return $this->hasMany('App\Model\Ebanner','pcategory_id');
    }




}
