<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class NivelsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('nivels')->delete();
        
        \DB::table('nivels')->insert(array (
            0 => 
            array (
                'id_nivel' => 1,
                'nombre_nivel' => 'PRIMARIA',
                'created_at' => '2024-07-03 20:15:48',
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id_nivel' => 2,
                'nombre_nivel' => 'SECUNDARIA',
                'created_at' => '2024-07-03 20:15:48',
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}