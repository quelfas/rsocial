<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('Videos', function(Blueprint $table){
          $table->increments('id');
          $table->integer('user_id');
          $table->string('url_frame');
          $table->string('url_link');
          $table->string('privacy');
          $table->string('parental');
          $table->string('tags');
          $table->enum('active',['Si','No'])->default('Si');
          $table->timestamps();
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
        Schema::drop('Videos');
    }
}
