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
            'estado' => '1'
        ]);

        Unidad::create([
            'descripcion' => 'Litro',
            'estado' => '1'
        ]);

        Unidad::create([
            'descripcion' => 'Metro',
            'estado' => '1'
        ]);

        Unidad::create([
            'descripcion' => 'Unidad',
            'estado' => '1'
        ]);
    }
}
