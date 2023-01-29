<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AdminLoginRequest;

class LoginController extends Controller
{
    public function login(){
        return view('admin.login');
    }

    public function authenticate(AdminLoginRequest $request){

        if(Auth::guard('admin')->attempt(['username' => $request->username,'password' => $request->password])){
            return redirect()->route('admin.dashboard');
        }
        return redirect()->back()->with('alert', 'Username and password not matched');
    }

    public function logout() {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
      }
}
