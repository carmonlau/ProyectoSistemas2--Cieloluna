<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UsuarioController extends Controller
{
    // Mostrar el formulario para crear un usuario
    public function create()
    {
        return view('usuarios.create');
    }

    // Guardar el usuario en la base de datos
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:usuarios',
            'rol' => 'required|string|in:admin,usuario',
        ]);

        // Crear el usuario con una contraseña genérica
        Usuario::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'rol' => $request->rol,
            'password' => Hash::make('Password123'), // Contraseña genérica
            'password_changed' => false, // Indicar que la contraseña no ha sido cambiada
        ]);

        return redirect()->route('usuarios.create')->with('success', 'Usuario creado exitosamente.');
    }
 
    
    
    // Mostrar el formulario para cambiar la contraseña
    public function showChangePasswordForm()
    {
        return view('auth.change-password');
    }

}

