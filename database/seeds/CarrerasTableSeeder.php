<?php

use App\Carrera;
use Illuminate\Database\Seeder;

class CarrerasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $carrera = new Carrera;
        $carrera->codigo_car = 'ICI';
        $carrera->nombre_car = 'Ingeniería Civil Informática';
        $carrera->codigo_dep = 'DEP1';
        $carrera->save();

        $carrera = new Carrera;
        $carrera->codigo_car = 'IND';
        $carrera->nombre_car = 'Ingeniería Civil Industrial';
        $carrera->codigo_dep = 'DEP1';
        $carrera->save();

        $carrera = new Carrera;
        $carrera->codigo_car = 'EICI';
        $carrera->nombre_car = 'Ingeniería Ejecución en Computación e Informática';
        $carrera->codigo_dep = 'DEP1';
        $carrera->save();

        $carrera = new Carrera;
        $carrera->codigo_car = 'ICE';
        $carrera->nombre_car = 'Ingeniería Civil Electrónica';
        $carrera->codigo_dep = 'DEP1';
        $carrera->save();

        $carrera = new Carrera;
        $carrera->codigo_car = 'INC';
        $carrera->nombre_car = 'Ingeniería Civil';
        $carrera->codigo_dep = 'DEP2';
        $carrera->save();

        $carrera = new Carrera;
        $carrera->codigo_car = 'CCV';
        $carrera->nombre_car = 'Construcción Civil';
        $carrera->codigo_dep = 'DEP2';
        $carrera->save();

        $carrera = new Carrera;
        $carrera->codigo_car = 'ICO';
        $carrera->nombre_car = 'Ingeniería en Construcción';
        $carrera->codigo_dep = 'DEP2';
        $carrera->save();

        $carrera = new Carrera;
        $carrera->codigo_car = 'ENFT';
        $carrera->nombre_car = 'Enfermería Talca';
        $carrera->codigo_dep = 'DEP3';
        $carrera->save();

        $carrera = new Carrera;
        $carrera->codigo_car = 'ENFC';
        $carrera->nombre_car = 'Enfermería Curicó';
        $carrera->codigo_dep = 'DEP3';
        $carrera->save();

        $carrera = new Carrera;
        $carrera->codigo_car = 'PSI';
        $carrera->nombre_car = 'Psicología';
        $carrera->codigo_dep = 'DEP4';
        $carrera->save();

        $carrera = new Carrera;
        $carrera->codigo_car = 'KIN';
        $carrera->nombre_car = 'Kinesiología';
        $carrera->codigo_dep = 'DEP5';
        $carrera->save();
    }
}
