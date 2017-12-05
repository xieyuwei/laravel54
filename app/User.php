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
}
