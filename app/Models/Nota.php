<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $table = 'notas';
    public $timestamps = true;

    protected $fillable = [
        'catedra_id',
        'alumno_id_alumno',
        'competencia_id',
        'nota1',
        'nota2',
        'nota3',
        'nota_final',
        'visibilidad'
    ];

    public function catedra()
    {
        return $this->belongsTo(Catedra::class, 'catedra_id');
    }

    public function alumno()
    {
        return $this->hasOne('App\Models\Alumno', 'id_alumno', 'alumno_id_alumno');
    }

    public function competencia()
    {
        return $this->belongsTo(Capacidad::class, 'competencia_id');
    }

    /**
     * Obtener el nombre del curso desde la relación con la cátedra.
     * Asumiendo que $nota->catedra->curso->nombre_curso existe.
     */
    public function getNombreCursoAttribute()
    {
        if ($this->catedra && $this->catedra->curso) {
            return $this->catedra->curso->nombre_curso;
        }
        return 'Sin Curso';
    }

    /**
     * Obtener el nombre de la competencia desde la relación con la capacidad.
     * Asumiendo que $nota->competencia->nombre_competencia existe.
     */
    public function getNombreCompetenciaAttribute()
    {
        if ($this->competencia) {
            return $this->competencia->nombre_competencia;
        }
        return 'Sin Competencia';
    }

    /**
     * Obtener el nombre completo del alumno.
     */
    public function getNombreAlumnoAttribute()
    {
        if ($this->alumno) {
            return "{$this->alumno->nombre_alumno} {$this->alumno->apellido_alumno}";
        }
        return 'Sin Alumno';
    }

}
