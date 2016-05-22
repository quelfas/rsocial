<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserRelationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('UserRelation', function(Blueprint $table){
          $table->increments('id');
          $table->integer('user_id1');
          $table->integer('user_id2');
          $table->enum('are_friends',['Si','No','StBy'])->default('StBy');
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
    }
}
