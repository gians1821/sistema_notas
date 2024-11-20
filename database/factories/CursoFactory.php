<?php

namespace Database\Factories;
use App\Models\Curso;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Curso>
 */
class CursoFactory extends Factory
{

    protected $model = Curso::class;
    protected static $baseCreatedAt;
    public function definition():array 
    {
// Inicializa la fecha base si aún no está establecida
        if (!self::$baseCreatedAt) {
            self::$baseCreatedAt = Carbon::create(2024, 7, 27, 0, 0, 0); 
        }

        // Incrementa la fecha base en un día y algunas horas para cada nuevo registro
        $createdAt = Carbon::create(2024, 8, 14, rand(8, 19), rand(0, 59), 0);

        return [
            'grado_id_grado' => 11,
            'nombre_curso' => $this->faker->sentence(1), // Texto de hasta 30 caracteres
            'created_at' => $createdAt,
            'updated_at' => $createdAt,
        ];
    }
}
