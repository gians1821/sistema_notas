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
                'created_at' => '2024-12-09 06:26:50',
                'updated_at' => '2024-12-09 06:26:50',
            ),
            1 => 
            array (
                'id_competencia' => 2,
                'id_curso' => 2,
                'nombre_competencia' => 'Se desenvuelve en ensayos',
                'created_at' => '2024-12-09 06:26:59',
                'updated_at' => '2024-12-09 06:26:59',
            ),
        ));
        
        
    }
}