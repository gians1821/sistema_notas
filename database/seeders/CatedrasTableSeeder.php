<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CatedrasTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('catedras')->delete();
        
        \DB::table('catedras')->insert(array (
            0 => 
            array (
                'id' => 1,
                'periodo_id' => 2,
                'docente_id' => 6,
                'curso_id' => 1,
                'seccion_id' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'periodo_id' => 2,
                'docente_id' => 10,
                'curso_id' => 2,
                'seccion_id' => 2,
            ),
        ));
        
        
    }
}