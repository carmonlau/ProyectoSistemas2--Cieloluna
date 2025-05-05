@extends('layouts.app') <!-- Extiende el layout principal -->

@section('title', 'Dashboard') <!-- Título de la página -->

@section('content')

    <!-- Opciones del Dashboard -->
    <div class="dashboard-options">
        <div class="dashboard-card">
            <i class="fas fa-users"></i>
            <h5>Usuarios</h5>
        </div>
        <div class="dashboard-card">
            <i class="fas fa-cogs"></i>
            <h5>seccion2</h5>
        </div>
        <div class="dashboard-card">
            <i class="fas fa-calendar-alt"></i>
            <h5>seccion3</h5>
        </div>
        <div class="dashboard-card">
            <i class="fas fa-chart-line"></i>
            <h5>seccion4</h5>
        </div>
        <div class="dashboard-card">
            <i class="fas fa-box"></i>
            <h5>Inventario</h5>
        </div>
        <div class="dashboard-card">
            <i class="fas fa-comments"></i>
            <h5>seccion5</h5>
        </div>
        <div class="dashboard-card">
            <i class="fas fa-bell"></i>
            <h5>seccion6</h5>
        </div>
    </div>
@endsection