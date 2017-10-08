<?php

namespace App;

use App\Model;


class Post extends Model
{
//    protected $guarded = [];//不可以注入的字段
//    protected $fillable = ['title','content'];//可以注入数据字段
//
//    如果什么都不写 ，对应的表就是posts
//    如果不对应posts,就要指定他的table属性
//    protected $table = "post2";

//    关联用户Eloquent ORM模型关联
//    hasOne外键保存在关联表中   belongsTo外键放置在主表中
    public function user(){
        return $this->belongsTo('App\User');
      }

}
