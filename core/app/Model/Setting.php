<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $guarded = [];

    public function language() {
        return $this->belongsTo('App\Model\Language');
    }
}
