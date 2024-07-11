<?php

namespace Database\Seeders;

use App\Models\Libro;
use Illuminate\Database\Seeder;

class LibrosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Libro::create([
            'TitLibro' => 'Cien Años de Soledad',
            'AnoLibro' => '1967',
            'IdAutor' => 1,
            'IdEditorial' => 'ED',
            'Cantidad' => 10
        ]);

        Libro::create([
            'TitLibro' => 'La Casa de los Espíritus',
            'AnoLibro' => '1982',
            'IdAutor' => 2,
            'IdEditorial' => 'PA',
            'Cantidad' => 15
        ]);

        Libro::create([
            'TitLibro' => 'Crónica de una Muerte Anunciada',
            'AnoLibro' => '1981',
            'IdAutor' => 1,
            'IdEditorial' => 'ED',
            'Cantidad' => 8
        ]);
    }
}
