<?php

use Illuminate\Database\Seeder;

use Transporte\User;
use Transporte\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_company = Role::where('name', 'company')->first();
        $role_carrier = Role::where('name', 'carrier')->first();
        $role_admin = Role::where('name', 'admin')->first();

        $user = new User();
        $user->name = 'Administrator';
        $user->username = 'admin';
        $user->email = 'admin@example.com';
        $user->password = bcrypt('secret');
        $user->save();
        $user->roles()->attach($role_admin);

        $user = new User();
        $user->name = 'Compañia';
        $user->username = 'company';
        $user->email = 'company@example.com';
        $user->password = bcrypt('secret');
        $user->save();
        $user->roles()->attach($role_company);

        $user = new User();
        $user->name = 'Transportista';
        $user->username = 'carrier';
        $user->email = 'carrier@example.com';
        $user->password = bcrypt('secret');
        $user->save();
        $user->roles()->attach($role_carrier);
    }
}
