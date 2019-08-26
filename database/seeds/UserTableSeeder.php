<?php

use Illuminate\Database\Seeder;

use App\User;
use App\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_company = Role::where('name', 'company')->first()->id;
        $role_carrier = Role::where('name', 'carrier')->first()->id;
        $role_admin = Role::where('name', 'admin')->first()->id;

        $user = new User();
        $user->name = 'Administrator';
        $user->username = 'admin';
        $user->email = 'admin@example.com';
        $user->password = bcrypt('secret');
        $user->role_id = $role_admin;
        $user->save();

        $user = new User();
        $user->name = 'Compañia';
        $user->username = 'company';
        $user->email = 'company@example.com';
        $user->password = bcrypt('secret');
        $user->role_id = $role_company;
        $user->save();

        $user = new User();
        $user->name = 'Transportista';
        $user->username = 'carrier';
        $user->email = 'carrier@example.com';
        $user->password = bcrypt('secret');
        $user->role_id = $role_carrier;
        $user->save();
    }
}
