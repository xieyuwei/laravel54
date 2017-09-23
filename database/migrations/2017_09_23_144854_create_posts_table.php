<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //执行migration时要执行的函数（commond : php artisan migrate）
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');//自增ID
            $table->string('title',100)->default("");//VARCHAR
            $table->text('content');
            $table->integer('user_id')->default("0");//INT
            $table->timestamps();//TIMESTAMP  (created_at updated_at)



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //回滚migration的时候要执行的函数（commond : php artisan migrate:rollback）
        Schema::dropIfExists('posts');
    }
}
