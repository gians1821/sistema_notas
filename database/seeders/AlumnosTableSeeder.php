<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AlumnosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('alumnos')->delete();
        
        \DB::table('alumnos')->insert(array (
            0 => 
            array (
                'id_alumno' => 1,
                'periodo' => '2023',
                'nombre_alumno' => 'GIAN',
                'apellido_alumno' => 'SAMANA',
                'fecha_nacimiento' => '2005-01-18',
                'dni' => '75729466',
                'pais' => 'PERÚ',
                'region' => 'LA LIBERTAD',
                'ciudad' => 'TRUJILLO',
                'distrito' => 'TRUJILLO',
                'estado_civil' => 'SOLTERO',
                'telefono' => '949547448',
                'seccion_id_seccion' => 5,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id_alumno' => 2,
                'periodo' => '2023',
                'nombre_alumno' => 'JUAN',
                'apellido_alumno' => 'PEREZ',
                'fecha_nacimiento' => '2004-06-15',
                'dni' => '76543210',
                'pais' => 'PERÚ',
                'region' => 'LIMA',
                'ciudad' => 'LIMA',
                'distrito' => 'MIRAFLORES',
                'estado_civil' => 'SOLTERO',
                'telefono' => '945123456',
                'seccion_id_seccion' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id_alumno' => 3,
                'periodo' => '2023',
                'nombre_alumno' => 'MARIA',
                'apellido_alumno' => 'LOPEZ',
                'fecha_nacimiento' => '2003-02-10',
                'dni' => '87654321',
                'pais' => 'PERÚ',
                'region' => 'CUSCO',
                'ciudad' => 'CUSCO',
                'distrito' => 'WANCHAQ',
                'estado_civil' => 'CASADO',
                'telefono' => '934567890',
                'seccion_id_seccion' => 3,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id_alumno' => 4,
                'periodo' => '2023',
                'nombre_alumno' => 'CARLOS',
                'apellido_alumno' => 'RAMIREZ',
                'fecha_nacimiento' => '2005-05-12',
                'dni' => '65432198',
                'pais' => 'PERÚ',
                'region' => 'AREQUIPA',
                'ciudad' => 'AREQUIPA',
                'distrito' => 'YANAHUARA',
                'estado_civil' => 'SOLTERO',
                'telefono' => '998765432',
                'seccion_id_seccion' => 4,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id_alumno' => 5,
                'periodo' => '2023',
                'nombre_alumno' => 'ANA',
                'apellido_alumno' => 'GUTIERREZ',
                'fecha_nacimiento' => '2006-07-08',
                'dni' => '87654312',
                'pais' => 'PERÚ',
                'region' => 'TACNA',
                'ciudad' => 'TACNA',
                'distrito' => 'CENTRO',
                'estado_civil' => 'SOLTERO',
                'telefono' => '987654321',
                'seccion_id_seccion' => 2,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id_alumno' => 6,
                'periodo' => '2023',
                'nombre_alumno' => 'PEDRO',
                'apellido_alumno' => 'CASTRO',
                'fecha_nacimiento' => '2005-03-20',
                'dni' => '12345678',
                'pais' => 'PERÚ',
                'region' => 'PIURA',
                'ciudad' => 'PIURA',
                'distrito' => 'CASTILLA',
                'estado_civil' => 'VIUDO',
                'telefono' => '912345678',
                'seccion_id_seccion' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id_alumno' => 7,
                'periodo' => '2023',
                'nombre_alumno' => 'SOFIA',
                'apellido_alumno' => 'MORALES',
                'fecha_nacimiento' => '2004-11-23',
                'dni' => '56789012',
                'pais' => 'PERÚ',
                'region' => 'LAMBAYEQUE',
                'ciudad' => 'CHICLAYO',
                'distrito' => 'PIMENTEL',
                'estado_civil' => 'SOLTERO',
                'telefono' => '923456789',
                'seccion_id_seccion' => 2,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'id_alumno' => 8,
                'periodo' => '2023',
                'nombre_alumno' => 'MIGUEL',
                'apellido_alumno' => 'TORRES',
                'fecha_nacimiento' => '2006-01-10',
                'dni' => '34567891',
                'pais' => 'PERÚ',
                'region' => 'ICA',
                'ciudad' => 'ICA',
                'distrito' => 'PARCONA',
                'estado_civil' => 'CASADO',
                'telefono' => '934567123',
                'seccion_id_seccion' => 4,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'id_alumno' => 9,
                'periodo' => '2023',
                'nombre_alumno' => 'LUCIA',
                'apellido_alumno' => 'VELASQUEZ',
                'fecha_nacimiento' => '2003-09-30',
                'dni' => '78901234',
                'pais' => 'PERÚ',
                'region' => 'HUANCAVELICA',
                'ciudad' => 'HUANCAVELICA',
                'distrito' => 'ACOBAMBA',
                'estado_civil' => 'DIVORCIADO',
                'telefono' => '945678912',
                'seccion_id_seccion' => 3,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}