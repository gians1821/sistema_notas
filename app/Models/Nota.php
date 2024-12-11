<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    use HasFactory;

    protected $primaryKey = null;

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

}
