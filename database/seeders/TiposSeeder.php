<?php

namespace Database\Seeders;

use App\Models\Tipo;
use Illuminate\Database\Seeder;

class TiposSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipos = [
            [
                'descripcion' => 'FACTURA',
            ],
            [
                'descripcion' => 'BOLETA',
            ],
        ];

        foreach ($tipos as $tipo) {
            Tipo::create([
                'descripcion' => $tipo['descripcion'],
            ]);
        }
    }
}
