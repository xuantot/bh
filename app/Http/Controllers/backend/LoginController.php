<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Http\Request;

class LoginController extends Controller
{
    function GetLogin(){
        return view('backend.login.login');
    }
    function PostLogin(LoginRequest $r){
        
        if(Auth::attempt(['email' => $r->email, 'password' => $r->password])){
            return redirect('/admin');
        }else{
            return redirect()->back()->withErrors(['email'=>'Email hoặc mật khẩu không chính xác'])->withInput();
        }

    }
    function GetLogout() {
        Auth::logout();
        return redirect('/login');   
    }
}
