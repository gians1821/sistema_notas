<?php

namespace App\Http\Controllers;
use App\Models\Grado;

use Illuminate\Http\Request;

class GradoController extends Controller
{
    public function getGradosPorNivel($id_nivel)
    {
        $grados = Grado::where('id_nivel', $id_nivel)->get();
        return response()->json($grados); 
    }
}
