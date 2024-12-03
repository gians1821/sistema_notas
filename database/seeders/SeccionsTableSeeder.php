<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SeccionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('seccions')->delete();
        
        \DB::table('seccions')->insert(array (
            0 => 
            array (
                'id_seccion' => 1,
                'nombre_seccion' => 'A',
                'capacidad' => 30,
                'grado_id_grado' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id_seccion' => 2,
                'nombre_seccion' => 'B',
                'capacidad' => 30,
                'grado_id_grado' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id_seccion' => 3,
                'nombre_seccion' => 'C',
                'capacidad' => 30,
                'grado_id_grado' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id_seccion' => 4,
                'nombre_seccion' => 'A',
                'capacidad' => 30,
                'grado_id_grado' => 2,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id_seccion' => 5,
                'nombre_seccion' => 'B',
                'capacidad' => 30,
                'grado_id_grado' => 2,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id_seccion' => 6,
                'nombre_seccion' => 'C',
                'capacidad' => 30,
                'grado_id_grado' => 2,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id_seccion' => 7,
                'nombre_seccion' => 'A',
                'capacidad' => 30,
                'grado_id_grado' => 3,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'id_seccion' => 8,
                'nombre_seccion' => 'B',
                'capacidad' => 30,
                'grado_id_grado' => 3,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'id_seccion' => 9,
                'nombre_seccion' => 'C',
                'capacidad' => 30,
                'grado_id_grado' => 3,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'id_seccion' => 10,
                'nombre_seccion' => 'A',
                'capacidad' => 30,
                'grado_id_grado' => 4,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            10 => 
            array (
                'id_seccion' => 11,
                'nombre_seccion' => 'B',
                'capacidad' => 30,
                'grado_id_grado' => 4,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            11 => 
            array (
                'id_seccion' => 12,
                'nombre_seccion' => 'C',
                'capacidad' => 30,
                'grado_id_grado' => 4,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            12 => 
            array (
                'id_seccion' => 13,
                'nombre_seccion' => 'A',
                'capacidad' => 30,
                'grado_id_grado' => 5,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            13 => 
            array (
                'id_seccion' => 14,
                'nombre_seccion' => 'B',
                'capacidad' => 30,
                'grado_id_grado' => 5,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            14 => 
            array (
                'id_seccion' => 15,
                'nombre_seccion' => 'C',
                'capacidad' => 30,
                'grado_id_grado' => 5,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            15 => 
            array (
                'id_seccion' => 16,
                'nombre_seccion' => 'A',
                'capacidad' => 30,
                'grado_id_grado' => 6,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            16 => 
            array (
                'id_seccion' => 17,
                'nombre_seccion' => 'B',
                'capacidad' => 30,
                'grado_id_grado' => 6,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            17 => 
            array (
                'id_seccion' => 18,
                'nombre_seccion' => 'C',
                'capacidad' => 30,
                'grado_id_grado' => 6,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            18 => 
            array (
                'id_seccion' => 19,
                'nombre_seccion' => 'A',
                'capacidad' => 30,
                'grado_id_grado' => 7,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            19 => 
            array (
                'id_seccion' => 20,
                'nombre_seccion' => 'B',
                'capacidad' => 30,
                'grado_id_grado' => 7,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            20 => 
            array (
                'id_seccion' => 21,
                'nombre_seccion' => 'C',
                'capacidad' => 30,
                'grado_id_grado' => 7,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            21 => 
            array (
                'id_seccion' => 22,
                'nombre_seccion' => 'A',
                'capacidad' => 30,
                'grado_id_grado' => 8,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            22 => 
            array (
                'id_seccion' => 23,
                'nombre_seccion' => 'B',
                'capacidad' => 30,
                'grado_id_grado' => 8,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            23 => 
            array (
                'id_seccion' => 24,
                'nombre_seccion' => 'C',
                'capacidad' => 30,
                'grado_id_grado' => 8,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            24 => 
            array (
                'id_seccion' => 25,
                'nombre_seccion' => 'A',
                'capacidad' => 30,
                'grado_id_grado' => 9,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            25 => 
            array (
                'id_seccion' => 26,
                'nombre_seccion' => 'B',
                'capacidad' => 30,
                'grado_id_grado' => 9,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            26 => 
            array (
                'id_seccion' => 27,
                'nombre_seccion' => 'C',
                'capacidad' => 30,
                'grado_id_grado' => 9,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            27 => 
            array (
                'id_seccion' => 28,
                'nombre_seccion' => 'A',
                'capacidad' => 30,
                'grado_id_grado' => 10,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            28 => 
            array (
                'id_seccion' => 29,
                'nombre_seccion' => 'B',
                'capacidad' => 30,
                'grado_id_grado' => 10,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            29 => 
            array (
                'id_seccion' => 30,
                'nombre_seccion' => 'C',
                'capacidad' => 30,
                'grado_id_grado' => 10,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            30 => 
            array (
                'id_seccion' => 31,
                'nombre_seccion' => 'A',
                'capacidad' => 30,
                'grado_id_grado' => 11,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            31 => 
            array (
                'id_seccion' => 32,
                'nombre_seccion' => 'B',
                'capacidad' => 30,
                'grado_id_grado' => 11,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            32 => 
            array (
                'id_seccion' => 33,
                'nombre_seccion' => 'C',
                'capacidad' => 30,
                'grado_id_grado' => 11,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}