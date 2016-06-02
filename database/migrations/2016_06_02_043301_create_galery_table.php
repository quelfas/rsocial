<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGaleryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        /*
        'id',
        'user_id',
        'galery_name',
        'image_name',
        'image_real',
        'size',
        'type',
        'privacy',
        'tags',
        'active'
        */

        Schema::create('Galery', function(Blueprint $table){
          $table->increments('id');
          $table->integer('user_id');
          $table->string('galery_name');
          $table->string('image_name');
          $table->string('image_real');
          $table->integer('size');
          $table->string('type');
          $table->string('privacy');
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
        Schema::drop('Galery');
    }
}
