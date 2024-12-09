<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PersonalsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('personals')->delete();
        
        \DB::table('personals')->insert(array (
            0 => 
            array (
                'id_personal' => 1,
                'user_id' => 8,
                'id_tipo_personal' => 3,
                'nombre' => 'MIGUEL',
                'apellido' => 'RAMOS',
                'dni' => '71245664',
                'direccion' => 'TRISTEZA 123',
                'fecha_nacimiento' => '2000-12-10',
                'telefono' => '999888777',
                'created_at' => '2024-12-09 06:48:38',
                'updated_at' => '2024-12-09 06:48:38',
            ),
            1 => 
            array (
                'id_personal' => 2,
                'user_id' => 9,
                'id_tipo_personal' => 1,
                'nombre' => 'JHON',
                'apellido' => 'CONNOR',
                'dni' => '75729465',
                'direccion' => 'TRISTEZA 123',
                'fecha_nacimiento' => '2005-02-11',
                'telefono' => '999888777',
                'created_at' => '2024-12-09 06:49:08',
                'updated_at' => '2024-12-09 06:49:08',
            ),
        ));
        
        
    }
}