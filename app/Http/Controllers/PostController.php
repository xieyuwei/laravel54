<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Zan;
use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    //  列表
    public function index(){
        //  demoGetLog
        \Log::info('post_index',['data' => 'this is post index']); //现在可以使用log的方法了， 例如info() ,但是log都有哪些方法呢？ 到log provider里找 createLogger Writer然后找到对应的很多方法
        //最后从控制台用命令行tail -f storage/logs/laravel.log 查看 ，一旦访问index页面就会打出log
        $posts = Post::orderBy('created_at','desc')->withCount('comments','zans')->paginate(6);
        return view("post/index", compact('posts'));
        // view有两个参数 第一个参数是模板相对地址 第二个参数是数组，传给模板的变量有哪些
        // compact 创建一个包含变量名和它们的值的数组
    }
    // 详情页面
    public function show(Post $post){
        $post->load('comments');//在控制器里预加载comments 数据库查询的工作不要丢给view层去做
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
        $user_id = \Auth::id();
        $params = array_merge(\request(['title','content']),compact('user_id'));
        $post = Post::create($params);

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
        //验证权限
        $this->authorize('update',$post);
        //逻辑
        $post->title=\request('title');
        $post->content=\request('content');
        $post->save();

        //渲染
        return redirect("/posts/{$post->id}");

    }
    // 删除逻辑
    public function delete(Post $post){
        $this->authorize('delete',$post);
        $post->delete();
        return redirect('/posts');

    }
    // 图片上传
    public function imageUpload(Request $request){
        //  dd($request->all());     dd打出来上传文件的名字用于后续操作 (wangEditorH5File)
        //TODO :md5和time是什么意思呢?
        //从请求中拿出wangEditorH5File文件储存在public里并重命名，返回的数据在storage目录下找
        $path = $request->file('wangEditorH5File')->storePublicly(md5(time()));
        return asset('storage/'.$path);

    }
    //提交评论
    public function comment(Post $post){
        //验证
        $this->validate(request(),[
            'content' => 'required|min:3',
        ]);
        //逻辑
        $comment = new Comment();
        $comment->user_id = Auth::id();
        $comment->content = request('content');
        $post->comments()->save($comment);

        //渲染
        return back();
    }
    //赞
    public function zan(Post $post){
        $param = [
            'user_id' => \Auth::id(),
            'post_id' => $post->id
        ];
        //查找数据库如果有这条数据就查询，没有就创建，不会重复创建数据
        Zan::firstOrCreate($param);
        //TODO:因为是使用get方式，链接的形式，那直接使用back可以回退到上一个页面了？？什么意思？？上面提交评论是post用的也是back函数啊(很奇怪route里写post方法点赞就会报错)
        return back();
    }
    //取消赞
    public function unzan(Post $post){
        //TODO: 这里为什么是把赞 delete了呢？ 看起来像是把文章delete了一样
        $post->zan(Auth::id())->delete();
        return back();

    }

}
