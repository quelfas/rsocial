<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentsTable extends Migration
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
        [
            'id',
            'user_id',
            'content_type',
            'content_id',
            'privacy',
            'message',
            'tags',
            'active'
        ];
        */
        Schema::create('Contents', function(Blueprint $table){
            $table->increments('id');
            $table->integer('user_id');
            $table->string('content_type');
            $table->integer('content_id');
            $table->string('privacy');
            $table->string('message');
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
        Schema::drop('Contents');
    }
}
