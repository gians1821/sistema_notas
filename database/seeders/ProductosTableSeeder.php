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
                'descripcion' => 'Fanta',
                'categoria_id' => '1',
                'unidad_id' => '4',
                'precio' => 6,
                'stock' => 100,
                'estado' => 1,
            ],
            [
                'descripcion' => 'Trapeador',
                'categoria_id' => '2',
                'unidad_id' => '4',
                'precio' => 15,
                'stock' => 50,
                'estado' => 1,
            ],
        ];

        foreach ($productos as $producto) {
            Producto::create($producto);
        }
    }
}
