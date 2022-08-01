<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PaymentGateway extends Model
{
    protected $fillable = ['title', 'image', 'details', 'subtitle', 'name', 'type', 'information','currency_id', 'status'];
    public $timestamps = false;


    public function convertAutoData(){
        return  json_decode($this->information,true);
    }
    

}
