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
        $this->call(RoleTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(EstadosTableSeeder::class);
        $this->call(MunicipiosTableSeeder::class);
        $this->call(LocalidadesTableSeeder::class);
        $this->call(FreightsTableSeeder::class);
    }
}
