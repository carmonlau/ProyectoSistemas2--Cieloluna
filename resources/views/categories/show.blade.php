@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>{{ $category->nombre }}</h2>
        <p>Category ID: {{ $category->id }}</p>
        <a href="{{ route('categories.index') }}" class="btn btn-primary">Back</a>
    </div>
@endsection
