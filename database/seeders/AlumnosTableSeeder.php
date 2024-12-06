<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AlumnosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('alumnos')->delete();
        
        
        
    }
}