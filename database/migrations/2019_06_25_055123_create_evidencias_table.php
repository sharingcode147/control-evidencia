<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvidenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evidencias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('formulario_id');
            $table->string('estado');
            $table->integer('nivel');
            $table->unsignedInteger('folio_id')->nullable();
            $table->string('codigo_car')->unsigned();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('formulario_id')->references('id')->on('formularios')->onDelete('cascade');
            $table->foreign('folio_id')->references('id')->on('folios')->onDelete('cascade');
            $table->foreign('codigo_car')->references('codigo_car')->on('carreras')->onDelete('cascade');

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
        Schema::dropIfExists('evidencias');
    }
}
