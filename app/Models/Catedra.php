<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catedra extends Model
{
    use HasFactory;

    protected $table = 'catedras';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = ['periodo_id', 'docente_id', 'curso_id', 'seccion_id'];

    public function periodo()
    {
        return $this->belongTo(Periodo::class, 'periodo_id');
    }

    public function docente()
    {
        return $this->belongTo(Personal::class, 'docente_id');
    }

    public function curso()
    {
        return $this->belongTo(Curso::class, 'curso_id');
    }

    public function seccion()
    {
        return $this->belongTo(Seccion::class, 'seccion_id');
    }

    // **Definición del Accessor**
    public function getDocenteFullnameAttribute()
    {
        // Verificar que la relación 'docente' esté cargada y no sea nula
        if ($this->docente) {
            return "{$this->docente->nombre} {$this->docente->apellido}";
        }

        return 'Sin Docente';
    }

    // **Definición del Accessor**
    public function getCursoCompletoAttribute()
    {
        if ($this->curso) {
            return "{$this->curso->nombre_curso} de {$this->seccion->grado->nombre_grado} {$this->seccion->nombre_seccion} de {$this->seccion->grado->nivel->nombre_nivel}";
        }

        return 'Sin Curso asignado en Cátedra';
    }
}
