@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Añadir Plantilla</h2>
        <form action="{{ route('plantillas.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="product_id">Producto</label>
                <select class="form-control" id="product_id" name="product_id" required>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}">{{ $product->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="name">Nombre de la Plantilla</label>
                <input type="text" class="form-control" id="name" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="image">Imagen de la Plantilla</label>
                <input type="file" class="form-control" id="image" name="imagen" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Guardar</button>
        </form>
    </div>
@endsection
