<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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

    //Recuperar Contraseña

    public function sendRecoveryEmail(Request $request)
    {
        // Validar que el correo exista
        $request->validate([
            'emailrecovery' => 'required|email|exists:users,email',
        ], [
            'emailrecovery.required' => 'Ingrese su correo electrónico.',
            'emailrecovery.email' => 'El correo ingresado no es válido.',
            'emailrecovery.exists' => 'El correo no existe.',
        ]);

        $token = Str::random(60);
        $email = $request->emailrecovery;

        $user = User::where('email', $email)->first();
        
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $email],
            ['token' => $token, 'created_at' => now()]
        );

        Mail::send('emails.password_reset', ['token' => $token, 'name' => $user->name], function ($message) use ($email) {
            $message->to($email)
                ->subject('Recuperación de contraseña - Colegio Brüning');
        });

        return back()->with('status', 'Se envio el mensaje correctamente.');
    }

    public function showResetForm($token)
    {
        return view('auth.password_reset', ['token' => $token]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed|min:8',
        ], [
            'password.required' => 'Ingrese su nueva contraseña.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'password.min' => 'Mínimo 8 caracteres.',
        ]);

        $token = $request->token;
        $reset = DB::table('password_reset_tokens')->where('token', $token)->first();

        if (!$reset) {
            return back()->withErrors(['token' => 'El token de recuperación no es válido o ha expirado.']);
        }

        $user = User::where('email', $reset->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        // Eliminar el token usado
        DB::table('password_reset_tokens')->where('token', $token)->delete();

        return redirect()->route('User.Login')->with('statusconfirm', 'Contraseña restablecida correctamente.');
    }

    //fuentes hasta van los cambios

    public function exit()
    {
        Auth::logout();
        return redirect('/');
    }
}
