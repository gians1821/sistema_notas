<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class GradosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('grados')->delete();
        
        \DB::table('grados')->insert(array (
            0 => 
            array (
                'id_grado' => 1,
                'id_nivel' => 1,
                'nombre_grado' => 'Primero',
                'created_at' => '2024-07-04 20:15:48',
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id_grado' => 2,
                'id_nivel' => 1,
                'nombre_grado' => 'Segundo',
                'created_at' => '2024-07-04 20:15:48',
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id_grado' => 3,
                'id_nivel' => 1,
                'nombre_grado' => 'Tercero',
                'created_at' => '2024-07-04 20:15:48',
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id_grado' => 4,
                'id_nivel' => 1,
                'nombre_grado' => 'Cuarto',
                'created_at' => '2024-07-04 20:15:48',
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id_grado' => 5,
                'id_nivel' => 1,
                'nombre_grado' => 'Quinto',
                'created_at' => '2024-07-04 20:15:48',
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id_grado' => 6,
                'id_nivel' => 1,
                'nombre_grado' => 'Sexto',
                'created_at' => '2024-07-04 20:15:48',
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id_grado' => 7,
                'id_nivel' => 2,
                'nombre_grado' => 'Primero',
                'created_at' => '2024-07-04 20:15:48',
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'id_grado' => 8,
                'id_nivel' => 2,
                'nombre_grado' => 'Segundo',
                'created_at' => '2024-07-04 20:15:48',
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'id_grado' => 9,
                'id_nivel' => 2,
                'nombre_grado' => 'Tercero',
                'created_at' => '2024-07-04 20:15:48',
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'id_grado' => 10,
                'id_nivel' => 2,
                'nombre_grado' => 'Cuarto',
                'created_at' => '2024-07-04 20:15:48',
                'updated_at' => NULL,
            ),
            10 => 
            array (
                'id_grado' => 11,
                'id_nivel' => 2,
                'nombre_grado' => 'Quinto',
                'created_at' => '2024-07-04 20:15:48',
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}