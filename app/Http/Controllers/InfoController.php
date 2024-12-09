<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumno;
use App\Models\Padre;
use Illuminate\Support\Facades\Auth;

class InfoController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $padre = Padre::where('id_users', $user->id)->first();
        if (!$padre) {
            return redirect()->route('Home.index')->with('datos', 'No tiene hijos registrados');
        } else {
            $alumnos = Alumno::where('padre_id', $padre->id)->first();
            return view('Info.informacion', compact('alumnos'));
        }
    }
}
