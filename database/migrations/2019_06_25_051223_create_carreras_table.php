<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarrerasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carreras', function (Blueprint $table) {
            $table->string('codigo_car')->primary();
            $table->string('nombre_car');
            $table->string('codigo_dep')->unsigned()->nullable();   //  nullable para que permita null.
            $table->timestamps();

            $table->foreign('codigo_dep')->references('codigo_dep')->on('departamentos')->onDelete('set null'); //set null ya que si se borra el departamento la carrera seguirá en la BD con codigo_dep null.
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carreras');
    }
}
