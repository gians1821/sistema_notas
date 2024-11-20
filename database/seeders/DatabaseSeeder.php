<?php

namespace Database\Seeders;

use App\Models\Curso;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // User::factory(10)->create();
        // $this->call(RoleSeeder::class);
        //Curso::factory(12)->create();
        User::Create([
            'name' => 'Fabian Ruiz',
            'email' => 'fruiz@mail.com',
            'password' => bcrypt('123456789')
        ])->assignRole('Padre');

        //User::factory(99)->create();

    }
}
