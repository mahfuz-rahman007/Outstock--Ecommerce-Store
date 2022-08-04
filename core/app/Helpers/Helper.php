<?php

namespace App\Helpers;

use App\Model\Currency;
use App\Model\Product;
use App\Model\ProductReview;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class Helper{


    public static function convertUtf8($value){
        return mb_detect_encoding($value, mb_detect_order(), true) === 'UTF-8' ? $value : mb_convert_encoding($value, 'UTF-8');
    }

    public static function showCurrencyPrice($price) {

        if (Session::has('currency')){
            $curr = Currency::where('id', session()->get('currency'))->first();
        }
        else
        {
            $curr = Currency::where('is_default', 1)->first();
        }

        $price = round($price * $curr->value, 2);

        $price = number_format($price , 2);

        return $curr->sign.' '.$price;

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
        $price = number_format($price , 2);

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

        $price = round($price * $curr->value , 2);

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

        $price = round( $price * $curr->value , 2);

        $price = number_format($price, 2);

        return $price;

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


    public static function isWishlist($id){

        $user_id = Auth::user()->id;

        if(Session::has('wishlist')){
            if( array_key_exists($user_id, Session::get('wishlist')) ){

                if( array_key_exists($id, Session::get('wishlist')[$user_id] ) ){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }else {
            return false;
        }

    }

    public static function hasRating($slug){

        $product = Product::where('slug', $slug)->firstOrFail();


        if($product){
            $ratings = ProductReview::where('product_id', $product->id)->get();
            if($ratings){
               $avgrating = ProductReview::where('product_id',$product->id)->avg('rating');

               return  round($avgrating,1) ;
            } else {
                return false;
            }

        } else {
            return false;
        }


    }

    public static function showOrderPrice($price , $value){

        $price = round( $price * $value , 2);

        $price = number_format($price, 2);

        return $price;
    }





}


?>
