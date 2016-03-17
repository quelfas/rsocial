<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function(Blueprint $table){
            $table->increments('id');
            $table->integer('user_id');
            $table->string('name');
            $table->string('last_name');
            $table->date('birthdate');
            $table->enum('gender',['femenino','masculino'])->default('femenino');
            $table->string('country');
            $table->string('locale');
            $table->string('phone');
            $table->enum('privacy',['privado','publico'])->default('privado');
            $table->enum('connections',['Si','No'])->default('Si');
            $table->text('bio');
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
