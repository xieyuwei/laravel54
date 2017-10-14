<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zans', function (Blueprint $table) {
            $table->increments('id');//自增ID
            $table->integer('post_id')->default("0");//VARCHAR
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
        //
        Schema::dropIfExists('zans');
    }
}
