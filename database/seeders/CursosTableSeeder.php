<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CursosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('cursos')->delete();
        
        
        
    }
}