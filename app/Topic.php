<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    //属于这个topic的所有posts
    public function posts(){
        return $this->belongsToMany(\App\Post::class,'post_topics','topic_id','post_id');
        //第一个参数：要获取的模型  第二个参数：表post_topics， post和 Topic通过post_topics表关联的，第三个参数：表和当前模型进行关联的外键  第四个参数：表与第一个参数模型（这里是\App\Post）关联的属性
    }

    //属于这个topic的文章数，用于withCount???
    public function postTopics(){
        return $this->hasMany(\App\PostTopic::class,'topic_id');
    }
}
