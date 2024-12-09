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
                'id_personal' => 20,
                'user_id' => 25,
                'id_tipo_personal' => 1,
                'nombre' => 'JHON',
                'apellido' => 'CONNOR',
                'dni' => '71245640',
                'direccion' => 'TRISTEZA 123',
                'fecha_nacimiento' => '2005-02-10',
                'telefono' => '999888777',
                'created_at' => '2024-12-09 06:34:44',
                'updated_at' => '2024-12-09 06:34:44',
            ),
            1 => 
            array (
                'id_personal' => 21,
                'user_id' => 26,
                'id_tipo_personal' => 3,
                'nombre' => 'MIGUEL',
                'apellido' => 'RAMOS',
                'dni' => '71245641',
                'direccion' => 'TRISTEZA 123',
                'fecha_nacimiento' => '2000-12-15',
                'telefono' => '999888777',
                'created_at' => '2024-12-09 06:39:29',
                'updated_at' => '2024-12-09 06:39:29',
            ),
        ));
        
        
    }
}