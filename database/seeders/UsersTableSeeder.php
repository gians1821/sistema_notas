<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        DB::table('users')->delete();
        
        DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'GianFranco',
                'email' => 'Gian@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$12$k1auoB0YUcXdcQihVTHmeuDR3irqL7hhp2cwWAiWKmlgd91o2hMOy',
                'remember_token' => NULL,
                'created_at' => '2024-08-15 02:22:08',
                'updated_at' => '2024-08-15 04:04:59',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Jhonatan',
                'email' => 'Jm@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$12$YwBp.OzykM3oke2f8kxgqe5Y1sDj0AnR4d7/e.OBCFELX0oDdSkye',
                'remember_token' => NULL,
                'created_at' => '2024-08-15 02:22:41',
                'updated_at' => '2024-08-15 04:05:19',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Fabian Ruiz',
                'email' => 'fruiz@mail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$12$PRO.GF7682LwQsGwuE3Jru.geBFdHAOSN7hzZxSz/765Lw2Ru30Ia',
                'remember_token' => NULL,
                'created_at' => '2024-08-15 06:40:55',
                'updated_at' => '2024-08-15 06:40:55',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Secretaria',
                'email' => 'secretaria@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$12$.MYT.P7bnwPrQJeMKWEB9eiOnZUlz.DpShe/0kAMbC/EdJnVUc3nm',
                'remember_token' => NULL,
                'created_at' => '2024-11-21 05:53:17',
                'updated_at' => '2024-11-21 05:53:17',
            ),
            4 => 
            array (
                'id' => 6,
                'name' => 'Gian',
                'email' => 'gianfrancosr182015@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$12$mpwkq3sT5DsGERrxbb8Hmux7sjOLxPKHMKf/hC3kHROLtzlwGS/I2',
                'remember_token' => NULL,
                'created_at' => '2024-11-24 21:42:45',
                'updated_at' => '2024-11-24 21:43:58',
            ),
            5 => 
            array (
                'id' => 7,
                'name' => 'PRUEBA',
                'email' => 'mail@mail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$12$4o3nfe4qNimZw.Sa.z8uf.T69xJvwz6eVJZaS9EMLtwprXlKKcv/a',
                'remember_token' => NULL,
                'created_at' => '2024-12-05 16:01:03',
                'updated_at' => '2024-12-05 16:01:03',
            ),
        ));
        
        
    }
}