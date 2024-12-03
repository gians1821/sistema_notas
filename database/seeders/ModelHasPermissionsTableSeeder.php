<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ModelHasPermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('model_has_permissions')->delete();
        
        \DB::table('model_has_permissions')->insert(array (
            0 => 
            array (
                'permission_id' => 6,
                'model_type' => 'App\\Models\\User',
                'model_id' => 1,
            ),
            1 => 
            array (
                'permission_id' => 18,
                'model_type' => 'App\\Models\\User',
                'model_id' => 1,
            ),
            2 => 
            array (
                'permission_id' => 26,
                'model_type' => 'App\\Models\\User',
                'model_id' => 1,
            ),
            3 => 
            array (
                'permission_id' => 27,
                'model_type' => 'App\\Models\\User',
                'model_id' => 1,
            ),
            4 => 
            array (
                'permission_id' => 28,
                'model_type' => 'App\\Models\\User',
                'model_id' => 1,
            ),
            5 => 
            array (
                'permission_id' => 1,
                'model_type' => 'App\\Models\\User',
                'model_id' => 2,
            ),
            6 => 
            array (
                'permission_id' => 2,
                'model_type' => 'App\\Models\\User',
                'model_id' => 2,
            ),
            7 => 
            array (
                'permission_id' => 3,
                'model_type' => 'App\\Models\\User',
                'model_id' => 2,
            ),
            8 => 
            array (
                'permission_id' => 4,
                'model_type' => 'App\\Models\\User',
                'model_id' => 2,
            ),
            9 => 
            array (
                'permission_id' => 5,
                'model_type' => 'App\\Models\\User',
                'model_id' => 2,
            ),
            10 => 
            array (
                'permission_id' => 6,
                'model_type' => 'App\\Models\\User',
                'model_id' => 2,
            ),
            11 => 
            array (
                'permission_id' => 7,
                'model_type' => 'App\\Models\\User',
                'model_id' => 2,
            ),
            12 => 
            array (
                'permission_id' => 8,
                'model_type' => 'App\\Models\\User',
                'model_id' => 2,
            ),
            13 => 
            array (
                'permission_id' => 9,
                'model_type' => 'App\\Models\\User',
                'model_id' => 2,
            ),
            14 => 
            array (
                'permission_id' => 10,
                'model_type' => 'App\\Models\\User',
                'model_id' => 2,
            ),
            15 => 
            array (
                'permission_id' => 11,
                'model_type' => 'App\\Models\\User',
                'model_id' => 2,
            ),
            16 => 
            array (
                'permission_id' => 12,
                'model_type' => 'App\\Models\\User',
                'model_id' => 2,
            ),
            17 => 
            array (
                'permission_id' => 13,
                'model_type' => 'App\\Models\\User',
                'model_id' => 2,
            ),
            18 => 
            array (
                'permission_id' => 14,
                'model_type' => 'App\\Models\\User',
                'model_id' => 2,
            ),
            19 => 
            array (
                'permission_id' => 15,
                'model_type' => 'App\\Models\\User',
                'model_id' => 2,
            ),
            20 => 
            array (
                'permission_id' => 16,
                'model_type' => 'App\\Models\\User',
                'model_id' => 2,
            ),
            21 => 
            array (
                'permission_id' => 17,
                'model_type' => 'App\\Models\\User',
                'model_id' => 2,
            ),
            22 => 
            array (
                'permission_id' => 18,
                'model_type' => 'App\\Models\\User',
                'model_id' => 2,
            ),
            23 => 
            array (
                'permission_id' => 19,
                'model_type' => 'App\\Models\\User',
                'model_id' => 2,
            ),
            24 => 
            array (
                'permission_id' => 20,
                'model_type' => 'App\\Models\\User',
                'model_id' => 2,
            ),
            25 => 
            array (
                'permission_id' => 21,
                'model_type' => 'App\\Models\\User',
                'model_id' => 2,
            ),
            26 => 
            array (
                'permission_id' => 22,
                'model_type' => 'App\\Models\\User',
                'model_id' => 2,
            ),
            27 => 
            array (
                'permission_id' => 23,
                'model_type' => 'App\\Models\\User',
                'model_id' => 2,
            ),
            28 => 
            array (
                'permission_id' => 24,
                'model_type' => 'App\\Models\\User',
                'model_id' => 2,
            ),
            29 => 
            array (
                'permission_id' => 25,
                'model_type' => 'App\\Models\\User',
                'model_id' => 2,
            ),
            30 => 
            array (
                'permission_id' => 26,
                'model_type' => 'App\\Models\\User',
                'model_id' => 2,
            ),
            31 => 
            array (
                'permission_id' => 27,
                'model_type' => 'App\\Models\\User',
                'model_id' => 2,
            ),
            32 => 
            array (
                'permission_id' => 28,
                'model_type' => 'App\\Models\\User',
                'model_id' => 2,
            ),
        ));
        
        
    }
}