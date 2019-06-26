<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AmbitoTableSeeder::class);
        $this->call(AlcanceTableSeeder::class);
        $this->call(TipoTableSeeder::class);
        $this->call(DepartamentosTableSeeder::class);
        $this->call(CarrerasTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(EvidenciasTableSeeder::class);
    }
}
