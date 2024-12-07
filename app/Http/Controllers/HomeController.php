<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;



class HomeController extends Controller
{
    public function index(){
        $user = Auth::user();
        $role = $user->getRoleNames()->first();
        $roleDescription = Role::where('name', $role)->value('descripcion');

        return view('index', compact('user', 'roleDescription'));
    }
}
