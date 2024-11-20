<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CursoHasAlumno extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $primaryKey = null;

    protected $table = 'curso_has_alumnos';

    protected function setKeysForSaveQuery($query)
    {
        $keys = $this->getKeyName();
        if (!is_array($keys)) {
            return parent::setKeysForSaveQuery($query);
        }

        foreach ($keys as $keyName) {
            $query->where($keyName, '=', $this->getAttribute($keyName));
        }

        return $query;
    }

    protected $fillable = [
        'curso_id_curso',
        'alumno_id_alumno',
        'nota1',
        'nota2',
        'nota3'
    ];

    public function curso()
    {
        return $this->hasOne('App\Models\Curso', 'id_curso', 'curso_id_curso');
    }

    public function alumno()
    {
        return $this->hasOne('App\Models\Alumno', 'id_alumno', 'alumno_id_alumno');
    }

    public function getKeyName()
    {
        return ['curso_id_curso', 'alumno_id_alumno'];
    }
}
