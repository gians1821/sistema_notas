<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CursosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Eliminar datos existentes en la tabla cursos
        DB::table('cursos')->delete();

<<<<<<< HEAD
        \DB::table('cursos')->delete();
        
        \DB::table('cursos')->insert(array (
            0 => 
            array (
                'id_curso' => 1,
                'grado_id_grado' => 1,
                'nombre_curso' => 'MATEMÁTICAS',
                'created_at' => '2024-12-09 06:26:24',
                'updated_at' => '2024-12-09 06:26:24',
            ),
            1 => 
            array (
                'id_curso' => 2,
                'grado_id_grado' => 1,
                'nombre_curso' => 'COMUNICACIÓN',
                'created_at' => '2024-12-09 06:26:31',
                'updated_at' => '2024-12-09 06:26:31',
            ),
        ));
        
        
=======
        // Lista de nombres de cursos
        $nombresCursos = [
            'Matemáticas',
            'Lenguaje',
            'Ciencias',
            'Historia',
            'Geografía',
            'Educación Física',
            'Arte',
            'Computación'
        ];

        $cursos = [];

        for ($gradoId = 1; $gradoId <= 11; $gradoId++) {
            foreach ($nombresCursos as $nombreCurso) {
                $cursos[] = [
                    'id_curso' => null,
                    'grado_id_grado' => $gradoId,
                    'nombre_curso' => $nombreCurso,
                    'created_at' => null,
                    'updated_at' => null,
                ];
            }
        }

        DB::table('cursos')->insert($cursos);
>>>>>>> testing
    }
}