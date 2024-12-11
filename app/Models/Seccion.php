<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seccion extends Model
{
    protected $table = 'seccions';
    protected $primaryKey  = 'id_seccion';
    public $timestamps = false;

    protected $fillable = ['nombre_seccion', 'capacidad', 'grado_id_grado'];

    public function grado()
    {
        return $this->hasOne(Grado::class, 'id_grado', 'grado_id_grado');
    }

    public function catedra()
    {
        return $this->hasOne(Catedra::class, 'seccion_id');
    }

    public function Alumno()
    {
        return $this->hasMany(Alumno::class, 'id_seccion', 'seccion_id_seccion');
    }

    /**
     * Accesor para obtener el nombre completo de la sección.
     * Formato: "{nombre_grado} {nombre_seccion} de {nombre_nivel}"
     */
    public function getSeccionNombreCompletoAttribute()
    {
        // Asegúrate de que la relación con 'grado' y 'nivel' estén cargadas (eager loading) o accede a ellas sin problemas
        if ($this->grado && $this->grado->nivel) {
            return "{$this->grado->nombre_grado} {$this->nombre_seccion} de {$this->grado->nivel->nombre_nivel}";
        }

        return 'Información incompleta';
    }
}
