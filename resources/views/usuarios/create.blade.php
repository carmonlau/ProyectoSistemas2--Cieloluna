@extends('layouts.app')

@section('title', 'Agregar Usuario')

@section('content')
    <h1>Agregar Usuario</h1>
    <form action="{{ route('usuarios.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Correo Electrónico</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="rol" class="form-label">Rol</label>
            <select class="form-control" id="rol" name="rol" required>
                <option value="admin">Administrador</option>
                <option value="usuario">Usuario</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Contraseña Genérica</label>
            <input type="text" class="form-control" id="password" name="password" value="Password123" readonly>
        </div>
        <button type="submit" class="btn btn-primary">Guardar Usuario</button>
    </form>
@endsection