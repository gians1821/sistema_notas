<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Padre extends Model
{
    use HasFactory;

    protected $table = 'padres';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'dni',
        'nombres',
        'apellidos',
        'id_users',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_users'); 
    }

    public function alumnos()
    {
        return $this->hasMany(Alumno::class, 'id');
    }


}
