<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Editorial extends Model
{
    use HasFactory;

    protected $table = 'editoriales';

    protected $primaryKey = 'IdEditorial';

    protected $fillable = ['IdEditorial', 'DesEditorial'];
    public $incrementing = false; // Si la clave primaria no es autoincremental
    protected $keyType = 'char'; // Define el tipo de dato de la clave primaria
}
