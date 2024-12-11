<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promedio extends Model
{
    use HasFactory;
    
    protected $table = 'promedio';
    protected $primaryKey = 'id';
    protected $fillable = ['valor','alumno_id_alumno'];
    public $timestamps = false;

    public function alumno()
    {
        return $this->belongsTo(Alumno::class, 'alumno_id_alumno');
    }
}
