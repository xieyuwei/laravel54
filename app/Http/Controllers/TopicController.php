<?php

namespace App\Http\Controllers;

use App\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TopicController extends Controller
{
    //
    public function show(Topic $topic){
        // 传递带文章数的专题
        $topic = Topic::withCount('postTopics')->find($topic->id);
        // withCount必须在queryBuilder里  然后relations postTopics是Topic model里写到的

        // 专题的文章列表  按创建时间倒序排列前10
        $posts = $topic->posts()->orderBy('created_at','desc')->take(10)->get();

        // 属于我的文章  但是未投稿
        $myposts = \App\Post::authorBy(\Auth::id())->topicNotBy($topic->id)->get();
        return view('topic.show',compact('topic','posts','myposts'));
    }

    public function submit(Topic $topic){
        return;

    }
}
