<?php

namespace App\Http\Controllers\Front;

use App\Helpers\Helper;
use App\Model\Product;
use App\Model\Language;
use App\Model\ProductReview;
use Illuminate\Http\Request;
use App\Model\ProductCategory;
use App\Model\ProductSubCategory;
use App\Http\Controllers\Controller;
use App\Model\PaymentGateway;
use App\Model\Shipping;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    // shop page
    public function products(Request $request)
    {
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

        $data['products'] = Product::where('status', '1')
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
                                    ->paginate(12)->appends([
                                        'pcategory' => $request->pcategory,
                                        'psubcategory' => $request->psubcategory,
                                        'search' => $request->search,
                                        'min' => $request->min,
                                        'max' => $request->max,
                                        'type' => $request->type,
                                        'rating' => $request->rating
                                    ]);



        $data['featured_products'] =  Product::where('status', '1')->where('is_featured','1')->orderBy('id','DESC')->limit(3)->get();
        $data['categories'] = ProductCategory::where('status', '1')->get();


        return view('front.shop.shop', $data);

    }

    // product details
    public function product_details($slug)
    {

        if (session()->has('lang')) {
            $currlang = Language::where('code', session()->get('lang'))->first();
        } else {
            $currlang = Language::where('is_default', 1)->first();
        }

        $product = Product::where('slug', $slug)->firstOrFail();

        $popular_products = Product::with('productcategory')
                                            ->whereHas('productcategory', function($q){
                                                $q->where('is_popular', 1);
                                            })
                                            ->orderBy('id','DESC')->limit(4)->get();


        $avgrating = ProductReview::where('product_id',$product->id)->avg('rating');

        $rating_count = ProductReview::where('product_id', $product->id)->where('rating', '!=', 'null')->count();

        $reviews = ProductReview::where('product_id', $product->id)->where('comment', '!=', 'null')->get();


        $user_rating = '0';

        if(Auth::user()){
            if(ProductReview::where('user_id', Auth::user()->id)->where('product_id', $product->id)->exists()){
                $rating = ProductReview::where('user_id', Auth::user()->id)->where('product_id', $product->id)->first();
                $user_rating = $rating->rating;
            }
        }


        return view('front.shop.product-details', compact('product','popular_products','rating_count','reviews','user_rating','avgrating'));

    }

    // cart page
    public function cart()
    {
        if(!Auth::user()){
            return redirect(route('user.login'));
        }

        $user_id = Auth::user()->id;

        if(Session::has('cart')){
            if( array_key_exists($user_id, Session::get('cart')) ){
                $cart = Session::get('cart')[$user_id];

            }else{
                $cart = [];
            }
        }else {
            $cart = [];
        }

        return view('front.shop.cart', compact('cart'));
    }

    // add to cart
    public function addToCart($id)
    {
        if(!Auth::user()){
            exit();
        }

        $cart = Session::get('cart');

        if(strpos($id, ',,,') == true){
            $data = explode(',,,', $id);
            $id = $data[0];
            $qty = $data[1];

            $product = Product::findOrFail($id);
            $user_id = Auth::user()->id;

            if(!$product){
                abort(404);
            }

            // check if product is in stock or not
            if(!empty($cart) && array_key_exists($id , $cart[$user_id])){   // check if product exists in cart
                if($product->stock < $cart[$user_id][$id]['qty'] + $qty){
                    $remianing = $product->stock - $cart[$user_id][$id]['qty'];
                    return response()->json(['error' => 'You already added '.$cart[$user_id][$id]['qty'].' product. You can now add only '. $remianing . ' product']);
                }
            }else {  // if product not in cart
                if($product->stock <  $qty){
                    return response()->json(['error' => 'Product out of stock !!']);
                }
            }

            // if cart is empty then this is the first product
            if(!$cart){
                $cart = [
                    $user_id => [
                        $id => [
                            'id' => $product->id,
                            'title' => $product->title,
                            'qty'  => $qty,
                            'price' => $product->current_price,
                            'image' => $product->image
                        ]
                    ]
                ];
                Session::put('cart', $cart);
                return response()->json(['message' => 'Product added to Cart!!']);
            }

            // if cart is not empty then check if this product exists or not then increment the qty
            if(isset($cart[$user_id][$id])){
                $cart[$user_id][$id]['qty'] += $qty;

                Session::put('cart', $cart);
                return response()->json(['message' => 'Product added to Cart again!!']);
            }

            // if item not exist in cart then add to cart with quantity = 1
            $cart[$user_id][$id] = [
                "id" => $product->id,
                "title" => $product->title,
                "qty" => $qty,
                "price" => $product->current_price,
                "image" => $product->image
            ];

            Session::put('cart', $cart);
            return response()->json(['message' => 'Product added to Cart']);

        }else {
            return response()->json(['error' => 'Product Error']);
        }

    }

    // cart header load function
    public function headerCartLoad()
    {

        if(Auth::user()){
            $user_id = Auth::user()->id;

            if(Session::has('cart')){
                if( array_key_exists($user_id, Session::get('cart')) ){
                    $cart = Session::get('cart')[$user_id];

                }else{
                    $cart = [];
                }
            }else {
                $cart = [];
            }

        }

        return view('front.shop.header-cart', compact('cart'));


    }

    // cart qty get
    public function cartQtyGet()
    {
        $user_id = Auth::user()->id;

        if(Session::has('cart')){
            $qty = count(Session::get('cart')[$user_id]);
            return $qty;
        }
    }

    // cart item remove
    public function cartItemRemove($id)
    {
        $user_id = Auth::user()->id;


        if($id){

            $cart = Session::get('cart');

            if(isset($cart[$user_id][$id])){

                unset($cart[$user_id][$id]);

                if(count($cart[$user_id]) == 0 ){
                    unset($cart[$user_id]);
                }

                Session::put('cart', $cart);
            }

            $total = 0;
            $count = 0;
            foreach ($cart[$user_id] as $item) {
                $count += $item['qty'];
                $total += $item['price'] * $item['qty'];
            }

            $round_total = round($total , 2);
            $total = Helper::showCurrencyPrice($round_total);

            return response()->json(['message' => 'Product Removed Successfully!!', 'count' => $count, 'total' => $total]);

        }
    }

    // cart update
    public function cartUpdate(Request $request)
    {

        $user_id = Auth::user()->id;


        if(Session::has('cart')){
            $cart = Session::get('cart');
            if($cart[$user_id]){

                foreach ($request->product_id as $key => $id) {


                    $product = Product::findOrFail($id);

                    if($product->stock < $request->qty[$key]){
                        return response()->json(['error' => $product->title.' Stock Not Available!!']);
                    }

                    if(isset($cart[$user_id][$id])){
                        $cart[$user_id][$id]['qty'] = $request->qty[$key];
                        Session::put('cart', $cart);
                    }

                }

                $total = 0;
                $count = 0;
                foreach ($cart[$user_id] as $item) {
                    $count += $item['qty'];
                    $total += $item['price'] * $item['qty'];
                }

                $round_total = round($total , 2);
                $total = Helper::showCurrencyPrice($round_total);

                return response()->json(['message' => 'Your Cart Updated!!', 'count' => $count, 'total' => $total]);


            }else{
                return response()->json(['error' => 'Cart Not Found!!']);
            }
        }



    }

    // checkout page
    public function checkout()
    {

        if (session()->has('lang')) {
            $currlang = Language::where('code', session()->get('lang'))->first();
        } else {
            $currlang = Language::where('is_default', 1)->first();
        }


        if(!Auth::user()){
            return redirect(route('user.login'));
        }

        $user_id = Auth::user()->id;

        if(Session::has('cart')){
            if( array_key_exists($user_id, Session::get('cart')) ){
                $cart = Session::get('cart')[$user_id];

            }else{

                $notification = array(
                    'messege' => 'Your Cart is empty!',
                    'alert' => 'warning'
                );
                return redirect(route('front.cart'))->with('notification', $notification);

            }
        }else {

            $notification = array(
                'messege' => 'Your Cart is empty!',
                'alert' => 'warning'
            );
            return redirect(route('front.cart'))->with('notification', $notification);

        }


        $shippings = Shipping::where('language_id', $currlang->id)->where('status', '1')->get();

        $payment_gateways = PaymentGateway::where('status', '1')->get();


        return view('front.shop.checkout', compact('cart', 'shippings' , 'payment_gateways'));

    }

    // product checkout
    public function productCheckout(Request $request , $slug){
        
        if (!Auth::user()) {
            return redirect(route('user.login'));
        }

        $product = Product::where('slug', $slug)->first();

        if (!$product) {
            abort(404);
        }

        if ($request->qty) {
            $qty = $request->qty;
        } else {
            $qty = 1;
        }

        $user_id = Auth::user()->id;
        $cart = Session::get('cart');
        $id = $product->id;

        // if cart is empty then this the first product
        if (!($cart)) {
            if($product->stock <  $qty){
                $notification = array(
                    'messege' => 'Product Out of Stock!',
                    'alert' => 'error'
                );
                return redirect()->back()->with('notification', $notification);
            }

            $cart = [
                $user_id => [
                    $id => [
                        'id' => $product->id,
                        'title' => $product->title,
                        'qty'  => $qty,
                        'price' => $product->current_price,
                        'image' => $product->image
                    ]
                ]
            ];

            Session::put('cart', $cart);
            if (!Auth::user()) {
                return redirect(route('user.login'));
            }
            return redirect(route('front.checkout'));
        }

        // if cart not empty then check if this product exist then increment quantity
        if (isset($cart[$user_id][$id])) {

            if($product->stock < $cart[$user_id][$id]['qty'] + $qty){
                $notification = array(
                    'messege' => 'Product Out of Stock!',
                    'alert' => 'error'
                );
                return redirect()->back()->with('notification', $notification);
            }
            $qt = $cart[$user_id][$id]['qty'];
            $cart[$user_id][$id]['qty'] = $qt + $qty;

            Session::put('cart', $cart);

            if (!Auth::user()) {
                return redirect(route('user.login'));
            }

            return redirect(route('front.checkout'));
        }

        if($product->stock <  $qty){
            $notification = array(
                'messege' => 'Product Out of Stock!',
                'alert' => 'error'
            );
            return redirect()->back()->with('notification', $notification);
        }


            // if item not exist in cart then add to cart with quantity = 1
            $cart[$user_id][$id] = [
                "id" => $product->id,
                "title" => $product->title,
                "qty" => $qty,
                "price" => $product->current_price,
                "image" => $product->image
            ];

        Session::put('cart', $cart);

        if (!Auth::user()) {
            return redirect(route('user.login'));
        }

        return redirect(route('front.checkout'));

    }

    public function wishlist()
    {

        if(!Auth::user()){
            return redirect(route('user.login'));
        }

        $user_id = Auth::user()->id;

        if(Session::has('wishlist')){
            if( array_key_exists($user_id, Session::get('wishlist')) ){
                $wishlist = Session::get('wishlist')[$user_id];
            }else{
                $wishlist = [];
            }
        }else {
            $wishlist = [];
        }

        return view('front.shop.wishlist', compact('wishlist'));

    }

    public function addWishlist($slug)
    {

        if (!Auth::user()) {
            return redirect(route('user.login'));
        }

        $product = Product::where('slug', $slug)->first();

        $id = $product->id;

        $user_id = Auth::user()->id;

        $wishlist = Session::get('wishlist');

        if(!$wishlist){

            $wishlist = [
                $user_id => [
                    $id => [
                        'id' => $product->id
                    ]
                ]
            ];

            Session::put('wishlist', $wishlist);
            return response()->json(['message' => 'Product added to Wishlist']);
        }

        // if item not exist in cart then add to cart with quantity = 1
        $wishlist[$user_id][$id] = [
            "id" => $product->id
        ];

        Session::put('wishlist', $wishlist);
        return response()->json(['message' => 'Product added to Wishlist']);

    }



    public function removeWishlist($slug)
    {
        if (!Auth::user()) {
            return redirect(route('user.login'));
        }

        $product = Product::where('slug', $slug)->first();

        $id = $product->id;

        $user_id = Auth::user()->id;

        $wishlist = Session::get('wishlist');


        if(isset($wishlist[$user_id][$id])){

            unset($wishlist[$user_id][$id]);

            if(count($wishlist[$user_id]) == 0 ){
                unset($wishlist[$user_id]);
            }

            Session::put('wishlist', $wishlist);
        }

        $count = count($wishlist[$user_id]);


        return response()->json(['message' => 'Product Removed from  Wishlist!!', 'count'=> $count]);

    }




}
