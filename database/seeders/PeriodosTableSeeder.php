<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeriodosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        DB::table('periodos')->delete();
        
        DB::table('periodos')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => '2023',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => '2024',
            ),
        ));
        
        
    }
}