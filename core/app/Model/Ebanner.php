<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Ebanner extends Model
{
    protected $guarded = [];

    public function productcategory(){
        return $this->belongsTo('App\Model\ProductCategory', 'pcategory_id');
    }

}
