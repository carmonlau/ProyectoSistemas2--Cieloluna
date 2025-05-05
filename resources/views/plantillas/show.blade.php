@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>{{ $plantilla->name }}</h2>
        <p>Producto: {{ $plantilla->product->name }}</p>
        @if($plantilla->image)
            <img src="{{ asset('storage/' . $plantilla->image) }}" alt="Plantilla" width="200">
        @endif
        <a href="{{ route('plantillas.index') }}" class="btn btn-primary mt-3">Regresar</a>
    </div>
@endsection
