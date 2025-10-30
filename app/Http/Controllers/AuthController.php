<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;



class AuthController extends Controller
{
    public function mostrarLogin(){
        return view("auth/iniciar_sesion");
        
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'El email es requerido',
            'email.email' => 'Ingrese en correro valido',
            'password.required' => 'El password es requerido',
        ]);

        $credentials = $request ->only('email','password');
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            
            return redirect()->intended('bienvenida')->with('success', '¡Bienvenido ' . Auth::user()->name . '!');
        }

        throw ValidationException::withMessages([
            'email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ]);
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Sesion cerrada correcta');
    }
}
