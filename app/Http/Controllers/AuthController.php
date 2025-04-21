<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;

class AuthController extends Controller
{
    public function login (Request $request){
        // Validation des champs
        
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $user = Users::where('username', $request->username)->first();

        if ($user->password != $request->password){
            return response()->json([
                'message' => 'username ou mot de passe incorrect.'
            ], 401);
        }

        // Créer un token Sanctum
        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'message' => 'Connexion réussie',
            'token' => $token,
            'user' => $user
        ]);


    }
}
