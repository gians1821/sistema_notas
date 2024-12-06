<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CursoHasAlumnosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('curso_has_alumnos')->delete();
        
        
        
    }
}