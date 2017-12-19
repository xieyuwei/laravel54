<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['prefix' => '/'], function () {
    /*
     * Auth
     */
    Route::get('register', ['as' => 'register', 'uses' => 'RegisterController@index']);
    Route::post('register', ['as' => 'register.logic', 'before' => 'csrf', 'uses' => 'RegisterController@register']);

    Route::get('login', ['as' => 'login', 'uses' => 'LoginController@index']);
    Route::post('login', ['as' => 'login.logic', 'before' => 'csrf', 'uses' => 'LoginController@login']);

    Route::group(['middleware' => 'auth'], function () {
        Route::get('logout', ['as' => 'logout', 'uses' => 'LoginController@logout']);
        Route::get('me/setting',['as' => 'me.setting', 'uses' => 'UserController@setting']);
        Route::post('/me/setting',['as' => 'me.setting.logic', 'uses' => 'UserController@settingStore']);
    });
});


Route::group(['prefix' => 'posts','middleware' => 'auth'], function () {
    
    Route::get('/', ['as' => 'posts', 'uses' => 'PostController@index']);
    Route::get('create', ['as' => 'posts.get.create',  'uses' => 'PostController@create']);

    Route::get('search', ['as' => 'search', 'uses' => 'PostController@search']);
    Route::get('{post}', ['as' => 'post.show',  'uses' => 'PostController@show']);

    Route::post('/', ['as' => 'posts.post.create', 'before' => 'csrf', 'uses' => 'PostController@store']);
    Route::get('{post}/edit', ['as' => 'posts.get.edit',  'uses' => 'PostController@edit']);
    Route::put('{post}', ['as' => 'posts.put.edit', 'before' => 'csrf', 'uses' => 'PostController@update']);
    Route::get('{post}/delete', ['as' => 'posts.delete',  'uses' => 'PostController@delete']);
    Route::post('image/upload', ['as' => 'posts.img.upload', 'before' => 'csrf', 'uses' => 'PostController@imageUpload']);
    Route::post('{post}/comment', ['as' => 'posts.post.comment', 'before' => 'csrf', 'uses' => 'PostController@comment']);

    Route::get('{post}/zan', ['as' => 'posts.zan',  'uses' => 'PostController@zan']);
    Route::get('{post}/unzan', ['as' => 'posts.unzan',  'uses' => 'PostController@unzan']);
});

Route::group(['prefix' => 'user','middleware' => 'auth'], function () {

    Route::get('{user}', ['as' => 'user', 'uses' => 'UserController@show']);//TODO:怎么确保是当前用户？在url那里ID改成别人的也可以访问，不合理的
    Route::post('{user}/fan', ['as' => 'doFan', 'uses' => 'UserController@fan']);
    Route::post('{user}/unfan', ['as' => 'doUnfan', 'uses' => 'UserController@unfan']);

});
////文章模块
////文章列表页
//Route::get('/posts','PostController@index')->middleware('auth');
////创建文章页
//Route::get('/posts/create','PostController@create');
////搜索
//Route::get('/posts/search','PostController@search');
////文章详情页
//Route::get('/posts/{post}','PostController@show');
////创建文章逻辑
//Route::post('/posts','PostController@store');//虽然和第一个URL都是posts 但是用的方法（POST GET）不同，所以不冲突
////编辑文章
//Route::get('/posts/{post}/edit','PostController@edit');
////编辑文章逻辑
//Route::put('/posts/{post}','PostController@update');
////删除文章
//Route::get('/posts/{post}/delete','PostController@delete');
////图片上传
//Route::post('/posts/image/upload','PostController@imageUpload');
////提交评论
//Route::post('/posts/{post}/comment','PostController@comment');
////赞
//Route::get('/posts/{post}/zan','PostController@zan');
////取消赞
//Route::get('/posts/{post}/unzan','PostController@unzan');

////用户模块
////注册页面
//Route::get('/register','RegisterController@index');
////注册行为
//Route::post('/register','RegisterController@register');
////登陆页面
//Route::get('/login','LoginController@index')->name('login');
////登陆行为
//Route::post('/login','LoginController@login');
////登出行为
//Route::get('/logout','LoginController@logout');
////个人设置页面
//Route::get('/user/me/setting','UserController@setting');
////个人设置行为
//Route::post('/user/me/setting','UserController@settingStore');