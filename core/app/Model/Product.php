<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	protected $guarded = [];

    public function productcategory(){
        return $this->belongsTo('App\Model\ProductCategory', 'category_id');
    }


    public function productsubcategory(){
        return $this->belongsTo('App\Model\ProductSubCategory','subcategory_id');
    }

    
}
