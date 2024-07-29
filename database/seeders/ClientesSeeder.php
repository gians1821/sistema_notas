<?php

namespace Database\Seeders;

use App\Models\Cliente;
use Illuminate\Database\Seeder;

class ClientesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clientes = [
            [
                'ruc_dni' => '12345678',
                'nombres' => 'Jorge Campos',
                'email' => 'jcampos@hotmail.com',
                'direccion' => 'Los portales',
            ],
            [
                'ruc_dni' => '87654321',
                'nombres' => 'Pedro Ruiz',
                'email' => 'pruiz@hotmail.com',
                'direccion' => 'Segoviano',
            ],
        ];

        foreach ($clientes as $cliente) {
            Cliente::create([
                'ruc_dni' => $cliente['ruc_dni'],
                'nombres' => $cliente['nombres'],
                'email' => $cliente['email'],
                'direccion' => $cliente['direccion'],
            ]);
        }
    }
}
