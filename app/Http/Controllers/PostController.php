<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    // 列表
    public function index(){
        $posts = [
            ['title' => 'this is title1'],
            ['title' => 'this is title2'],
            ['title' => 'this is title3']
        ];
        return view("post/index", compact('posts'));
        // view有两个参数 第一个参数是模板相对地址 第二个参数是数组，传给模板的变量有哪些
        // compact 创建一个包含变量名和它们的值的数组

    }
    // 详情页面
    public function show(){
        return view("post/show",['title' => "this is title" , 'isShow' => false]);

    }
    // 创建页面
    public function create(){
        return view("post/create");

    }
    // 创建逻辑
    public function store(){
        return;

    }
    // 编辑页面
    public function edit(){
        return view("post/edit");

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
