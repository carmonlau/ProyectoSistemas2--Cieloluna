@extends('layouts.app')

@section('title', 'Crear Material')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600&display=swap');
    
    body {
        font-family: 'Montserrat', sans-serif;
        background-color: #f8f9fa;
    }
    
    .topbar {
        height: 70px;
        background-color: #c41242;
    }
    
    .form-control, .form-select {
        border-radius: 4px;
        border: 1px solid #deced1;
        height: 42px;
        font-weight: 400;
        transition: all 0.3s;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #9f2449;
        box-shadow: 0 0 0 0.2rem rgba(156, 36, 73, 0.25);
    }
    
    .form-label {
        font-weight: 500;
        color: #555;
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
    }
    
    .card {
        border: none;
        border-radius: 8px;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
    }
    
    .card-header {
        background-color: #c41242;
        height: 70px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px 8px 0 0 !important;
    }
    
    .card-title {
        font-weight: 500;
        font-size: 1.4rem;
        letter-spacing: 0.3px;
        margin: 0;
        padding: 0;
        text-align: center;
        width: 100%;
    }
    
    .btn-primary {
        background-color: #c41242;
        border: none;
        border-radius: 4px;
        height: 42px;
        font-weight: 500;
        padding: 0 28px;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .btn-primary:hover {
        background-color: #9f2449;
    }
    .btn-outline-secondary {
        border-radius: 4px;
        height: 42px;
        font-weight: 500;
        padding: 0 28px;
        border: 1px solid #d4d5d4;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .btn-group-actions {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    
    .input-group-text {
        border-radius: 4px 0 0 4px;
        background-color: #f8f9fa;
        border: 1px solid #deced1;
        font-weight: 400;
    }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header text-white">
                    <h4 class="card-title mb-0">Agregar nuevo material</h4>
                </div>
                <div class="card-body p-4 p-md-5">
                    <form action="{{ route('inventario.store') }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        
                        <!-- Código generado automáticamente (oculto) -->
                        <input type="hidden" name="codigo" value="{{ 'MAT-' . strtoupper(uniqid()) }}">
                        
                        <div class="row mb-3">
                            <div class="col-md-12 mb-4">
                                <label for="nombre" class="form-label">Nombre del material *</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                                <div class="invalid-feedback">
                                    Por favor ingresa el nombre del material.
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6 mb-4">
                                <label for="cantidad_disponible" class="form-label">Cantidad disponible *</label>
                                <input type="number" class="form-control" id="cantidad_disponible" name="cantidad_disponible" min="0" required>
                                <div class="invalid-feedback">
                                    Por favor ingresa la cantidad disponible.
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-4">
                                <label for="cantidad_minima" class="form-label">Cantidad mínima *</label>
                                <input type="number" class="form-control" id="cantidad_minima" name="cantidad_minima" min="0" required>
                                <div class="invalid-feedback">
                                    Por favor ingresa la cantidad mínima.
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6 mb-4">
                                <label for="precio_unitario" class="form-label">Precio unitario *</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" step="0.01" class="form-control" 
                                           id="precio_unitario" name="precio_unitario" min="0" required>
                                </div>
                                <div class="invalid-feedback">
                                    Por favor ingresa el precio unitario.
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-4">
                                <label for="estado" class="form-label">Estado</label>
                                <select class="form-select" id="estado" name="estado">
                                    <option value="Disponible" selected>Disponible</option>
                                    <option value="Bajo Stock">Bajo Stock</option>
                                    <option value="Agotado">Agotado</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6 mb-4">
                                <label for="cantidad_por_paquete" class="form-label">Cantidad por paquete</label>
                                <input type="number" class="form-control" id="cantidad_por_paquete" name="cantidad_por_paquete" min="1">
                            </div>
                            
                            <div class="col-md-6 mb-4">
                                <label for="precio_por_paquete" class="form-label">Precio por paquete</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" step="0.01" class="form-control" 
                                           id="precio_por_paquete" name="precio_por_paquete" min="0">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6 mb-4">
                                <label for="ubicacion" class="form-label">Ubicación</label>
                                <input type="text" class="form-control" id="ubicacion" name="ubicacion" maxlength="100">
                            </div>
                            
                            <div class="col-md-6 mb-4">
                                <label for="proveedor" class="form-label">Proveedor</label>
                                <input type="text" class="form-control" id="proveedor" name="proveedor" maxlength="255">
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-12 mb-4">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6 mb-4">
                                <label for="fecha_ingreso" class="form-label">Fecha de ingreso</label>
                                <input type="date" class="form-control" id="fecha_ingreso" name="fecha_ingreso">
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-end mt-4 pt-2">
                            <div class="btn-group-actions">
                                <a href="{{ route('inventario.index') }}" class="btn btn-outline-secondary">
                                    Cancelar
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    Guardar material
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script>
// Validación de formulario
(function() {
    'use strict';
    window.addEventListener('load', function() {
        var forms = document.getElementsByClassName('needs-validation');
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();
</script>
@endsection

@endsection