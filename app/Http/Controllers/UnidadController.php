<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UnidadController extends Controller
{
    public function index(){
        return view('mantenedor.unidad.index');
    }
}
