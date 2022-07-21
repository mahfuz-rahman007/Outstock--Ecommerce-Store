<?php

namespace App\Http\Controllers\User;

use App\User;
use Exception;
use App\Model\Setting;
use App\Model\Emailsetting;
use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['logout', 'userLogout']]);

        $setting = Setting::first();
        Config::set('captcha.sitekey', $setting->google_recaptcha_site_key);
        Config::set('captcha.secret', $setting->google_recaptcha_secret_key);
    }


    public function showRegister(){

        return view('user.register');
    }

    public function register(Request $request){

        $request->validate([
            "name" => "required:string|max:100",
            "username" => "required:string|max:100|unique:users,username",
            "email" => "required|email|unique:users,email",
            "phone" => "required|numeric",
            "address" => "required",
            "country" => "required",
            "state" => "required",
            "city" => "required",
            "zipcode" => "required|numeric|min:4",
            "password" => "required|min:8|confirmed",

        ]);

        $setting = Setting::first();

        if($setting->is_recaptcha == 1){
            $messages = [
                'g-recaptcha-response.required' => 'Please verify that you are not a robot.',
                'g-recaptcha-response.captcha' => 'Captcha error! try again later or contact site admin.',
            ];
        }

        if ($setting->is_recaptcha == 1) {
            $rules['g-recaptcha-response'] = 'required|captcha';
            $request->validate($rules, $messages);
        }


        $user = new User();

        $user->name     = $request->name;
        $user->username = $request->username;
        $user->email    = $request->email;
        $user->phone    = $request->phone;
        $user->address  = $request->address;
        $user->country  = $request->country;
        $user->state    = $request->state;
        $user->city     = $request->city;
        $user->zipcode  = $request->zipcode;
        $user->password = bcrypt($request->password);
        $token          =  md5(time().$request->username.$request->email);
        $user->email_verify_token = $token;
        $user->save();

        $emailsetting = Emailsetting::first();

        if($emailsetting->is_verification_email == 1){

            $mail = new PHPMailer(true);
            if($emailsetting->is_smtp == 1){
                try{
                    $mail->isSMTP();
                    $mail->Host       = $emailsetting->smtp_host;
                    $mail->SMTPAuth   = true;
                    $mail->Username   = $emailsetting->smtp_user;
                    $mail->Password   = $emailsetting->smtp_pass;
                    $mail->SMTPSecure = $emailsetting->email_encryption;
                    $mail->Port       = $emailsetting->smtp_port;

                    //Recipients
                    $mail->setFrom($emailsetting->from_email, $emailsetting->from_name);
                    $mail->addAddress($request->email);

                    $mail->isHTML(true);
                    $mail->Subject = "Verify your Email address.";
                    $mail->Body = "Dear Customer, <br> We noticed that you need to verify your email address. <a href=".route('user.register.token', $token).">Simply click here to verify.</a>";

                    $mail->send();

                    return redirect(route('user.login'))->with('success', __('We need to verify your email address. We have sent an email to'). ' '.$request->email. ' '  .__('to verify your email address. Please click link in that email to continue.'));


                } catch (Exception $e){
                        // die($e->getMessage());
                }
            } else {
                try{
                    //Recipients
                    $mail->setFrom($emailsetting->from_email, $emailsetting->from_name);
                    $mail->addAddress($request->email);

                    $mail->isHTML(true);
                    $mail->Subject = "Verify your Email address.";
                    $mail->Body = "Dear Customer, <br> We noticed that you need to verify your email address. <a href=".route('user.register.token', $token).">Simply click here to verify.</a>";

                    $mail->send();

                    return redirect(route('user.login'))->with('success', __('We need to verify your email address. We have sent an email to'). ' '.$request->email. ' '  .__('to verify your email address. Please click link in that email to continue.'));

                } catch (Exception $e){
                        // die($e->getMessage());
                }
            }
        }


    }

    public function token($token){

        $emailsetting = Emailsetting::first();

        if($emailsetting->is_verification_email == 1)
        {
            $user = User::where('email_verify_token',$token)->first();
            if(isset($user))
            {
                $user->email_verified = 'Yes';
                $user->update();
                Auth::guard('web')->login($user);

                $notification = array(
                'messege' => 'Email Verified Successfully',
                'alert' => 'success'
            );
            return redirect(route('user.dashboard'))->with('notification', $notification);
            }

        }else {
                    return redirect()->back();
        }

    }
}
