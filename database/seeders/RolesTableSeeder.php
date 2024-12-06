<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        DB::table('roles')->delete();
        
        DB::table('roles')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Admin',
                'guard_name' => 'web',
                'created_at' => '2024-08-15 02:20:03',
                'updated_at' => '2024-08-15 02:20:03',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Docente',
                'guard_name' => 'web',
                'created_at' => '2024-08-15 02:20:03',
                'updated_at' => '2024-08-15 02:20:03',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Padre',
                'guard_name' => 'web',
                'created_at' => '2024-08-15 06:38:44',
                'updated_at' => '2024-08-15 06:38:44',
            ),
            3 => 
            array (
                'id' => 5,
                'name' => 'Secretaria',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}