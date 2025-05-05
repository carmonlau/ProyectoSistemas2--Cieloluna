@extends('layouts.app')

@section('title', 'Agregar Usuario')

@section('content')
<!-- Agrega el enlace a Google Fonts para Montserrat -->
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 rounded-4 shadow-lg">
                <div class="card-header bg-gradient-dark text-white py-4 rounded-top-4">
                    <div class="d-flex align-items-center">
                        <div class="bg-white bg-opacity-10 p-3 rounded-circle me-3">
                            <i class="fas fa-user-plus fs-4"></i>
                        </div>
                        <div>
                            <h2 class="h5 mb-0">NUEVO REGISTRO</h2>
                            <p class="small mb-0 opacity-75">Complete el formulario para agregar un usuario</p>
                        </div>
                    </div>
                </div>
                
                <div class="card-body p-5">
                    <form action="{{ route('usuarios.store') }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        
                        <div class="mb-4">
                            <label for="nombre" class="form-label fw-semibold">Nombre completo</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="fas fa-user text-muted"></i>
                                </span>
                                <input type="text" class="form-control form-control-lg border-start-0" id="nombre" name="nombre" required>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label for="email" class="form-label fw-semibold">Correo electrónico</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="fas fa-envelope text-muted"></i>
                                </span>
                                <input type="email" class="form-control form-control-lg border-start-0" id="email" name="email" required>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label for="rol" class="form-label fw-semibold">Tipo de usuario</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="fas fa-shield-alt text-muted"></i>
                                </span>
                                <select class="form-select form-select-lg border-start-0" id="rol" name="rol" required>
                                    <option value="" selected disabled>Seleccionar rol</option>
                                    <option value="admin">Administrador</option>
                                    <option value="empleado">Empleado</option>
                                    <option value="usuario">Usuario estándar</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center mt-5 pt-3 border-top">
                            <a href="" class="btn btn-link text-decoration-none">
                                <i class="fas fa-arrow-left me-2"></i>Volver atrás
                            </a>
                            <button type="submit" class="btn btn-dark px-4 py-2 rounded-3">
                                <i class="fas fa-save me-2"></i>Guardar registro
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Aplica Montserrat a todo el documento */
    body {
        font-family: 'Montserrat', sans-serif;
    }
    
    /* Estilos específicos para títulos */
    h1, h2, h3, h4, h5, h6 {
        font-family: 'Montserrat', sans-serif;
        font-weight: 600; /* Semi-bold */
    }
    
    /* Estilos para los inputs y botones */
    .form-control, .form-select, .btn {
        font-family: 'Montserrat', sans-serif;
    }
    
    .bg-gradient-dark {
        background: linear-gradient(135deg, #C41242 0%, #a81c42 100%);
    }
    .card {
        overflow: hidden;
    }
    .form-control-lg, .form-select-lg {
        padding: 0.75rem 1rem;
    }
    .btn-dark {
        background-color: #a81c42;
        border: none;
        transition: all 0.3s;
    }
    .btn-dark:hover {
        background-color: #1a1a2e;
        transform: translateY(-2px);
    }
</style>

<script>
    // Validación de formulario
    (() => {
        'use strict'
        const forms = document.querySelectorAll('.needs-validation')
        
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
    })()
</script>
@endsection