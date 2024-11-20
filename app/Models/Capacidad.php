<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Capacidad extends Model
{
    use HasFactory;
    protected $table = 'competencias';
    protected $primaryKey  = 'id_competencia';
    public $timestamps = true;

    protected $fillable=['id_curso','nombre_competencia'];
    
    public function curso(){
        return $this->hasOne('App\Models\Curso','id_curso','id_curso');
    } 

}
