<?php

namespace App\Http\Controllers\Front;

use App\Model\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Client;
use App\Model\Emailsetting;
use App\Model\Message;
use App\Model\Product;
use App\Model\ProductCategory;
use App\Model\ProductSubCategory;
use App\Model\Setting;
use App\Model\Slider;
use Illuminate\Support\Facades\DB;

class FrontController extends Controller
{
    public function index()
    {

        if (session()->has('lang')) {
            $currlang = Language::where('code', session()->get('lang'))->first();
        } else {
            $currlang = Language::where('is_default', 1)->first();
        }


        $data['sliders'] = Slider::where('status',1)->where('language_id', $currlang->id)->orderBy('serial_number', 'asc')->get();

        $data['popular_products'] = Product::with('productcategory')
                                            ->whereHas('productcategory', function($q){
                                                $q->where('is_popular', 1);
                                            })->where('language_id', $currlang->id)
                                            ->orderBy('id','DESC')->limit(8)->get();

        $data['discount_products'] = Product::where('status', '1')->where('language_id', $currlang->id)->where('previous_price', '!=', '0')->get();

        $data['clients'] =Client::where('status',1)->get();


       return view('front.index', $data);

    }

    public function contact()
    {
        return view('front.contact');
    }

    public function contactSubmit(Request $request)
    {
        $request->validate([
            "name" => "required:string|max:100",
            "email" => "required|email",
            "subject" => "required:string",
            "message" => "required:string"
        ]);

        $message = new Message();
        $message->name = $request->name;
        $message->email = $request->email;
        $message->subject = $request->subject;
        $message->message = $request->message;

        $message->save();

        $notification = array(
            'messege' => 'Message Sent successfully!',
            'alert' => 'success'
        );
        return redirect()->back()->with('notification', $notification);
    }

    public function newsletter(Request $request)
    {
        $request->validate([
            "email" => "required"
        ]);
    }


}
