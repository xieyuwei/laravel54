<?php

namespace App\Providers;


use App\Topic;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;

//use Illuminate\Support\Facades\Schema;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //boot 函数  所有的serviceProvider启动之后执行
//        laravel string 默认字符编码 mb4string, 4个bytes 对应一个字符 so 767/4 = 191.75
//        Schema::defaultStringLenth(191); //设置laravel默认的string长度
        \View::composer('layout.sidebar', function ($view) {
            $topics = \App\Topic::all();
            $view->with('topics', $topics);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //register 函数  所有的serviceProvider启动之前执行
    }
}
// fix SQL 1071 specified key was too long ; max key length is 767 bytes