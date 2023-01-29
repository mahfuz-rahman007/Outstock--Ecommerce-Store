<?php

namespace App\Http\Controllers\User;

use App\Model\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest', ['except' => ['logout', 'userLogout']]);
    }

    public function showLogin(){
        return view('user.login');
    }

    public function login(Request $request){
        dd($request);
        if(Session::has('link')){
            $redirectUrl = Session::get('link');
            Session::forget('link');
          } else{
            $redirectUrl = route('user.dashboard');
          }


            $request->validate([
                'email'   => 'required|email',
                'password' => 'required',
             ]);


            //  $setting = Setting::first();

            //  if($setting->is_recaptcha == 1){
            //      $messages = [
            //          'g-recaptcha-response.required' => 'Please verify that you are not a robot.',
            //          'g-recaptcha-response.captcha' => 'Captcha error! try again later or contact site admin.',
            //      ];
            //  }

            //  if ($setting->is_recaptcha == 1) {
            //      $rules['g-recaptcha-response'] = 'required|captcha';
            //      $request->validate($rules, $messages);
            //  }



          // Attempt to log the user in
          if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password])) {
            // if successful, then redirect to their intended location

            // Check If Email is verified or not
              if(Auth::guard('web')->user()->email_verified == 'NO')
              {
                Auth::guard('web')->logout();
                return back()->with('error',__('Your Email is not Verified!'));
              }


              return redirect($redirectUrl);
          }
              return back()->with('error',__("Credentials Doesn't Match !"));
    }


}
