<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        
        $credentials = $request->all(['email', 'password']);

        //$token = Auth::attempt($credentials);
        $token = auth('api')->attempt($credentials);

        if($token) {

            return response()->json(['token' => $token, 'type' => 'bearer']);

        } else {

            return response()->json(['erro' => 'Usuário ou senha inválido'], 403);
        }
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
        ]);

        return response()->json([
            'message' => 'Usuário cadastrado com sucesso',
            'user' => $user
        ]);
    }

    public function logout()
    {   
        // Método 1
        /*
        Auth::logout();
        return response()->json([
            'message' => 'Logout realizado com sucesso',
        ]);
        */

        auth('api')->logout();

        return response()->json(['msg' => 'O logout foi realizado com sucesso']);
    }

    public function refresh()
    {
        return response()->json([
            'token' => Auth::refresh(),
            'type' => 'bearer'
        ]);
    }

    public function me()
    {
        return response()->json(auth()->user());
    }
}
