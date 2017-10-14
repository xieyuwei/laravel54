<?php

namespace App;

use App\Model;


class Post extends Model
    {
        //    protected $guarded = [];//不可以注入的字段
        //    protected $fillable = ['title','content'];//可以注入数据字段

        //    如果什么都不写 ，对应的表就是posts
        //    如果不对应posts,就要指定他的table属性
        //    protected $table = "post2";

    //关联用户Eloquent ORM模型关联
        //    TODO: 下面的评论模型完成了一对多和一对多反向，为什么这个不需要相互关联呢？
    public function user(){
        return $this->belongsTo('App\User');
      }
    //评论模型  绑定后可以使用Post 来获取 Comment了
    public function comments(){
        //asc是指定列按升序排列，desc则是指定列按降序排列
        return $this->hasMany('App\Comment')->orderBy('created_at','desc');
    }
        //TODO：看一下zan和zans具体使用时的区别
    //和赞、用户关联  文章对某用户而言是否有赞
    public function zan($user_id){
        //一篇文章和一个用户只能产生一个赞
        return $this->hasOne(\App\Zan::class)->where('user_id',$user_id);
    }
    //文章总赞数
    public function zans(){
        return $this->hasMany(\App\Zan::class);
    }
}
