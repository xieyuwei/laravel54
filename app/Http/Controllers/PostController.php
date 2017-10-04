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
//    依赖注入方式
//    public function index(Illuminate\Http\Request $request){
//      dd($request->all());
//    }
//    门脸模式 (使用根目录下的Request 并且是静态方法 实际上它对应的是config/app.php 中的aliases )
//    public function index(){
//      dd(\Request::all());
//    }
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
        $this->validate(request(),[
            'title'=>'required|string|max:100|min:5',
            'content'=>'required|string|min:10'
        ],[
            'title.min' => '自定义提示，文章标题太短了。'
        ]);
        //逻辑
        $post = Post::create(\request(['title','content']));

        //渲染
        return redirect("/posts");

    }
    // 编辑页面
    public function edit(Post $post){
        return view("post/edit", compact('post'));

    }
    // 编辑逻辑
    public function update(Post $post){
        //验证操作
        $this->validate(request(),[
            'title'=>'required|string|max:100|min:5',
            'content'=>'required|string|min:10'
        ],[
            'title.min' => '自定义提示，文章标题太短了。'
        ]);
        //逻辑
        $post->title=\request('title');
        $post->content=\request('content');
        $post->save();

        //渲染   TODO:为什么这里不需要2个大括号
        return redirect("/posts/{$post->id}");

    }
    // 删除逻辑
    public function delete(Post $post){
        //TODO:用户权限验证
        $post->delete();
        return redirect('/posts');

    }
    // 图片上传
    public function imageUpload(Request $request){
//        dd($request->all());     dd打出来上传文件的名字用于后续操作 (wangEditorH5File)
        //TODO :md5和time是什么意思呢?
        //从请求中拿出wangEditorH5File文件储存在public里并重命名，返回的数据在storage目录下找
        $path = $request->file('wangEditorH5File')->storePublicly(md5(time()));
        return asset('storage/'.$path);

    }

}
