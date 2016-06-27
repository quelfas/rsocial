<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Subscription', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('subscribe_id');
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
        Schema::drop('Subscription');
    }
}
