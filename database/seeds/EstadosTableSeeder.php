<?php

use Illuminate\Database\Seeder;

class EstadosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('estados')->delete();
        
        \DB::table('estados')->insert(array (
            0 => 
            array (
                'id' => 1,
                'clave' => '01',
                'nombre' => 'Aguascalientes',
                'abrev' => 'Ags.',
                'activo' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'clave' => '02',
                'nombre' => 'Baja California',
                'abrev' => 'BC',
                'activo' => 1,
            ),
            2 => 
            array (
                'id' => 3,
                'clave' => '03',
                'nombre' => 'Baja California Sur',
                'abrev' => 'BCS',
                'activo' => 1,
            ),
            3 => 
            array (
                'id' => 4,
                'clave' => '04',
                'nombre' => 'Campeche',
                'abrev' => 'Camp.',
                'activo' => 1,
            ),
            4 => 
            array (
                'id' => 5,
                'clave' => '05',
                'nombre' => 'Coahuila de Zaragoza',
                'abrev' => 'Coah.',
                'activo' => 1,
            ),
            5 => 
            array (
                'id' => 6,
                'clave' => '06',
                'nombre' => 'Colima',
                'abrev' => 'Col.',
                'activo' => 1,
            ),
            6 => 
            array (
                'id' => 7,
                'clave' => '07',
                'nombre' => 'Chiapas',
                'abrev' => 'Chis.',
                'activo' => 1,
            ),
            7 => 
            array (
                'id' => 8,
                'clave' => '08',
                'nombre' => 'Chihuahua',
                'abrev' => 'Chih.',
                'activo' => 1,
            ),
            8 => 
            array (
                'id' => 9,
                'clave' => '09',
                'nombre' => 'Ciudad de México',
                'abrev' => 'CDMX',
                'activo' => 1,
            ),
            9 => 
            array (
                'id' => 10,
                'clave' => '10',
                'nombre' => 'Durango',
                'abrev' => 'Dgo.',
                'activo' => 1,
            ),
            10 => 
            array (
                'id' => 11,
                'clave' => '11',
                'nombre' => 'Guanajuato',
                'abrev' => 'Gto.',
                'activo' => 1,
            ),
            11 => 
            array (
                'id' => 12,
                'clave' => '12',
                'nombre' => 'Guerrero',
                'abrev' => 'Gro.',
                'activo' => 1,
            ),
            12 => 
            array (
                'id' => 13,
                'clave' => '13',
                'nombre' => 'Hidalgo',
                'abrev' => 'Hgo.',
                'activo' => 1,
            ),
            13 => 
            array (
                'id' => 14,
                'clave' => '14',
                'nombre' => 'Jalisco',
                'abrev' => 'Jal.',
                'activo' => 1,
            ),
            14 => 
            array (
                'id' => 15,
                'clave' => '15',
                'nombre' => 'México',
                'abrev' => 'Mex.',
                'activo' => 1,
            ),
            15 => 
            array (
                'id' => 16,
                'clave' => '16',
                'nombre' => 'Michoacán de Ocampo',
                'abrev' => 'Mich.',
                'activo' => 1,
            ),
            16 => 
            array (
                'id' => 17,
                'clave' => '17',
                'nombre' => 'Morelos',
                'abrev' => 'Mor.',
                'activo' => 1,
            ),
            17 => 
            array (
                'id' => 18,
                'clave' => '18',
                'nombre' => 'Nayarit',
                'abrev' => 'Nay.',
                'activo' => 1,
            ),
            18 => 
            array (
                'id' => 19,
                'clave' => '19',
                'nombre' => 'Nuevo León',
                'abrev' => 'NL',
                'activo' => 1,
            ),
            19 => 
            array (
                'id' => 20,
                'clave' => '20',
                'nombre' => 'Oaxaca',
                'abrev' => 'Oax.',
                'activo' => 1,
            ),
            20 => 
            array (
                'id' => 21,
                'clave' => '21',
                'nombre' => 'Puebla',
                'abrev' => 'Pue.',
                'activo' => 1,
            ),
            21 => 
            array (
                'id' => 22,
                'clave' => '22',
                'nombre' => 'Querétaro',
                'abrev' => 'Qro.',
                'activo' => 1,
            ),
            22 => 
            array (
                'id' => 23,
                'clave' => '23',
                'nombre' => 'Quintana Roo',
                'abrev' => 'Q. Roo',
                'activo' => 1,
            ),
            23 => 
            array (
                'id' => 24,
                'clave' => '24',
                'nombre' => 'San Luis Potosí',
                'abrev' => 'SLP',
                'activo' => 1,
            ),
            24 => 
            array (
                'id' => 25,
                'clave' => '25',
                'nombre' => 'Sinaloa',
                'abrev' => 'Sin.',
                'activo' => 1,
            ),
            25 => 
            array (
                'id' => 26,
                'clave' => '26',
                'nombre' => 'Sonora',
                'abrev' => 'Son.',
                'activo' => 1,
            ),
            26 => 
            array (
                'id' => 27,
                'clave' => '27',
                'nombre' => 'Tabasco',
                'abrev' => 'Tab.',
                'activo' => 1,
            ),
            27 => 
            array (
                'id' => 28,
                'clave' => '28',
                'nombre' => 'Tamaulipas',
                'abrev' => 'Tamps.',
                'activo' => 1,
            ),
            28 => 
            array (
                'id' => 29,
                'clave' => '29',
                'nombre' => 'Tlaxcala',
                'abrev' => 'Tlax.',
                'activo' => 1,
            ),
            29 => 
            array (
                'id' => 30,
                'clave' => '30',
                'nombre' => 'Veracruz de Ignacio de la Llave',
                'abrev' => 'Ver.',
                'activo' => 1,
            ),
            30 => 
            array (
                'id' => 31,
                'clave' => '31',
                'nombre' => 'Yucatán',
                'abrev' => 'Yuc.',
                'activo' => 1,
            ),
            31 => 
            array (
                'id' => 32,
                'clave' => '32',
                'nombre' => 'Zacatecas',
                'abrev' => 'Zac.',
                'activo' => 1,
            ),
        ));
        
        
    }
}