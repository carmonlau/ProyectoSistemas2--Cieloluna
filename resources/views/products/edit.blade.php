@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Producto</h1>
    <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="category_id" class="form-label">Categoría</label>
            <select name="category_id" id="category_id" class="form-select" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" value="{{ $product->nombre }}" required>
        </div>

        <div class="mb-3">
            <label for="tamano" class="form-label">Tamaño</label>
            <input type="text" name="tamano" class="form-control" value="{{ $product->tamano }}" required>
        </div>

        <div class="mb-3">
            <label for="tipo_papel" class="form-label">Tipo de Papel</label>
            <input type="text" name="tipo_papel" class="form-control" value="{{ $product->tipo_papel }}" required>
        </div>

        <div class="mb-3">
            <label for="precio" class="form-label">Precio</label>
            <input type="number" name="precio" step="0.01" class="form-control" value="{{ $product->precio }}" required>
        </div>

        @if ($product->imagen)
            <p>Imagen actual:</p>
            <img src="{{ asset('storage/' . $product->imagen) }}" width="120">
        @endif

        <div class="mb-3">
            <label for="imagen" class="form-label">Cambiar Imagen</label>
            <input type="file" name="imagen" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection