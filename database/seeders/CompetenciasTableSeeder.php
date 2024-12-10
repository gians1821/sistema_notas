<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CompetenciasTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('competencias')->delete();
        
        \DB::table('competencias')->insert(array (
            0 => 
            array (
                'id_competencia' => 1,
                'id_curso' => 1,
                'nombre_competencia' => 'Resuelve problemas matemáticos',
                'created_at' => '2024-12-10 05:42:23',
                'updated_at' => '2024-12-10 05:42:23',
            ),
            1 => 
            array (
                'id_competencia' => 2,
                'id_curso' => 2,
                'nombre_competencia' => 'Se desenvuelve en ensayos',
                'created_at' => '2024-12-10 05:42:37',
                'updated_at' => '2024-12-10 05:42:37',
            ),
            2 => 
            array (
                'id_competencia' => 3,
                'id_curso' => 3,
                'nombre_competencia' => 'Crea proyectos ambientales',
                'created_at' => '2024-12-10 05:42:56',
                'updated_at' => '2024-12-10 05:42:56',
            ),
        ));
        
        
    }
}