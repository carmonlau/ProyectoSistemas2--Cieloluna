<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        // Si el inicio de sesión es exitoso, establecer la sesión para mostrar la tarjeta
        if (!session()->has('welcome_shown')) {
            session(['welcome_shown' => true]);
        }

        return redirect()->intended('/dashboard');
    }

    return back()->withErrors(['email' => 'Credenciales incorrectas.']);
}


    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
