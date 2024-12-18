<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'descripcion', 'categoria_id', 'precio', 'unidad_id', 'stock', 'estado'
    ];

    public function categoria()
    {
        return $this->hasOne(Categoria::class, 'idcategoria', 'categoria_id');
    }

    public function unidad()
    {
        return $this->hasOne(Unidad::class, 'id', 'unidad_id');
    }

    public static function ActualizarStock($idproducto, $cantidad)
    {
        return DB::select(
            DB::raw("UPDATE productos set stock = stock - '" . $cantidad . "' where idproducto='" . $idproducto . "'")
        );
    }
}
