<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;
    protected $table = 'alumnos';
    protected $primaryKey = 'id_alumno';
    public $timestamps = false;
    protected $fillable = [
        'id_alumno','nombre_alumno', 'apellido_alumno',
    ];

    public function Seccion()
    {
        return $this->belongsTo(Seccion::class,'seccion_id_seccion','id_seccion');
    }

    public function padre()
    {
        return $this->belongsTo(Padre::class, 'padre_id'); 
    }

    public function promedios()
    {
        return $this->hasMany(Promedio::class, 'alumno_id_alumno', 'id_alumno');
    }


}
