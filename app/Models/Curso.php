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
        return $this->hasOne('App\Models\Grado','id_grado','grado_id_grado');
    } 

}
