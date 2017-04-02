<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateContentsTable extends Migration
{

    /**
    * Metodo para que Doctrine/DBAL pueda funcionar y evitar la excepcion:
    * Unknown database type enum requested, Doctrine\DBAL\Platforms\MySqlPlatform may not support it.
    * Este metodo debe ser incluido en cada migracion que modifique tablas
    **/
    public function __construct()
    {
      DB::getDoctrineSchemaManager()->getDatabasePlatform()->registerDoctrineTypeMapping('enum', 'string');
    }
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Contents', function (Blueprint $table) {
          $table->text('content_id')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('Contents', function ($table) {
        $table->dropColumn('content_id');
      });
    }
}
