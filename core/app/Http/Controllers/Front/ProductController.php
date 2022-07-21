<?php

namespace App\Http\Controllers\Front;

use App\Model\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Product;
use App\Model\ProductCategory;
use App\Model\ProductSubCategory;

class ProductController extends Controller
{
    public function products(Request $request){
        if (session()->has('lang')) {
            $currlang = Language::where('code', session()->get('lang'))->first();
        } else {
            $currlang = Language::where('is_default', 1)->first();
        }

        $min = $request->min;
        $max = $request->max;
        $search = $request->search;

        $psubcategory = ProductSubCategory::where('slug', $request->psubcategory)->exists();

        if($psubcategory){
            $psubcategoryID = ProductSubCategory::where('slug',$request->psubcategory)->first()->id ;
        }else{
            $psubcategoryID = '';
        }

        if($request->type){
            $type = $request->type;
        }else{
            $type='new';
        }

        $data['products'] = Product::where('status', '1')->where('language_id', $currlang->id)
                                    ->when($psubcategoryID , function($query, $psubcategoryID){
                                        return $query->where('subcategory_id',$psubcategoryID);
                                    })
                                    ->when($min , function ($query, $min){
                                        return $query->where('current_price', '>=', $min);
                                    })
                                    ->when($max , function ($query, $max){
                                        return $query->where('current_price', '<=', $max);
                                    })
                                    ->when($search , function ($query, $search){
                                        return $query->where('title', 'LIKE', '%' .  $search. '%');
                                    })
                                    ->when($type , function ($query, $type){
                                        if($type == 'new'){
                                            return $query->orderBy('id','DESC');
                                        }elseif($type == 'old'){
                                            return $query->orderBy('id','ASC');
                                        }elseif($type == 'high_low'){
                                            return $query->orderBy('current_price','DESC');
                                        }elseif($type == 'low_high'){
                                            return $query->orderBy('current_price','ASC');
                                        }

                                    })
                                    ->paginate(12);


        $data['featured_products'] =  Product::where('status', '1')->where('is_featured','1')->where('language_id', $currlang->id)->orderBy('id','DESC')->limit(3)->get();
        $data['categories'] = ProductCategory::where('status', '1')->where('language_id', $currlang->id)->get();


        return view('front.shop', $data);

    }

    public function product_details($slug){

        if (session()->has('lang')) {
            $currlang = Language::where('code', session()->get('lang'))->first();
        } else {
            $currlang = Language::where('is_default', 1)->first();
        }

        $product = Product::where('slug', $slug)->firstOrFail();

        $popular_products = Product::with('productcategory')
                                            ->whereHas('productcategory', function($q){
                                                $q->where('is_popular', 1);
                                            })->where('language_id', $currlang->id)
                                            ->orderBy('id','DESC')->limit(4)->get();


        return view('front.product-details', compact('product','popular_products'));

    }
}
