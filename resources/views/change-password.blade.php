@extends('layouts.app')

@section('title', 'Cambiar Contraseña')

@section('content')
    <h1>Cambiar Contraseña</h1>
    <form action="{{ route('password.change') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="current_password" class="form-label">Contraseña Actual</label>
        <input type="password" class="form-control" id="current_password" name="current_password" required>
    </div>
    <div class="mb-3">
        <label for="new_password" class="form-label">Nueva Contraseña</label>
        <input type="password" class="form-control" id="new_password" name="new_password" required>
    </div>
    <div class="mb-3">
        <label for="new_password_confirmation" class="form-label">Confirmar Nueva Contraseña</label>
        <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
    </div>
    <button type="submit" class="btn btn-primary">Cambiar Contraseña</button>
</form>
@endsection