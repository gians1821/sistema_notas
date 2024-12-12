<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoPersonalsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        DB::table('tipo_personals')->delete();
        
        DB::table('tipo_personals')->insert(array (
            0 => 
            array (
                'id_tipo_personal' => 1,
                'nombre_tipopersonal' => 'DOCENTE',
                'created_at' => '2024-07-29 14:56:01',
                'updated_at' => '2024-07-29 14:56:01',
            ),
            1 => 
            array (
                'id_tipo_personal' => 2,
                'nombre_tipopersonal' => 'ADMINISTRADOR',
                'created_at' => '2024-07-29 14:56:01',
                'updated_at' => '2024-07-29 14:56:01',
            ),
            2 => 
            array (
                'id_tipo_personal' => 3,
                'nombre_tipopersonal' => 'DIRECTOR',
                'created_at' => '2024-07-29 14:56:01',
                'updated_at' => '2024-07-29 14:56:01',
            ),
            3 => 
            array (
                'id_tipo_personal' => 4,
                'nombre_tipopersonal' => 'ASISTENTE',
                'created_at' => '2024-07-29 14:56:01',
                'updated_at' => '2024-07-29 14:56:01',
            ),
        ));
        
        
    }
}