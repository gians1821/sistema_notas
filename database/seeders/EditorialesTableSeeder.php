<?php

namespace Database\Seeders;

use App\Models\Editorial;
use Illuminate\Database\Seeder;

class EditorialesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Editorial::create([
            'IdEditorial' => 'ED',
            'DesEditorial' => 'Editorial Destino'
        ]);

        Editorial::create([
            'IdEditorial' => 'PA',
            'DesEditorial' => 'Plaza & Janés'
        ]);
    }
}
