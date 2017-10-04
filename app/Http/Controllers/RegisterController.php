<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index(){
        //TODO: 和PostController里的view写的不一样
        return view('register.index');
    }

    public function register(){
        return ;
    }
}
