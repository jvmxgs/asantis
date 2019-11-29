<?php

use Illuminate\Database\Seeder;

class FreightsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $freight = new Freight();
        $freight->freightnumber = 'AS19110001';
        $freight->description = '';
        $freight->fromlocalidad_id = 9056;
        $freight->fromaddress = 'CHIHUAHUA';
        $freight->departuretime = '2019-11-23 10:00:00';
        $freight->tolocalidad_id = '51646';
        $freight->toaddress = 'COLINAS DE LA PRESA 17862';
        $freight->arrivaltime = '2019-11-11 12:00:00';
        $freight->weight = '20000';
        $freight->weightunit = 'kg';
        $freight->user_id = '2';
        $freight->save();

        $freight = new Freight();
        $freight->freightnumber = 'AS19110002';
        $freight->description = '';
        $freight->fromlocalidad_id = 9056;
        $freight->fromaddress = 'GUADALAJARA';
        $freight->departuretime = '2019-11-15  13:37:00';
        $freight->tolocalidad_id = '125342';
        $freight->toaddress = 'MURUA MARTINEZ';
        $freight->arrivaltime = '2019-11-11 10:41:00';
        $freight->weight = '40000';
        $freight->weightunit = 'kg';
        $freight->user_id = '2';
        $freight->save();
    }
}