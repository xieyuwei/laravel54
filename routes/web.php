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
    Route::get('{user}', ['as' => 'user', 'uses' => 'UserController@show']);
    Route::post('{user}/fan', ['as' => 'doFan', 'uses' => 'UserController@fan']);
    Route::post('{user}/unfan', ['as' => 'doUnfan', 'uses' => 'UserController@unfan']);
});

Route::group(['prefix' => 'topic','middleware' => 'auth'], function () {
    Route::get('{topic}', ['as' => 'show.topic', 'uses' => 'TopicController@show']);
    Route::post('{topic}/submit', ['as' => 'submit.topic', 'uses' => 'TopicController@submit']);
});
