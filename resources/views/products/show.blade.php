@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>{{ $product->nombre }}</h2>
        <p>Category: {{ $product->category->nombre }}</p>
        <p>Price: {{ $product->precio }}</p>
        @if($product->imagen)
            <img src="{{ asset('storage/' . $product->imagen) }}" alt="Product Image" width="200">
        @endif
        <a href="{{ route('products.index') }}" class="btn btn-primary mt-3">Back</a>
    </div>
@endsection
