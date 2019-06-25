<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $role = new Role();
        $role->name = 'admin';
        $role->description = 'Administrator';
        $role->save();

        $role = new Role();
        $role->name = 'dac';
        $role->description = 'Dep. Aseguramiento de la calidad';
        $role->save();

		$role = new Role();
        $role->name = 'revisor';
        $role->description = 'Revisor';
        $role->save();

        $role = new Role();
        $role->name = 'profesor';
        $role->description = 'Profesor';
        $role->save();
    }
}
