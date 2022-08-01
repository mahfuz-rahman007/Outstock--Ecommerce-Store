<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Model\ProductReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductReviewController extends Controller
{
    public function review(Request $request , $id){

        if(!Auth::user()){
            return redirect(route('user.login'));
        }

        if($request->rating){
            $request->validate([
                'rating' => 'required|numeric|between:1,5'
            ]);
        }

        if($request->comment){
            $request->validate([
                'comment' => 'required'
            ]);
        }

        if(ProductReview::where('user_id', Auth::user()->id)->where('product_id', $id)->exists())
        {
            $review = ProductReview::where('user_id', Auth::user()->id)->where('product_id', $id)->first();

            if($request->rating){
                $review->rating = $request->rating;
                $review->save();
            }
            if($request->comment){
                $review->comment = $request->comment;
                $review->save();
            }
            $notification = array(
                'messege' => 'Thanks for your Review!',
                'alert' => 'success'
            );
            return redirect()->back()->with('notification', $notification);

        }else{

            $user_id = Auth::user()->id;
            $product_id = $id;

            $review = new ProductReview();
            $review->user_id = $user_id;
            $review->product_id = $product_id;

            if($request->rating){
                $review->rating = $request->rating;
            }

            if($request->comment){
                $review->comment = $request->comment;
            }

            $review->save();

            $notification = array(
                'messege' => 'Thanks for your Review!',
                'alert' => 'success'
            );
            return redirect()->back()->with('notification', $notification);
        }



    }

}
