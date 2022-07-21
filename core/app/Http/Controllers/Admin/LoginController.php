<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(){
        return view('admin.login');
    }

    public function authenticate(Request $request){


        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);


        if(Auth::guard('admin')->attempt(['username' => $request->username,'password' => $request->password])){

            return redirect()->route('admin.dashboard');
            // return view('admin.dashboard');
        }
        return redirect()->back()->with('alert', 'Username and password not matched');
    }

    public function logout() {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
      }

}
