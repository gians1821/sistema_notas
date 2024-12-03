<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('permissions')->delete();
        
        \DB::table('permissions')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Home.index',
                'guard_name' => 'web',
                'created_at' => '2024-08-15 02:20:03',
                'updated_at' => '2024-08-15 02:20:03',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Admin.users.index',
                'guard_name' => 'web',
                'created_at' => '2024-08-15 02:20:04',
                'updated_at' => '2024-08-15 02:20:04',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Admin.users.create',
                'guard_name' => 'web',
                'created_at' => '2024-08-15 02:20:05',
                'updated_at' => '2024-08-15 02:20:05',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Admin.users.edit',
                'guard_name' => 'web',
                'created_at' => '2024-08-15 02:20:05',
                'updated_at' => '2024-08-15 02:20:05',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Admin.users.destroy',
                'guard_name' => 'web',
                'created_at' => '2024-08-15 02:20:06',
                'updated_at' => '2024-08-15 02:20:06',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Alumno.index',
                'guard_name' => 'web',
                'created_at' => '2024-08-15 02:20:06',
                'updated_at' => '2024-08-15 02:20:06',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Alumno.create',
                'guard_name' => 'web',
                'created_at' => '2024-08-15 02:20:07',
                'updated_at' => '2024-08-15 02:20:07',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Alumno.edit',
                'guard_name' => 'web',
                'created_at' => '2024-08-15 02:20:07',
                'updated_at' => '2024-08-15 02:20:07',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Alumno.destroy',
                'guard_name' => 'web',
                'created_at' => '2024-08-15 02:20:08',
                'updated_at' => '2024-08-15 02:20:08',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'Seccion.index',
                'guard_name' => 'web',
                'created_at' => '2024-08-15 02:20:08',
                'updated_at' => '2024-08-15 02:20:08',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'Seccion.create',
                'guard_name' => 'web',
                'created_at' => '2024-08-15 02:20:09',
                'updated_at' => '2024-08-15 02:20:09',
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'Seccion.destroy',
                'guard_name' => 'web',
                'created_at' => '2024-08-15 02:20:09',
                'updated_at' => '2024-08-15 02:20:09',
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'Curso.index',
                'guard_name' => 'web',
                'created_at' => '2024-08-15 02:20:10',
                'updated_at' => '2024-08-15 02:20:10',
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'Curso.create',
                'guard_name' => 'web',
                'created_at' => '2024-08-15 02:20:11',
                'updated_at' => '2024-08-15 02:20:11',
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'Curso.edit',
                'guard_name' => 'web',
                'created_at' => '2024-08-15 02:20:11',
                'updated_at' => '2024-08-15 02:20:11',
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'Curso.destroy',
                'guard_name' => 'web',
                'created_at' => '2024-08-15 02:20:12',
                'updated_at' => '2024-08-15 02:20:12',
            ),
            16 => 
            array (
                'id' => 17,
                'name' => 'CursoPorGrado.index',
                'guard_name' => 'web',
                'created_at' => '2024-08-15 02:20:12',
                'updated_at' => '2024-08-15 02:20:12',
            ),
            17 => 
            array (
                'id' => 18,
                'name' => 'Capacidad.index',
                'guard_name' => 'web',
                'created_at' => '2024-08-15 02:20:13',
                'updated_at' => '2024-08-15 02:20:13',
            ),
            18 => 
            array (
                'id' => 19,
                'name' => 'Capacidad.create',
                'guard_name' => 'web',
                'created_at' => '2024-08-15 02:20:13',
                'updated_at' => '2024-08-15 02:20:13',
            ),
            19 => 
            array (
                'id' => 20,
                'name' => 'Capacidad.edit',
                'guard_name' => 'web',
                'created_at' => '2024-08-15 02:20:14',
                'updated_at' => '2024-08-15 02:20:14',
            ),
            20 => 
            array (
                'id' => 21,
                'name' => 'Capacidad.destroy',
                'guard_name' => 'web',
                'created_at' => '2024-08-15 02:20:14',
                'updated_at' => '2024-08-15 02:20:14',
            ),
            21 => 
            array (
                'id' => 22,
                'name' => 'Personal.index',
                'guard_name' => 'web',
                'created_at' => '2024-08-15 02:20:15',
                'updated_at' => '2024-08-15 02:20:15',
            ),
            22 => 
            array (
                'id' => 23,
                'name' => 'Personal.create',
                'guard_name' => 'web',
                'created_at' => '2024-08-15 02:20:15',
                'updated_at' => '2024-08-15 02:20:15',
            ),
            23 => 
            array (
                'id' => 24,
                'name' => 'Personal.edit',
                'guard_name' => 'web',
                'created_at' => '2024-08-15 02:20:16',
                'updated_at' => '2024-08-15 02:20:16',
            ),
            24 => 
            array (
                'id' => 25,
                'name' => 'Personal.destroy',
                'guard_name' => 'web',
                'created_at' => '2024-08-15 02:20:17',
                'updated_at' => '2024-08-15 02:20:17',
            ),
            25 => 
            array (
                'id' => 26,
                'name' => 'CursoHasAlumno.index',
                'guard_name' => 'web',
                'created_at' => '2024-08-15 02:20:18',
                'updated_at' => '2024-08-15 02:20:18',
            ),
            26 => 
            array (
                'id' => 27,
                'name' => 'CursoHasAlumno.edit',
                'guard_name' => 'web',
                'created_at' => '2024-08-15 02:20:18',
                'updated_at' => '2024-08-15 02:20:18',
            ),
            27 => 
            array (
                'id' => 28,
                'name' => 'CursoHasAlumno.pdf',
                'guard_name' => 'web',
                'created_at' => '2024-08-15 02:20:19',
                'updated_at' => '2024-08-15 02:20:19',
            ),
        ));
        
        
    }
}