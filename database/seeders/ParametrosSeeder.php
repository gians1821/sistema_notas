<?php

namespace Database\Seeders;

use App\Models\Parametro;
use Illuminate\Database\Seeder;

class ParametrosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $parametros = [
            [
                'numeracion' => '00010',
                'serie' => '001',
            ],
            [
                'numeracion' => '00100',
                'serie' => '002',
            ],
        ];

        foreach ($parametros as $parametro) {
            Parametro::create([
                'numeracion' => $parametro['numeracion'],
                'serie' => $parametro['serie'],
            ]);
        }
    }
}
