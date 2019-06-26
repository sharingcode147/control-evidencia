<?php

use App\Alcance;
use Illuminate\Database\Seeder;

class AlcanceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $alcance = new Alcance();
        $alcance->nombre = 'Comunal';
        $alcance->save();

        $alcance = new Alcance();
        $alcance->nombre = 'Provincial';
        $alcance->save();

        $alcance = new Alcance();
        $alcance->nombre = 'Regional';
        $alcance->save();

        $alcance = new Alcance();
        $alcance->nombre = 'Nacional';
        $alcance->save();

        $alcance = new Alcance();
        $alcance->nombre = 'Internacional';
        $alcance->save();

    }
}
