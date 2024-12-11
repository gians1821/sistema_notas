<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('roles')->delete();
        
        \DB::table('roles')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Admin',
                'descripcion' => 'Tienes control total del sistema.',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Secretaria',
                'descripcion' => 'Usted se encuentra encargada de la matricula y aprobación de notas.',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Docente',
                'descripcion' => 'Puede visualizar y registrar las notas del estudiante.',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Padre',
                'descripcion' => 'Usted puede ver las notas de sus hijos.',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Director',
                'descripcion' => 'Es el director',
                'guard_name' => 'web',
                'created_at' => '2024-12-09 06:20:21',
                'updated_at' => '2024-12-09 06:20:21',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Asistente',
                'descripcion' => 'Eres asistente',
                'guard_name' => 'web',
                'created_at' => '2024-12-10 05:18:58',
                'updated_at' => '2024-12-10 05:18:58',
            ),
        ));
        
        
    }
}