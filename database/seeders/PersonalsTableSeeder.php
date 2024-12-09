<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PersonalsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('personals')->delete();

        $names = ['Juan', 'María', 'Luis', 'Ana', 'Carlos', 'Sofía', 'Miguel', 'Lucía', 'Pedro', 'Isabel', 'Javier', 'Clara', 'Andrés', 'Verónica', 'Raúl', 'Elena', 'José', 'Victoria', 'David', 'Patricia', 'Ricardo', 'Beatriz', 'Felipe', 'Sara', 'Álvaro', 'Carmen', 'Antonio', 'Laura', 'Fernando', 'Marta', 'Pablo'];
        $surnames = ['Pérez', 'Gómez', 'López', 'Martínez', 'Hernández', 'Torres', 'Ramírez', 'Cruz', 'Sánchez', 'González', 'Jiménez', 'Vázquez', 'Méndez', 'Ruiz', 'Moreno', 'Álvarez', 'Ortíz', 'Muñoz', 'Díaz', 'Pascual', 'Castro', 'Gil', 'Ramos', 'Navarro', 'Serrano', 'Cabrera', 'Paredes', 'Salazar', 'Iglesias', 'Marín'];
        $personalTypes = [1, 2, 3]; // Ejemplo: 1=Profesor, 2=Coordinador, 3=Asistente
        $period = '2024'; // Ejemplo: Periodo académico actual
        $courseCount = 88; // Total de cursos

        $personals = [];

        for ($i = 1; $i <= $courseCount; $i++) {
            $randomName = $names[array_rand($names)];
            $randomSurname = $surnames[array_rand($surnames)];
            $dni = rand(10000000, 99999999); // Generar un DNI ficticio
            $address = 'Calle Ficticia #' . rand(1, 100);
            $birthdate = Carbon::now()->subYears(rand(25, 50))->format('Y-m-d'); // Generar una fecha de nacimiento
            $phone = '555-' . rand(1000, 9999);
            $personalType = $personalTypes[array_rand($personalTypes)];

            $personals[] = [
                'id_personal' => $i,
                'periodo' => $period,
                'id_tipo_personal' => $personalType,
                'nombre' => $randomName,
                'apellido' => $randomSurname,
                'dNI' => $dni,
                'direccion' => $address,
                'fecha_nacimiento' => $birthdate,
                'telefono' => $phone,
                'curso_id_curso' => $i,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('personals')->insert($personals);
    }
}

