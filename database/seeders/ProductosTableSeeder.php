<?php

namespace Database\Seeders;

use App\Models\Producto;
use Illuminate\Database\Seeder;

class ProductosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productos = [
            [
                'descripcion' => 'Producto 1',
                'categoria_id' => '1',
                'unidad_id' => '1',
                'precio' => 120,
                'stock' => 100,
                'estado' => 1,
            ],
            [
                'descripcion' => 'Producto 2',
                'categoria_id' => '2',
                'unidad_id' => '2',
                'precio' => 140,
                'stock' => 50,
                'estado' => 1,
            ],
        ];

        foreach ($productos as $producto) {
            Producto::create($producto);
        }
    }
}
