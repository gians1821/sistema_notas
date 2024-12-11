<?php

namespace Database\Seeders;

use App\Models\Capacidad;
use App\Models\Curso;
use Illuminate\Database\Seeder;

class CompetenciasTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        // Definir competencias por curso, como en el ejemplo de arriba
        $competenciasPorCurso = [
            'Matemáticas' => [
                'Problemas Matemáticos',
                'Conceptos Algebraicos',
                'Datos Estadísticos'
            ],
            'Lenguaje' => [
                'Comprensión de Textos',
                'Expresión Clara',
                'Análisis Literario'
            ],
            'Ciencias' => [
                'Fenómenos Naturales',
                'Método Científico',
                'Impacto Científico'
            ],
            'Historia' => [
                'Procesos Históricos',
                'Análisis de Fuentes',
                'Contexto Actual'
            ],
            'Geografía' => [
                'Regiones Geográficas',
                'Análisis de Mapas',
                'Medioambiente y Sociedad'
            ],
            'Educación Física' => [
                'Destrezas Deportivas',
                'Importancia del Ejercicio',
                'Trabajo en Equipo'
            ],
            'Arte' => [
                'Expresión Artística',
                'Valor Cultural',
                'Análisis de Obras'
            ],
            'Computación' => [
                'Fundamentos de Prog.',
                'Problemas Lógicos',
                'Herramientas Digitales'
            ],
        ];

        // Obtener todos los cursos (si son 88 cursos, ajusta la lógica)
        $cursos = Curso::all(); // O limitar si necesitas solo ciertos cursos

        foreach ($cursos as $curso) {
            $nombreCurso = $curso->nombre_curso;

            // Verifica si hay competencias definidas para este curso
            if (isset($competenciasPorCurso[$nombreCurso])) {
                foreach ($competenciasPorCurso[$nombreCurso] as $nombreCompetencia) {
                    Capacidad::create([
                        'id_curso' => $curso->id_curso,
                        'nombre_competencia' => $nombreCompetencia,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            } else {
                // Si el curso no está en la lista, puedes crear competencias genéricas
                // o dejarlo sin competencias. Aquí un ejemplo de competencias genéricas:
                Capacidad::create([
                    'id_curso' => $curso->id_curso,
                    'nombre_competencia' => "Competencia genérica 1 para {$nombreCurso}",
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                Capacidad::create([
                    'id_curso' => $curso->id_curso,
                    'nombre_competencia' => "Competencia genérica 2 para {$nombreCurso}",
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                Capacidad::create([
                    'id_curso' => $curso->id_curso,
                    'nombre_competencia' => "Competencia genérica 3 para {$nombreCurso}",
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        $this->command->info('Se han creado 3 competencias únicas para cada curso.');
        
        
    }
}