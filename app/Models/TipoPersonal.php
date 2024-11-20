<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoPersonal extends Model
{
    use HasFactory;
    protected $table = 'tipo_personals';
    protected $primaryKey = 'id_tipo_personal';
    public $timestamps = false;
    protected $fillable = [
        'nombre_tipopersonal',
    ];

    public function personal(){
        return $this->hasMany(Personal::class,'id_tipo_personal','id_tipo_personal');
    } 
}
