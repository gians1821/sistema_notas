<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    use HasFactory;

    protected $table = 'libros';
    protected $primaryKey = 'CodLibro';
    public $timestamps = false;

    protected $fillable = ['TitLibro', 'AnoLibro', 'Cantidad'];

    public function productos()
    {
        return $this->hasOne(Autor::class, 'IdAutor', 'IdAutor');
    }
}
