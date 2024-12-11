<?php

namespace Database\Seeders;

use App\Models\Catedra;
use App\Models\Curso;
use App\Models\Personal;
use App\Models\Seccion;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CatedrasTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        // Definir el ID del periodo
        $periodo_id = 2;

        // Obtener todos los cursos, docentes y secciones ordenados por ID
        $cursos = Curso::orderBy('id_curso')->get(); // 88 cursos
        $docentes = Personal::where('id_tipo_personal', '1')->orderBy('id_personal')->get(); // 88 docentes
        $secciones = Seccion::orderBy('id_seccion')->get(); // 33 secciones

        // Validar la cantidad de registros
        if ($cursos->count() < 88 || $docentes->count() < 88 || $secciones->count() < 33) {
            $this->command->error('No hay suficientes registros en una o más tablas.');
            return;
        }

        $competenciasAInsertar = [];

        foreach ($cursos as $index => $curso) {
            $docente = $docentes[$index];
            $grado_id = $curso->grado_id_grado;
            $seccionesDelGrado = Seccion::where('grado_id_grado', $grado_id)->get();

            foreach ($seccionesDelGrado as $seccion) {
                // Verificar si ya existe una cátedra para este curso y seccion
                $exists = Catedra::where('curso_id', $curso->id_curso)
                    ->where('seccion_id', $seccion->id_seccion)
                    ->exists();
                if ($exists) {
                    $this->command->info("Cátedra para curso_id {$curso->id_curso} y seccion_id {$seccion->id_seccion} ya existe. Se omite la creación.");
                    continue;
                }

                $competenciasAInsertar[] = [
                    'periodo_id' => $periodo_id,
                    'docente_id' => $docente->id_personal,
                    'curso_id' => $curso->id_curso,
                    'seccion_id' => $seccion->id_seccion,
                ];
            }
        }

        // Insertar todas las cátedras de una vez
        if (!empty($competenciasAInsertar)) {
            try {
                Catedra::insert($competenciasAInsertar);
                $this->command->info('Se han creado 264 cátedras asignando docentes a cursos y secciones.');
            } catch (\Exception $e) {
                $this->command->error('Error al insertar cátedras: ' . $e->getMessage());
            }
        } else {
            $this->command->info('No hay cátedras nuevas para insertar.');
        }
    }
}
