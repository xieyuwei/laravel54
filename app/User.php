<?php

namespace App;
//use App\Model 控制器里可以直接使用create方法（例如：register controller）
use App\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    //extends Authenticatable 没有extends Model， 这些$fillable就要加上去
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //用户的文章列表 UserController里withCount用到了
    public function posts(){
        //要填posts表里对应的外键是什么   3个参数 要关联的对象，对象的外键，当前模型的主键
        return $this->hasMany('App\Post','user_id','id');
    }

    //关注我的Fan模型 UserController里withCount用到了
    public function fans(){
        return $this->hasMany('App\Fan','star_id','id');
    }

    //我关注的Fan模型 UserController里withCount用到了
    public function stars(){
        //我关注的。代表我是粉丝。fan_id一定是我当前用户，所以用fayne 画的表可以很好的理解
        return $this->hasMany('App\Fan','fan_id','id');
    }

    //关注某人
    public function doFan($uid){
        $fan = new \App\Fan();
        $fan->star_id = $uid;
        return $this->stars()->save($fan);//因为调用了楼上的stars()方法，从我关注的Fan模型里增加一个保存信息，所以save
    }

    //取消关注
    public function doUnFan($uid){
        $fan = new \App\Fan();
        $fan->star_id = $uid;
        return $this->stars()->delete($fan);
    }

    //当前用户是否被uid关注了
    public function hasFan($uid){
        return $this->fans()->where('fan_id',$uid)->count();
    }

    //当前用户是否关注了uid
    public function hasStar($uid){
        return $this->stars()->where('star_id',$uid)->count();
    }
}
