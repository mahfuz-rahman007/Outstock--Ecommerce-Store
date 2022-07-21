<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $guarded = [];

    public function setting() {
        return $this->hasOne('App\Model\Setting');
    }

    public function sectiontitle() {
        return $this->hasOne('App\Model\Sectiontitle');
    }

}
