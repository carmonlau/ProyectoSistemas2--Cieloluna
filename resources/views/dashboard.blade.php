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
            <h5>Configuración</h5>
        </div>
        <div class="dashboard-card">
            <i class="fas fa-calendar-alt"></i>
            <h5>Eventos</h5>
        </div>
        <div class="dashboard-card">
            <i class="fas fa-chart-line"></i>
            <h5>Reportes</h5>
        </div>
        <div class="dashboard-card">
            <i class="fas fa-box"></i>
            <h5>Inventario</h5>
        </div>
        <div class="dashboard-card">
            <i class="fas fa-comments"></i>
            <h5>Mensajes</h5>
        </div>
        <div class="dashboard-card">
            <i class="fas fa-bell"></i>
            <h5>Notificaciones</h5>
        </div>
    </div>
@endsection