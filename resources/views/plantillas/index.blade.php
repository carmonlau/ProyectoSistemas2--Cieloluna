@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Plantillas</h2>
        <a href="{{ route('plantillas.create') }}" class="btn btn-primary mb-3">Añadir Plantilla</a>
        <table class="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Producto</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($plantillas as $plantilla)
                    <tr>
                        <td>{{ $plantilla->nombre }}</td>
                        <td>{{ $plantilla->product->nombre }}</td>
                        <td>
                            <a href="{{ route('plantillas.edit', $plantilla->id) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('plantillas.destroy', $plantilla->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
