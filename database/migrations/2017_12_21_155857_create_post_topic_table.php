<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostTopicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('post_topics', function (Blueprint $table) {
            $table->increments('id');//自增ID
            $table->integer('post_id')->default(0);
            $table->integer('topic_id')->default(0);
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
        //
        Schema::dropIfExists('post_topics');
    }
}
