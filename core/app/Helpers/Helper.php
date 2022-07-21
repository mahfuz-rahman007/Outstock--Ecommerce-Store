<?php

namespace App\Helpers;

use App\Model\Currency;
use Illuminate\Support\Facades\Session;


class Helper{


    public static function showCurrencyPrice($price) {


        if (Session::has('currency')){
            $curr = Currency::where('id', session()->get('currency'))->first();
        }
        else
        {
            $curr = Currency::where('is_default', 1)->first();
        }

        $price = round($price * $curr->value, 2);


        return $curr->sign.$price;


    }


    public static function showAdminCurrencyPrice($price) {
        if (Session::has('currency')){
            $curr = Currency::where('id', session()->get('currency'))->first();
        }
        else
        {
            $curr = Currency::where('is_default', 1)->first();
        }
        $price = round($price * $curr->value,2);
        return $curr->sign.$price;
    }


      public static function storePrice($price) {
        if (Session::has('currency')){
            $curr = Currency::where('id', session()->get('currency'))->first();
        }
        else
        {
            $curr = Currency::where('is_default', 1)->first();
        }
        $price = ($price / $curr->value);
        return $price;
    }


    public static function showCurrency()
    {
        if (Session::has('currency')){
            $curr = Currency::where('id', session()->get('currency'))->first();
        }
        else
        {
            $curr = Currency::where('is_default', 1)->first();
        }
        return $curr->sign;
    }

    public static function showCurrencyCode()
    {
        if (Session::has('currency')){
            $curr = Currency::where('id', session()->get('currency'))->first();
        }
        else
        {
            $curr = Currency::where('is_default', 1)->first();
        }
        return $curr->name;
    }

    public static function showCurrencyValue()
    {
        if (Session::has('currency')){
            $curr = Currency::where('id', session()->get('currency'))->first();
        }
        else
        {
            $curr = Currency::where('is_default', 1)->first();
        }
        return $curr->value;
    }


    public static function showPrice($price) {

        if (Session::has('currency')){
            $curr = Currency::where('id', session()->get('currency'))->first();
        }
        else
        {
            $curr = Currency::where('is_default', 1)->first();
        }

        $price = $price * $curr->value;

        return round($price,2);

    }

    public static function showPriceInOrder($price, $value) {
        $price = $price * $value;
        return round($price, 2);
    }

    public static function cartTotal($cart){
        $total = 0;



        foreach ($cart as $key => $product) {
            $total += $product['price'] * $product['qty'];
        }

        if(Session::has('currency')){
            $curr = Currency::findOrFail(Session::get('currency'));
        }else{
            $curr = Currency::where('is_default',1)->first();
        }
        return $total / $curr->value;
    }

    public static function discountPercentage($currentPrice, $previousPrice){

        $divideValue = $currentPrice / $previousPrice;

        $percentage = $divideValue * 100;

        $percentage = round($percentage);

        $discountPercentage = (100 - $percentage).'%';

        return $discountPercentage;

    }

    public static function newProduct($created_at){
        $date = date("Y-m-d");
        $date2 = date("Y-m-d", strtotime($created_at) );
        $date3 = date("Y-m-d", strtotime(' + 1 months'.$date2));

        $result = '';
        if (($date >= $date2) && ($date <= $date3)){
            $result = true;
        }else{
            $result = false;
        }

        return $result;
    }







}


?>
