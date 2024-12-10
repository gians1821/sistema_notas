<?php

namespace Database\Seeders;

use App\Models\Personal;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class PersonalsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = ['Juan', 'María', 'Luis', 'Ana', 'Carlos', 'Sofía', 'Miguel', 'Lucía', 'Pedro', 'Isabel', 'Javier', 'Clara', 'Andrés', 'Verónica', 'Raúl', 'Elena', 'José', 'Victoria', 'David', 'Patricia', 'Ricardo', 'Beatriz', 'Felipe', 'Sara', 'Álvaro', 'Carmen', 'Antonio', 'Laura', 'Fernando', 'Marta', 'Pablo'];
        $surnames = ['Pérez', 'Gómez', 'López', 'Martínez', 'Hernández', 'Torres', 'Ramírez', 'Cruz', 'Sánchez', 'González', 'Jiménez', 'Vázquez', 'Méndez', 'Ruiz', 'Moreno', 'Álvarez', 'Ortíz', 'Muñoz', 'Díaz', 'Pascual', 'Castro', 'Gil', 'Ramos', 'Navarro', 'Serrano', 'Cabrera', 'Paredes', 'Salazar', 'Iglesias', 'Marín'];

        $personalTypes = [1];
        $courseCount = 88; // Total de cursos

        // Obtenemos el rol de Docente
        $rolDocente = Role::where('name', 'Docente')->first();

        for ($i = 1; $i <= $courseCount; $i++) {
            $randomName = $names[array_rand($names)];
            $randomSurname = $surnames[array_rand($surnames)];
            $dni = rand(10000000, 99999999);
            $address = 'Calle Ficticia #' . rand(1, 100);
            $birthdate = Carbon::now()->subYears(rand(25, 50))->format('Y-m-d');
            $phone = '555-' . rand(1000, 9999);
            $personalType = $personalTypes[array_rand($personalTypes)];

            // Crear username y email basados en nombre y apellido
            $username = strtolower($randomName . '.' . $randomSurname . $i);
            $email = $username . '@example.com';

            // Crear el usuario
            $user = new User();
            $user->name = $username;
            $user->email = $email;
            $user->password = Hash::make('password123'); // contraseña genérica
            $user->save();

            // Crear el personal
            $personal = new Personal();
            $personal->id_personal = $i;
            $personal->id_tipo_personal = $personalType;
            $personal->nombre = $randomName;
            $personal->apellido = $randomSurname;
            $personal->dni = $dni;
            $personal->direccion = $address;
            $personal->fecha_nacimiento = $birthdate;
            $personal->telefono = $phone;
            $personal->user_id = $user->id; // Relación con el usuario
            $personal->created_at = now();
            $personal->updated_at = now();
            $personal->save();

            // Si el tipo personal es 1 (DOCENTE), asignar el rol de Docente
            if ($personalType === 1 && $rolDocente) {
                DB::table('model_has_roles')->insert([
                    'role_id' => $rolDocente->id,
                    'model_id' => $user->id,
                    'model_type' => User::class,
                ]);
            }
        }

        $this->command->info('Tabla personals y usuarios creados correctamente con el rol docente asignado a docentes.');
    }
}
