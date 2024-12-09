<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    use HasFactory;
    protected $table = 'personals';
    protected $primaryKey = 'id_personal';
    public $timestamps = true;
    protected $fillable = [
        'id_tipo_personal','nombre', 'apellido', 'dNI', 'direccion', 'fecha_nacimiento','telefono','curso_id_curso',
    ];

    public function tipopersonal(){
        return $this->hasOne('App\Models\TipoPersonal', 'id_tipo_personal', 'id_tipo_personal');
    } 

    public function curso() {
        return $this->belongsTo('App\Models\Curso', 'curso_id_curso', 'id_curso');
    }

}


