<?php

namespace App\Http\Controllers;

use App\Models\Nivel;
use Illuminate\Http\Request;

class NivelController extends Controller
{
    public function getNiveles()
    {
        $niveles = Nivel::get();
        return response()->json($niveles);
    }
}
