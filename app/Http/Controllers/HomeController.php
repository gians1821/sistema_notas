<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;
use App\Models\Padre;
use App\Models\Alumno;


class HomeController extends Controller
{
    public function index(){
        $user = Auth::user();
        $role = $user->roles->pluck('name')->first();
        $roleDescription = Role::where('name', $role)->value('descripcion');
        $padre = Padre::where('id_users', $user->id)->first();
        if ($padre) {
            $alumnos = Alumno::where('padre_id', $padre->id)->get();
        } else {
            $alumnos = collect(); 
        }


        return view('index', compact('user', 'roleDescription', 'alumnos'));
    }
}
