<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NivelsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        DB::table('nivels')->delete();
        
        DB::table('nivels')->insert(array (
            0 => 
            array (
                'id_nivel' => 1,
                'nombre_nivel' => 'Primaria',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id_nivel' => 2,
                'nombre_nivel' => 'Secundaria',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}