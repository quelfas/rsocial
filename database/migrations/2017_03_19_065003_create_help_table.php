<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHelpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('Help', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('solicitud');
            $table->string('cod_req');
            $table->enum('status',['Creado','Procesado','Finalizado'])->default('Creado');
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
        Schema::drop('Help');
    }
}
