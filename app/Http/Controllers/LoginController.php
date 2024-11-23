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
                'email' => 'required',
                'password' => 'required'
            ],
            [
                'email.required' => 'Ingrese Correo electronico',
                'email.email' => 'El formato del correo electrónico es inválido',
                'password.required' => 'Ingrese contraseña',
            ]
        );
        if (Auth::attempt($data)) {
            $con = 'OK';
        }
        $email = $request->get('email');
        $query = User::where('email', '=', $email)->get();
        if ($query->count() != 0) {
            $hashp = $query[0]->password;
            $password = $request->get('password');
            if (password_verify($password, $hashp)) {
                return redirect()->route('Home.index');
            } else {
                return back()->withErrors(['password' => 'Contraseña no válida']);
            }
        } else {
            return back()->withErrors(['email' => 'Correo no válido']);
        }
    }

    public function exit()
    {
        Auth::logout();
        return redirect('/');
    }
}
