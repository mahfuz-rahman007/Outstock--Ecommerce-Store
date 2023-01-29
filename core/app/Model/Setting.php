<?php

namespace App\Model;

use Illuminate\Support\Attribute;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $guarded = [];

    public function language() {
        return $this->belongsTo('App\Model\Language');
    }

    public function setBaseColorAttribute($value){
        $this->attributes['base_color'] = ltrim($value, '#');
    }

}
