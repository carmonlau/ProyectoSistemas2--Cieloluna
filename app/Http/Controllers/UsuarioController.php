<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\EnviarCredenciales; 
use Illuminate\Support\Facades\Log;


class UsuarioController extends Controller
{
    public function create()
    {
        return view('usuarios.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'nombre' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:usuarios',
        'rol' => 'required|string|in:admin,empleado,usuario',
    ]);

    // Generar una contraseña aleatoria de 10 caracteres
    $password = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 10);

    // Crear el usuario
    $usuario = Usuario::create([
        'nombre' => $request->nombre,
        'email' => $request->email,  // Este es el correo del formulario
        'rol' => $request->rol,
        'password' => Hash::make($password), // Guardar la contraseña encriptada
    ]);

    // Verificar el correo que se está enviando
    Log::info('Correo de usuario creado: ' . $usuario->email);

    // Enviar el correo al usuario con su contraseña generada
    Mail::to($usuario->email)->send(new \App\Mail\EnviarCredenciales($usuario, $password));

    return redirect()->route('usuarios.create')->with('success', 'Usuario creado con éxito. Se ha enviado un correo con su contraseña.');
}


}
