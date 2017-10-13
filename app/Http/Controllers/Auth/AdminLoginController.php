<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
class AdminLoginController extends Controller
{
    public function index()
    {
    	return view("admin.layout.login");
    }
    public function login(Request $req)
    {
    	$remember=($req->has("remember"))?true:false;
    	if (Auth::attempt(['email' => $req->email, 'password' => $req->password], $remember)) {
    		return redirect('admin/home');
    	}
    	else
    	{
    		return redirect('admin/login')->with('message','Email hoặc mật khẩu không chính xác');
    	}
    }
    public function logout()
    {
    	Auth::logout();
    	return redirect('admin/login');
    }
}
