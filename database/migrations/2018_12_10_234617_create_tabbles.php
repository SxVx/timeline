<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTabbles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->increments('USR_ID');
            $table->text('USR_Nombre');
            $table->text('USR_Correo');
            $table->text('USR_Contrasena');
            $table->timestamps();
        });


        Schema::create('posts', function (Blueprint $table) {
            $table->increments('PTS_ID');
            $table->string('PTS_Contenido',280);
            $table->integer('USR_ID');
            $table->timestamps();
        });

        Schema::create('comentarios', function (Blueprint $table) {
            $table->increments('CMT_ID');
            $table->string('CMT_Contenido',280);
            $table->integer('PTS_ID');
            $table->integer('USR_ID');
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
        Schema::dropIfExists('usuarios');
        Schema::dropIfExists('posts');
        Schema::dropIfExists('comentarios');
    }
}
