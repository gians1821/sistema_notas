<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grado extends Model
{
    protected $table = 'grados';
    protected $primaryKey  = 'id_grado';
    public $timestamps = false;

    protected $fillable=[
        'id_nivel','nombre_grado'
    ];

    public function nivel(){
        return $this->hasOne('App\Models\Nivel','id_nivel','id_nivel');
    } 

    public function seccion(){
        return $this->hasMany(Seccion::class,'id_grado','grado_id_grado');
    } 

    public function curso(){
        return $this->hasMany(Curso::class,'id_grado','grado_id_grado');
    } 
}
