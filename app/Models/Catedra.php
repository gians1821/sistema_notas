<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catedra extends Model
{
    use HasFactory;

    protected $table = 'catedras';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = ['periodo_id', 'docente_id', 'curso_id'];

    public function curso()
    {
        return $this->hasOne('App\Models\Curso', 'id_curso', 'curso_id');
    }

    public function periodo()
    {
        return $this->belongsTo(Periodo::class);
    }

    public function docente()
    {
        return $this->belongsTo(Personal::class);
    }
}
