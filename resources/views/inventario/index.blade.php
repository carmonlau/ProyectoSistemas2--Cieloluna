@extends('layouts.app')

@section('title', 'Inventario')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600&display=swap');
    @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css');
    
    :root {
        --primary: #c41242;
        --secondary: #9f2449;
        --light: #deced1;
        --lighter: #f8f9fa;
        --dark: #333;
    }
    
    body {
        font-family: 'Montserrat', sans-serif;
        background-color: var(--lighter);
    }
    
    .inventory-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid var(--light);
    }
    
    .inventory-title {
        color: var(--primary);
        font-weight: 600;
        margin: 0;
    }
    
    .btn-primary-custom {
        background-color: var(--primary);
        border: none;
        font-weight: 500;
        transition: all 0.3s;
    }
    
    .btn-primary-custom:hover {
        background-color: var(--secondary);
        transform: translateY(-2px);
    }
    
    .table-custom {
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }
    
    .table-custom thead {
        background-color: var(--primary);
        color: white;
    }
    
    .table-custom th {
        font-weight: 500;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
    }
    
    .badge-status {
        font-weight: 500;
        padding: 0.35rem 0.75rem;
        border-radius: 50px;
        font-size: 0.8rem;
    }
    
    .badge-available {
        background-color: #28a74520;
        color: #28a745;
    }
    
    .badge-low {
        background-color: #ffc10720;
        color: #ffc107;
    }
    
    .badge-out {
        background-color: #dc354520;
        color: #dc3545;
    }
    
    .action-btns {
        display: flex;
        gap: 0.5rem;
    }
    
    .btn-action {
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 4px;
    }
    
    .btn-edit {
        background-color: rgba(255, 193, 7, 0.1);
        color: #ffc107;
        border: none;
    }
    
    .btn-delete {
        background-color: rgba(220, 53, 69, 0.1);
        color: #dc3545;
        border: none;
    }
    
    .btn-view {
        background-color: rgba(13, 110, 253, 0.1);
        color: #0d6efd;
        border: none;
    }
    
    .pagination-custom .page-item.active .page-link {
        background-color: var(--primary);
        border-color: var(--primary);
    }
    
    .pagination-custom .page-link {
        color: var(--primary);
    }
</style>

<div class="container py-4">
    <div class="inventory-header">
        <h1 class="inventory-title">Gestión de Inventario</h1>
        <a href="{{ route('inventario.create') }}" class="btn btn-primary-custom">
            <i class="fas fa-plus-circle me-2"></i>Agregar Material
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-custom table-hover mb-0">
                    <thead>
                        <tr>
                            <th class="ps-4">Código</th>
                            <th>Nombre</th>
                            <th class="text-end">Disponible</th>
                            <th class="text-end">Proveedor</th>
                            <th class="text-end">P. Unitario</th>
                            <th>Estado</th>
                            <th class="text-center pe-4">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($inventarios as $item)
                        <tr>
                            <td class="ps-4 fw-semibold">{{ $item->codigo }}</td>
                            <td>{{ $item->nombre }}</td>
                            <td class="text-end">{{ number_format($item->cantidad_disponible, 0) }}</td>
                            <td class="text-end">{{ $item->proveedor }}</td>
                            <td class="text-end">{{ $item->precio_unitario ? '$'.number_format($item->precio_unitario, 2) : 'N/A' }}</td>
                            <td>
                                @if($item->estado == 'Disponible')
                                    <span class="badge-status badge-available">
                                        <i class="fas fa-check-circle me-1"></i> {{ $item->estado }}
                                    </span>
                                @elseif($item->estado == 'Bajo Stock')
                                    <span class="badge-status badge-low">
                                        <i class="fas fa-exclamation-triangle me-1"></i> {{ $item->estado }}
                                    </span>
                                @else
                                    <span class="badge-status badge-out">
                                        <i class="fas fa-times-circle me-1"></i> {{ $item->estado }}
                                    </span>
                                @endif
                            </td>
                            <td class="pe-4">
                                <div class="action-btns justify-content-center">
                                    <a href="{{ route('inventario.show', $item->id) }}" class="btn-action btn-view" title="Ver">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('inventario.edit', $item->id) }}" class="btn-action btn-edit" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('inventario.destroy', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action btn-delete" title="Eliminar" onclick="return confirm('¿Confirmas eliminar este material?')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">
                                <i class="fas fa-box-open fa-2x mb-3"></i>
                                <p class="mb-0">No hay materiales registrados</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @if($inventarios->hasPages())
    <div class="mt-4">
        {{ $inventarios->links('pagination::bootstrap-5') }}
    </div>
    @endif
</div>

<script>
// Confirmación antes de eliminar
document.addEventListener('DOMContentLoaded', function() {
    const deleteForms = document.querySelectorAll('form[action*="destroy"]');
    
    deleteForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            if (!confirm('¿Estás seguro de eliminar este material?')) {
                e.preventDefault();
            }
        });
    });
});
</script>
@endsection