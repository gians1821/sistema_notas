<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    use HasFactory;

    protected $table = 'tipos';
    protected $primaryKey = 'tipo_id';


    public $timestamps = false;

    protected $fillable = [
        'descripcion',
    ];

    public function ventas()
    {
        return $this->hasMany(Cabeceraventa::class, 'tipo_id', 'tipo_id');
    }
}
