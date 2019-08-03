<?php

use Illuminate\Database\Seeder;

use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role();
        $role->name = 'admin';
        $role->description = 'Administrator';
        $role->save();

        $role = new Role();
        $role->name = 'company';
        $role->description = 'Compañia';
        $role->save();

        $role = new Role();
        $role->name = 'carrier';
        $role->description = 'Transportista';
        $role->save();
    }
}
