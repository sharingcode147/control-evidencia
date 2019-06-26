<?php

use App\Ambito;
use Illuminate\Database\Seeder;

class AmbitoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $ambito = new Ambito();
        $ambito->nombre = 'Académico';
        $ambito->save();

        $ambito = new Ambito();
        $ambito->nombre = 'Extensión';
        $ambito->save();

        $ambito = new Ambito();
        $ambito->nombre = 'Extensión académica';
        $ambito->save();

       	$ambito = new Ambito();
        $ambito->nombre = 'Gestión';
        $ambito->save();

        $ambito = new Ambito();
        $ambito->nombre = 'Investigación';
        $ambito->save();

        $ambito = new Ambito();
        $ambito->nombre = 'Productivo';
        $ambito->save();

        $ambito = new Ambito();
        $ambito->nombre = 'Social';
        $ambito->save();
    }
}
