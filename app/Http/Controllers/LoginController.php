<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use function Laravel\Prompts\password;

class LoginController extends Controller
{
    public function Login()
    {
        return view('login');
    }

    public function UserLogin(Request $request)
    {
        $data = request()->validate(
            [
                'name' => 'required',
                'password' => 'required'
            ],
            [
                'name.required' => 'Ingrese Usuario',
                'password.required' => 'Ingrese contraseña',
            ]
        );
        if (Auth::attempt($data)) {
            $con = 'OK';
        }
        $name = $request->get('name');
        $query = User::where('name', '=', $name)->get();
        if ($query->count() != 0) {
            $hashp = $query[0]->password;
            $password = $request->get('password');
            if (password_verify($password, $hashp)) {
                return redirect()->route('Home.index');
            } else {
                return back()->withErrors(['password' => 'Contraseña no válida']);
            }
        } else {
            return back()->withErrors(['name' => 'Usuario no encontrado']);
        }
    }

    public function exit()
    {
        Auth::logout();
        return redirect('/');
    }
}
