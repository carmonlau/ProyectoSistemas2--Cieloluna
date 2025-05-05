@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Editar Plantilla</h2>
        <form action="{{ route('plantillas.update', $plantilla->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="product_id">Producto</label>
                <select class="form-control" id="product_id" name="product_id" required>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" {{ $product->id == $plantilla->product_id ? 'selected' : '' }}>{{ $product->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="name">Nombre de la Plantilla</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $plantilla->name }}" required>
            </div>
            <div class="form-group">
                <label for="image">Imagen de la Plantilla</label>
                <input type="file" class="form-control" id="image" name="image">
                @if($plantilla->image)
                    <img src="{{ asset('storage/' . $plantilla->image) }}" alt="Plantilla" width="100">
                @endif
            </div>
            <button type="submit" class="btn btn-primary mt-3">Actualizar</button>
        </form>
    </div>
@endsection
