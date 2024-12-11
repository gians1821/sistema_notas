<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;
    protected $table = 'cursos';
    protected $primaryKey  = 'id_curso';
    public $timestamps = true;

    protected $fillable=['grado_id_grado','nombre_curso'];              

    public function grado(){
        return $this->belongsTo(Grado::class, 'grado_id_grado');
    }

    public function catedra()
    {
        return $this->hasOne(Catedra::class, 'curso_id');
    }

}
