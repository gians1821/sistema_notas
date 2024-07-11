<?php

namespace Database\Seeders;

use App\Models\Autor;
use Illuminate\Database\Seeder;

class AutoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Autor::create([
            'ApeAutor' => 'García',
            'NomAutor' => 'Gabriel'
        ]);

        Autor::create([
            'ApeAutor' => 'Vargas',
            'NomAutor' => 'Mario'
        ]);
    }
}
