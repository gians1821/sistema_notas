<?php

namespace Database\Seeders;

use App\Models\Unidad;
use Illuminate\Database\Seeder;

class UnidadesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Unidad::create([
            'descripcion' => 'Kilogramo',
            'estado' => 'A'
        ]);

        Unidad::create([
            'descripcion' => 'Litro',
            'estado' => 'A'
        ]);

        Unidad::create([
            'descripcion' => 'Metro',
            'estado' => 'I'
        ]);

        Unidad::create([
            'descripcion' => 'Unidad',
            'estado' => 'A'
        ]);
    }
}
