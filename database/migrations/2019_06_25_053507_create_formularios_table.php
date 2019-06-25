<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormulariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formularios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('alcance_id');
            $table->unsignedInteger('ambito_id');
            $table->unsignedInteger('tipo_id');
            $table->string('titulo');
            $table->text('descripcion');
            $table->date('fecha_realizacion');
            $table->integer('int_estudiantes');
            $table->integer('ext_estudiantes');
            $table->integer('int_profesores');
            $table->integer('ext_profesores');
            $table->integer('int_autoridades');
            $table->integer('ext_autoridades');
            $table->integer('int_profesionales');
            $table->integer('ext_profesionales');

            $table->foreign('alcance_id')->references('id')->on('alcance');
            $table->foreign('ambito_id')->references('id')->on('ambito');
            $table->foreign('tipo_id')->references('id')->on('tipo');

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
        Schema::dropIfExists('formularios');
    }
}
