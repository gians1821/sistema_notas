<?php

namespace App\Http\Controllers;

use App\Models\TipoPersonal;
use Illuminate\Http\Request;

class TipoPersonalController extends Controller
{
    public function getTiposPersonal() {
        $tipos_personal = TipoPersonal::get();
        return response()->json($tipos_personal);
    }
}
