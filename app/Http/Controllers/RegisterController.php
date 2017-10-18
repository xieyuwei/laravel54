<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class RegisterController extends Controller
{
    public function index(){
        //TODO: 和PostController里的view写的不一样(两种写法都work)
        return view('register.index');
    }

    public function register(){
        //实际是一个表单提交，往user表里添加信息
        //验证
        $this->validate(request(),[
            'name' =>'required|min:2|max:40|unique:users,name',
            'email' =>'required|unique:users,email|email',
            'password' => 'required|min:5|max:15|confirmed'
        ]);
        //逻辑
        $name = request('name');
        $email = request('email');
        $password = bcrypt(request('password')); //明文加密成密文
        $user = User::create(compact('name','email','password'));
        //渲染
        return redirect()->route('login');
    }
}
