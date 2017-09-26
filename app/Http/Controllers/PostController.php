<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    // 列表
    public function index(){
        $posts = Post::orderBy('created_at','desc')->paginate(6);
        return view("post/index", compact('posts'));
        // view有两个参数 第一个参数是模板相对地址 第二个参数是数组，传给模板的变量有哪些
        // compact 创建一个包含变量名和它们的值的数组

    }
    // 详情页面
    public function show(Post $post){
        return view("post/show",compact('post'));

    }
    // 创建页面
    public function create(){
        return view("post/create");

    }
    // 创建逻辑
    public function store(){
        //验证操作

        $post = Post::create(\request(['title','content']));
        dd($post);

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
