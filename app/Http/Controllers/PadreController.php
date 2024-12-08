<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Padre;

class PadreController extends Controller
{
    public function buscarPadre(Request $request)
    {
        $dni = $request->query('dni');
        $padre = Padre::where('dni', $dni)->first();
        $user = User::where('id', $padre->id_users)->first();
    
        if ($padre) {
            return response()->json([
                'success' => true,
                'padre' => [
                    'id' => $padre->id,
                    'nombre' => $padre->nombres,
                    'apellido' => $padre->apellidos,
                    'email' => $user->email,
                    'profile_photo' => $user->profile_photo ? asset('storage/' . $user->profile_photo) : asset('images/default-user.png'),
                ],
            ]);
        }
    
        return response()->json(['success' => false]);
    }
}
