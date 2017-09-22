<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    // 列表
    public function index(){
        return view("post/index");// view有两个参数 第一个参数是模板相对地址 第二个参数是数组，传给模板的变量有哪些

    }
    // 详情页面
    public function show(){
        return view("post/show");

    }
    // 创建页面
    public function create(){
        return;

    }
    // 创建逻辑
    public function store(){
        return;

    }
    // 编辑页面
    public function edit(){
        return;

    }
    // 编辑逻辑
    public function update(){
        return;

    }
    // 删除逻辑
    public function delete(){
        return;

    }
}
