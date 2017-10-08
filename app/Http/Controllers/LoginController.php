<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    public function index(){
        return view('login.index');
    }

    public function login(){
        //验证  TODO： 没有实现记住我的功能
        $this->validate(request(),[
            'email'=>'required|email',
            'password'=>'required|min:6|max:15',
            'is_remember'=>'integer'

        ]);
        //逻辑
        $user = request(['email','password']);
        $is_remember = boolval(request('is_remember'));
        if (Auth::attempt($user,$is_remember)){
            return redirect('/posts');
        }
        //渲染
        return Redirect::back()->withErrors('账户名密码不匹配');
    }

    public function logout(){
        Auth::logout();
        return redirect('/login');
    }
}
