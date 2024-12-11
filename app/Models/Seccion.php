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
}
