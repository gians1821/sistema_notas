<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cabeceraventa extends Model
{
    use HasFactory;

    protected $table = 'cabeceraventas';

    protected $primaryKey = 'venta_id';

    public $timestamps = false;

    protected $fillable = [
        'cliente_id', 'tipo_id', 'fecha_venta', 'nrodoc', 'total', 'igv', 'subtotal', 'estado'
    ];

    public function clientes()
    {
        return $this->hasOne(Cliente::class, 'id', 'cliente_id');
    }

    public function detalleventas()
    {
        return $this->hasMany('App\DetalleVenta', 'venta_id', 'venta_id');
    }

    public function tipo()
    {
        return $this->hasOne(Tipo::class, 'tipo_id', 'tipo_id');
    }
}
