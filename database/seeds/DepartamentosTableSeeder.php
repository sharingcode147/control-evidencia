<?php

use App\Departamento;
use Illuminate\Database\Seeder;

class DepartamentosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $departamento = new Departamento();
        $departamento->codigo_dep = 'DEP1';
        $departamento->nombre_dep = 'Departamento de computación e industrias';
        $departamento->save();

        $departamento = new Departamento();
        $departamento->codigo_dep = 'DEP2';
        $departamento->nombre_dep = 'Departamento de obras civiles';
        $departamento->save();

        $departamento = new Departamento();
        $departamento->codigo_dep = 'DEP3';
        $departamento->nombre_dep = 'Departamento de enfermería';
        $departamento->save();

        $departamento = new Departamento();
        $departamento->codigo_dep = 'DEP4';
        $departamento->nombre_dep = 'Departamento de psicología';
        $departamento->save();

        $departamento = new Departamento();
        $departamento->codigo_dep = 'DEP5';
        $departamento->nombre_dep = 'Departamento de kinesiología';
        $departamento->save();
    }
}
