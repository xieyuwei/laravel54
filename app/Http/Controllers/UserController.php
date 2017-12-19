<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function setting(){
        return view('user.setting');
    }

    public function settingStore(){
        return ;
    }

    public function show(User $user){
        //首先传递这个人的信息 文章、关注、粉丝数
        $user = User::withCount(['stars','fans','posts'])->find($user->id); //stars , fans , posts这些User模型里写的，想要获取数量必须使用withCount，withCount只能在where语句中使用（querybuilder），例如where、orderBy等等，所以这里重新定义User模型使用find方法就可以用withCount了
        //传递文章列表  不做分页  取创建时间最新的前10条   TODO：可以自己做分页看
        $posts = $user->posts()->orderBy('created_at','desc')->take(10)->get();
        //传递关注列表  我关注的人的信息  关注的人的关注、粉丝、文章数   两级关联了
        $stars = $user->stars();
        $susers = User::whereIn('id',$stars->pluck('star_id'))->withCount(['stars','fans','posts'])->get();
        //传递粉丝列表  我粉丝的人的信息  粉丝的人的关注、粉丝、文章数   两级关联了
        $fans = $user->fans();
        $fusers = User::whereIn('id',$fans->pluck('fan_id'))->withCount(['stars','fans','posts'])->get();

        return view('user.show',compact('user','posts','stars','susers','fans','fusers'));
    }
//关注用户
    public function fan(User $user){
        $me = Auth::user();
        $me->doFan($user->id);
        return [
            'error' => 0,
            'msg' => ''
        ];//使用ajax渲染， 返回一个json给前端
    }
//取消关注
    public function unfan(User $user){
        $me = Auth::user();
        $me->doUnFan($user->id);
        return [
            'error' => 0,
            'msg' => ''
        ];
    }
}
