<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nivel extends Model
{
    protected $table = 'nivels';
    protected $primaryKey = 'id_nivel';
    public $timestamps = false;

    protected $fillable = [
        'nombre_nivel'
    ];

    // Relación con los grados
    public function grados()
    {
        return $this->hasMany(Grado::class, 'id_nivel', 'id_nivel');
    }

}
