<?php

use App\Tipo;
use Illuminate\Database\Seeder;

class TipoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $tipo = new Tipo();
        $tipo->nombre = 'Acuerdos';
        $tipo->save();

        $tipo = new Tipo();
        $tipo->nombre = 'Apoyo';
        $tipo->save();

        $tipo = new Tipo();
        $tipo->nombre = 'Asesoría';
        $tipo->save();

        $tipo = new Tipo();
        $tipo->nombre = 'Asistencia';
        $tipo->save();

        $tipo = new Tipo();
        $tipo->nombre = 'Beca';
        $tipo->save();

        $tipo = new Tipo();
        $tipo->nombre = 'Campaña';
        $tipo->save();

        $tipo = new Tipo();
        $tipo->nombre = 'Capacitación';
        $tipo->save();

        $tipo = new Tipo();
        $tipo->nombre = 'Celebración';
        $tipo->save();

        $tipo = new Tipo();
        $tipo->nombre = 'Charla';
        $tipo->save();

        $tipo = new Tipo();
        $tipo->nombre = 'Conferencia';
        $tipo->save();

        $tipo = new Tipo();
        $tipo->nombre = 'Congreso';
        $tipo->save();

        $tipo = new Tipo();
        $tipo->nombre = 'Contrato';
        $tipo->save();

        $tipo = new Tipo();
        $tipo->nombre = 'Convenio';
        $tipo->save();

        $tipo = new Tipo();
        $tipo->nombre = 'Cursos';
        $tipo->save();

        $tipo = new Tipo();
        $tipo->nombre = 'Difusión';
        $tipo->save();

        $tipo = new Tipo();
        $tipo->nombre = 'Encuentro';
        $tipo->save();

        $tipo = new Tipo();
        $tipo->nombre = 'Exposición';
        $tipo->save();

        $tipo = new Tipo();
        $tipo->nombre = 'Inducción';
        $tipo->save();

    }
}
