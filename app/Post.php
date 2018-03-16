<?php

namespace App;

use App\Model;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\App;
use Laravel\Scout\Searchable;
class Post extends Model
    {
        //    protected $guarded = [];//不可以注入的字段
        //    protected $fillable = ['title','content'];//可以注入数据字段

        //    如果什么都不写 ，对应的表就是posts
        //    如果不对应posts,就要指定他的table属性
        //    protected $table = "post2";
    use searchable;

    //定义索引里的type
    public function searchableAs(){
        return 'post';
    }

    //定义有哪些字段需要搜索
    public function toSearchableArray(){
        return [
          'title' => $this->title,
          'content' => $this->content,
        ];

    }
    //关联用户Eloquent ORM模型关联
    public function user(){
        return $this->belongsTo('App\User');
      }
    //评论模型  绑定后可以使用Post 来获取 Comment了  PostController里withCount用到了
    public function comments(){
        //asc是指定列按升序排列，desc则是指定列按降序排列
        return $this->hasMany('App\Comment')->orderBy('created_at','desc');
    }
        //TODO：看一下zan和zans具体使用时的区别？ 在postController里withCount用的是comments和zans，页面中直接用zans_count获取到
    //和赞、用户关联  文章对某用户而言是否有赞
    public function zan($user_id){
        //一篇文章和一个用户只能产生一个赞
        return $this->hasOne('App\Zan')->where('user_id',$user_id);
    }
    //文章总赞数  PostController里withCount用到了
    public function zans(){
        return $this->hasMany('App\Zan');
    }

    // 文章专题模型绑定
    public function postTopics(){
        return $this->hasMany(\App\PostTopic::class,'post_id','id');
        //一个文章有很多  文章本身与专题的关系
    }

    // 属于某个作者的文章
    public function scopeAuthorBy(Builder $query, $user_id){
        return $query->where('user_id',$user_id);
    }

    // 不属于某个专题的文章
    public function scopeTopicNotBy(Builder $query, $topic_id){
        return $query->doesntHave('postTopics','and',function ($q) use ($topic_id){
            $q->where('topic_id',$topic_id);
            //laravel的doesntHave函数，搜索publish function doesntHave可以看到定义的地方， 第一个参数传一个关系postTopics（上面几行模型绑定的函数名），第二个参数and，第三个参数callback函数
            //use ($topic_id) 是php的语法，匿名函数里用到了这个参数要用use的方法传进去
        });
    }
}
