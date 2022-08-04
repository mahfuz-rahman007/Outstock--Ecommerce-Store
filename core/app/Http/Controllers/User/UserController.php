<?php

namespace App\Http\Controllers\User;

use App\User;
use App\Model\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function dashboard()
    {

        if(!Auth::user()){
            return redirect(route('user.login'));
        }

        $data['orders'] = Order::orderBy('id', 'DESC')->where('user_id', Auth::user()->id)->get();


        return view('user.dashboard', $data);
    }

    public function product_order(){
        if(!Auth::user()){
            return redirect(route('user.login'));
        }
        $data['orders'] = Order::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->get();

        return view('user.product-details', $data);

    }

    public function orderDetails($id){
        if(!Auth::user()){
            return redirect(route('user.login'));
        }

        $data['order'] = Order::findOrFail($id);

        return view('user.order-details', $data);

    }

    public function editProfile()
    {
        if(!Auth::user()){
            return redirect(route('user.login'));
        }

        return view('user.edit-profile');
    }

    public function updateProfile(Request $request, $id)
    {
        if(!Auth::user()){
            return redirect(route('user.login'));
        }

        $user = User::where('id', $id)->first();
        $request->validate([
            'image' => 'mimes:jpeg,jpg,png',
            'name' => 'required:string|max:100',
            "username" => "required:string|max:100|unique:users,username,".$id,
            "email" => "required|email|unique:users,email,".$id,
            'phone'=> 'required|numeric',
            'zipcode'=> 'required|numeric',
            'address'=> 'required|max:150',
            'country'=> 'required|max:50',
            'state'=> 'required|max:50',
            'city'=> 'required|max:50',

        ]);

        if($request->hasFile('image')){
            @unlink('assets/front/img/'. $user->image);
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $image = time().rand().'.'.$extension;
            $file->move('assets/front/img/', $image);

            $user->image = $image;
        }

        $user->name = $request->name;
        $user->username = $request->username;
        $user->phone = $request->phone;
        $user->zipcode = $request->zipcode;
        $user->address = $request->address;
        $user->country = $request->country;
        $user->state = $request->state;
        $user->city = $request->city;

        $user->email = $request->email;
        $user->save();

        $notification = array(
            'messege' => 'Profile Updated successfully!',
            'alert' => 'success'
        );
        return redirect(route('user.editProfile'))->with('notification', $notification);

    }

    public function changePassword()
    {

        if(!Auth::user()){
            return redirect(route('user.login'));
        }

        return view('user.change-password');
    }

    public function updatePassword(Request $request, $id)
    {

        if(!Auth::user()){
            return redirect(route('user.login'));
        }

        $user = User::where('id', $id)->first();

        $messages = [
            'password.required' => 'The new password field is required',
            'password.confirmed' => "Password does'nt match"
        ];

        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'password' => 'required|confirmed'
        ], $messages);

        if(Hash::check($request->old_password, $user->password)) {
            $oldPassMatch = 'matched';
        } else {
            $oldPassMatch = 'not_matched';
        }
        if ($validator->fails() || $oldPassMatch=='not_matched') {
            if($oldPassMatch == 'not_matched') {
              $validator->errors()->add('oldPassMatch', true);
            }
            return redirect()->route('user.changePassword')
                        ->withErrors($validator);
        }

        $user->password = bcrypt($request->password);
        $user->save();

        $notification = array(
            'messege' => 'Password Changed successfully!',
            'alert' => 'success'
        );
        return redirect()->back()->with('notification', $notification);


    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('front.index');
    }

}

