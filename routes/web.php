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
// 文章列表页
Route::get('/posts','PostController@index');
// 文章详情页
Route::get('/posts/{post}','PostController@show');
// 创建文章页
Route::get('/posts/create','PostController@create');
Route::post('/posts','PostController@store');//虽然和第一个URL都是posts 但是用的方法（POST GET）不同，所以不冲突
// 编辑文章
Route::get('/posts/{post}/edit','PostController@edit');
Route::put('/posts/{post}','PostController@update');//虽然和第一个URL都是posts 但是用的方法（POST GET）不同，所以不冲突
// 删除文章
Route::get('/posts/delete','PostController@delete');