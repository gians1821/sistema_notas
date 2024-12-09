<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CursosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('cursos')->delete();
        
        \DB::table('cursos')->insert(array (
            0 => 
            array (
                'id_curso' => 1,
                'grado_id_grado' => 1,
                'nombre_curso' => 'MATEMÁTICAS',
                'created_at' => '2024-12-09 06:26:24',
                'updated_at' => '2024-12-09 06:26:24',
            ),
            1 => 
            array (
                'id_curso' => 2,
                'grado_id_grado' => 1,
                'nombre_curso' => 'COMUNICACIÓN',
                'created_at' => '2024-12-09 06:26:31',
                'updated_at' => '2024-12-09 06:26:31',
            ),
        ));
        
        
    }
}