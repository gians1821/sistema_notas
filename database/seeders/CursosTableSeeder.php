<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CursosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        DB::table('cursos')->delete();
        
        DB::table('cursos')->insert(array (
            0 => 
            array (
                'id_curso' => 1,
                'grado_id_grado' => 1,
                'nombre_curso' => 'Matemáticas',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id_curso' => 2,
                'grado_id_grado' => 1,
                'nombre_curso' => 'Lenguaje',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id_curso' => 3,
                'grado_id_grado' => 1,
                'nombre_curso' => 'Ciencias',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id_curso' => 4,
                'grado_id_grado' => 1,
                'nombre_curso' => 'Historia',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id_curso' => 5,
                'grado_id_grado' => 1,
                'nombre_curso' => 'Geografía',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id_curso' => 6,
                'grado_id_grado' => 1,
                'nombre_curso' => 'Educación Física',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id_curso' => 7,
                'grado_id_grado' => 1,
                'nombre_curso' => 'Arte',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'id_curso' => 8,
                'grado_id_grado' => 1,
                'nombre_curso' => 'Computación',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'id_curso' => 9,
                'grado_id_grado' => 2,
                'nombre_curso' => 'Matemáticas',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'id_curso' => 10,
                'grado_id_grado' => 2,
                'nombre_curso' => 'Lenguaje',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            10 => 
            array (
                'id_curso' => 11,
                'grado_id_grado' => 2,
                'nombre_curso' => 'Ciencias',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            11 => 
            array (
                'id_curso' => 12,
                'grado_id_grado' => 2,
                'nombre_curso' => 'Historia',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            12 => 
            array (
                'id_curso' => 13,
                'grado_id_grado' => 2,
                'nombre_curso' => 'Geografía',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            13 => 
            array (
                'id_curso' => 14,
                'grado_id_grado' => 2,
                'nombre_curso' => 'Educación Física',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            14 => 
            array (
                'id_curso' => 15,
                'grado_id_grado' => 2,
                'nombre_curso' => 'Arte',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            15 => 
            array (
                'id_curso' => 16,
                'grado_id_grado' => 2,
                'nombre_curso' => 'Computación',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            16 => 
            array (
                'id_curso' => 17,
                'grado_id_grado' => 3,
                'nombre_curso' => 'Matemáticas',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            17 => 
            array (
                'id_curso' => 18,
                'grado_id_grado' => 3,
                'nombre_curso' => 'Lenguaje',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            18 => 
            array (
                'id_curso' => 19,
                'grado_id_grado' => 3,
                'nombre_curso' => 'Ciencias',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            19 => 
            array (
                'id_curso' => 20,
                'grado_id_grado' => 3,
                'nombre_curso' => 'Historia',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            20 => 
            array (
                'id_curso' => 21,
                'grado_id_grado' => 3,
                'nombre_curso' => 'Geografía',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            21 => 
            array (
                'id_curso' => 22,
                'grado_id_grado' => 3,
                'nombre_curso' => 'Educación Física',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            22 => 
            array (
                'id_curso' => 23,
                'grado_id_grado' => 3,
                'nombre_curso' => 'Arte',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            23 => 
            array (
                'id_curso' => 24,
                'grado_id_grado' => 3,
                'nombre_curso' => 'Computación',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            24 => 
            array (
                'id_curso' => 25,
                'grado_id_grado' => 4,
                'nombre_curso' => 'Matemáticas',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            25 => 
            array (
                'id_curso' => 26,
                'grado_id_grado' => 4,
                'nombre_curso' => 'Lenguaje',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            26 => 
            array (
                'id_curso' => 27,
                'grado_id_grado' => 4,
                'nombre_curso' => 'Ciencias',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            27 => 
            array (
                'id_curso' => 28,
                'grado_id_grado' => 4,
                'nombre_curso' => 'Historia',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            28 => 
            array (
                'id_curso' => 29,
                'grado_id_grado' => 4,
                'nombre_curso' => 'Geografía',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            29 => 
            array (
                'id_curso' => 30,
                'grado_id_grado' => 4,
                'nombre_curso' => 'Educación Física',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            30 => 
            array (
                'id_curso' => 31,
                'grado_id_grado' => 4,
                'nombre_curso' => 'Arte',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            31 => 
            array (
                'id_curso' => 32,
                'grado_id_grado' => 4,
                'nombre_curso' => 'Computación',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            32 => 
            array (
                'id_curso' => 33,
                'grado_id_grado' => 5,
                'nombre_curso' => 'Matemáticas',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            33 => 
            array (
                'id_curso' => 34,
                'grado_id_grado' => 5,
                'nombre_curso' => 'Lenguaje',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            34 => 
            array (
                'id_curso' => 35,
                'grado_id_grado' => 5,
                'nombre_curso' => 'Ciencias',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            35 => 
            array (
                'id_curso' => 36,
                'grado_id_grado' => 5,
                'nombre_curso' => 'Historia',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            36 => 
            array (
                'id_curso' => 37,
                'grado_id_grado' => 5,
                'nombre_curso' => 'Geografía',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            37 => 
            array (
                'id_curso' => 38,
                'grado_id_grado' => 5,
                'nombre_curso' => 'Educación Física',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            38 => 
            array (
                'id_curso' => 39,
                'grado_id_grado' => 5,
                'nombre_curso' => 'Arte',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            39 => 
            array (
                'id_curso' => 40,
                'grado_id_grado' => 5,
                'nombre_curso' => 'Computación',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            40 => 
            array (
                'id_curso' => 41,
                'grado_id_grado' => 6,
                'nombre_curso' => 'Matemáticas',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            41 => 
            array (
                'id_curso' => 42,
                'grado_id_grado' => 6,
                'nombre_curso' => 'Lenguaje',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            42 => 
            array (
                'id_curso' => 43,
                'grado_id_grado' => 6,
                'nombre_curso' => 'Ciencias',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            43 => 
            array (
                'id_curso' => 44,
                'grado_id_grado' => 6,
                'nombre_curso' => 'Historia',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            44 => 
            array (
                'id_curso' => 45,
                'grado_id_grado' => 6,
                'nombre_curso' => 'Geografía',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            45 => 
            array (
                'id_curso' => 46,
                'grado_id_grado' => 6,
                'nombre_curso' => 'Educación Física',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            46 => 
            array (
                'id_curso' => 47,
                'grado_id_grado' => 6,
                'nombre_curso' => 'Arte',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            47 => 
            array (
                'id_curso' => 48,
                'grado_id_grado' => 6,
                'nombre_curso' => 'Computación',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            48 => 
            array (
                'id_curso' => 49,
                'grado_id_grado' => 7,
                'nombre_curso' => 'Matemáticas',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            49 => 
            array (
                'id_curso' => 50,
                'grado_id_grado' => 7,
                'nombre_curso' => 'Lenguaje',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            50 => 
            array (
                'id_curso' => 51,
                'grado_id_grado' => 7,
                'nombre_curso' => 'Ciencias',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            51 => 
            array (
                'id_curso' => 52,
                'grado_id_grado' => 7,
                'nombre_curso' => 'Historia',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            52 => 
            array (
                'id_curso' => 53,
                'grado_id_grado' => 7,
                'nombre_curso' => 'Geografía',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            53 => 
            array (
                'id_curso' => 54,
                'grado_id_grado' => 7,
                'nombre_curso' => 'Educación Física',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            54 => 
            array (
                'id_curso' => 55,
                'grado_id_grado' => 7,
                'nombre_curso' => 'Arte',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            55 => 
            array (
                'id_curso' => 56,
                'grado_id_grado' => 7,
                'nombre_curso' => 'Computación',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            56 => 
            array (
                'id_curso' => 57,
                'grado_id_grado' => 8,
                'nombre_curso' => 'Matemáticas',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            57 => 
            array (
                'id_curso' => 58,
                'grado_id_grado' => 8,
                'nombre_curso' => 'Lenguaje',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            58 => 
            array (
                'id_curso' => 59,
                'grado_id_grado' => 8,
                'nombre_curso' => 'Ciencias',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            59 => 
            array (
                'id_curso' => 60,
                'grado_id_grado' => 8,
                'nombre_curso' => 'Historia',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            60 => 
            array (
                'id_curso' => 61,
                'grado_id_grado' => 8,
                'nombre_curso' => 'Geografía',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            61 => 
            array (
                'id_curso' => 62,
                'grado_id_grado' => 8,
                'nombre_curso' => 'Educación Física',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            62 => 
            array (
                'id_curso' => 63,
                'grado_id_grado' => 8,
                'nombre_curso' => 'Arte',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            63 => 
            array (
                'id_curso' => 64,
                'grado_id_grado' => 8,
                'nombre_curso' => 'Computación',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            64 => 
            array (
                'id_curso' => 65,
                'grado_id_grado' => 9,
                'nombre_curso' => 'Matemáticas',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            65 => 
            array (
                'id_curso' => 66,
                'grado_id_grado' => 9,
                'nombre_curso' => 'Lenguaje',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            66 => 
            array (
                'id_curso' => 67,
                'grado_id_grado' => 9,
                'nombre_curso' => 'Ciencias',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            67 => 
            array (
                'id_curso' => 68,
                'grado_id_grado' => 9,
                'nombre_curso' => 'Historia',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            68 => 
            array (
                'id_curso' => 69,
                'grado_id_grado' => 9,
                'nombre_curso' => 'Geografía',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            69 => 
            array (
                'id_curso' => 70,
                'grado_id_grado' => 9,
                'nombre_curso' => 'Educación Física',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            70 => 
            array (
                'id_curso' => 71,
                'grado_id_grado' => 9,
                'nombre_curso' => 'Arte',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            71 => 
            array (
                'id_curso' => 72,
                'grado_id_grado' => 9,
                'nombre_curso' => 'Computación',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            72 => 
            array (
                'id_curso' => 73,
                'grado_id_grado' => 10,
                'nombre_curso' => 'Matemáticas',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            73 => 
            array (
                'id_curso' => 74,
                'grado_id_grado' => 10,
                'nombre_curso' => 'Lenguaje',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            74 => 
            array (
                'id_curso' => 75,
                'grado_id_grado' => 10,
                'nombre_curso' => 'Ciencias',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            75 => 
            array (
                'id_curso' => 76,
                'grado_id_grado' => 10,
                'nombre_curso' => 'Historia',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            76 => 
            array (
                'id_curso' => 77,
                'grado_id_grado' => 10,
                'nombre_curso' => 'Geografía',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            77 => 
            array (
                'id_curso' => 78,
                'grado_id_grado' => 10,
                'nombre_curso' => 'Educación Física',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            78 => 
            array (
                'id_curso' => 79,
                'grado_id_grado' => 10,
                'nombre_curso' => 'Arte',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            79 => 
            array (
                'id_curso' => 80,
                'grado_id_grado' => 10,
                'nombre_curso' => 'Computación',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            80 => 
            array (
                'id_curso' => 81,
                'grado_id_grado' => 11,
                'nombre_curso' => 'Matemáticas',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            81 => 
            array (
                'id_curso' => 82,
                'grado_id_grado' => 11,
                'nombre_curso' => 'Lenguaje',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            82 => 
            array (
                'id_curso' => 83,
                'grado_id_grado' => 11,
                'nombre_curso' => 'Ciencias',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            83 => 
            array (
                'id_curso' => 84,
                'grado_id_grado' => 11,
                'nombre_curso' => 'Historia',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            84 => 
            array (
                'id_curso' => 85,
                'grado_id_grado' => 11,
                'nombre_curso' => 'Geografía',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            85 => 
            array (
                'id_curso' => 86,
                'grado_id_grado' => 11,
                'nombre_curso' => 'Educación Física',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            86 => 
            array (
                'id_curso' => 87,
                'grado_id_grado' => 11,
                'nombre_curso' => 'Arte',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            87 => 
            array (
                'id_curso' => 88,
                'grado_id_grado' => 11,
                'nombre_curso' => 'Computación',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}