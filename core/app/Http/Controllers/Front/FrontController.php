<?php

namespace App\Http\Controllers\Front;

use App\Model\Client;
use App\Model\Slider;
use App\Model\Message;
use App\Model\Product;
use App\Model\Setting;
use App\Model\Language;
use App\Model\Dynamicpage;
use App\Model\Emailsetting;
use Illuminate\Http\Request;
use App\Model\ProductCategory;
use App\Model\ProductSubCategory;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Model\Ebanner;

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
        $data['ebanners'] = Ebanner::where('status',1)->get();


        $data['popular_products'] = Product::with('productcategory')
                                            ->whereHas('productcategory', function($q){
                                                $q->where('is_popular', 1);
                                            })->orderBy('id','DESC')->limit(8)->get();

        $data['discount_products'] = Product::where('status', '1')->where('previous_price', '!=', '0')->get();

        $data['clients'] =Client::where('status',1)->get();




       return view('front.index', $data);

    }

    // Change Language
    public function changeLanguage($lang)
    {

        session()->put('lang', $lang);

        app()->setLocale($lang);

        return redirect()->route('front.index');
    }

    // Chnage Currency
        // Change Currency
        public function changeCurrency($currency)
        {
            session()->put('currency', $currency);

            return redirect()->back();
        }

    // Contact Page
    public function contact()
    {
        return view('front.contact');
    }

    // Contact Mesage submit
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

    // Front Daynamic Page Function
    public function front_dynamic_page($slug){
        if (session()->has('lang')) {
            $currlang = Language::where('code', session()->get('lang'))->first();
        } else {
            $currlang = Language::where('is_default', 1)->first();
        }

        $front_daynamic_page = Dynamicpage::where('slug', $slug)->where('language_id', $currlang->id)->firstOrFail();

        return view('front.daynamicpage', compact('front_daynamic_page'));
    }




}
