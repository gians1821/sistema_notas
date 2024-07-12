<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Seeder;

class CategoriasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categorias = [
            [
                'descripcion' => 'Bebidas',
                'estado' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'descripcion' => 'Snacks',
                'estado' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'descripcion' => 'Limpieza',
                'estado' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];
        foreach ($categorias as $categoria) {
            Categoria::create($categoria);
        }
    }
}
