<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';
    protected $primaryKey = 'producto_id';
    protected $timestamps = 'false';

    protected $fillable = [
        'descripcion', 'categoria_id', 'unidad_id', 'stock', 'estado'
    ];

    public function categoria()
    {
        return $this -> hasOne('App\Categoria', 'categoria_id', 'categoria_id');    
    }

    public function unidad()
    {
        return $this -> hasOne('App\Unidad', 'unidad_id', 'unidad_id');    
    }

}
