<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfesorCarreraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profesor_carrera', function (Blueprint $table) {
            $table->string('profesor_run')->unsigned();
            $table->string('codigo_car')->unsigned();
            $table->timestamps();

            $table->foreign('profesor_run')->references('run')->on('profesor')->onDelete('cascade');
            $table->foreign('codigo_car')->references('codigo_car')->on('carreras')->onDelete('cascade');
            $table->primary(['profesor_run','codigo_car']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profesor_carrera');
    }
}
