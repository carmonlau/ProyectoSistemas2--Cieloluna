<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Dashboard')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Estilos personalizados -->
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Roboto', sans-serif;
            display: flex;
            height: 100vh;
            margin: 0;
        }

        /* Sidebar */
        .sidebar {
            background-color: #C41242;
            color: white;
            width: 250px;
            height: 100%;
            padding-top: 30px;
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            transition: all 0.3s;
        }

        .sidebar i {
            font-size: 20px;
            margin-right: 10px;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 15px 20px;
            font-size: 18px;
            transition: background-color 0.3s;
        }

        .sidebar a:hover {
            background-color: #a81c42;
        }

        .sidebar h3 {
            text-align: center;
            color: white;
            margin-bottom: 40px;
            font-weight: 600;
            font-family: 'Roboto', sans-serif;
        }

        /* Contenido principal */
        .main-content {
            margin-left: 250px;
            padding: 30px;
            width: calc(100% - 250px);
        }

        /* Tarjeta de bienvenida */
        .welcome-card {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
            z-index: 9999;
            animation: slideIn 0.5s ease-in-out;
        }

        .welcome-card h3 {
            margin-bottom: 20px;
            color: #C41242;
        }

        /* Botón OK */
        .btn-ok {
            background-color: #a81c42;
            border: none;
            color: white;
            padding: 12px 24px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
            text-align: center;
            width: 50%;
        }

        .btn-ok:hover {
            background-color: #45a049;
        }

        /* Animación de entrada */
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translate(-50%, -60%);
            }
            to {
                opacity: 1;
                transform: translate(-50%, -50%);
            }
        }

        /* Opciones del panel */
        .dashboard-options {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            max-width: 900px;
            margin-top: 50px;
        }

        .dashboard-card {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .dashboard-card i {
            font-size: 40px;
            background: linear-gradient(to right, #C41242, #f6104e);
            -webkit-background-clip: text;
            color: transparent;
            margin-bottom: 10px;
        }

        .dashboard-card h5 {
            font-size: 16px;
            color: #8f8e8e;
        }

        /* Botón de cerrar sesión */
        .btn-logout {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: transparent;
            border: none;
            color: #f6104e;
            font-size: 24px;
            cursor: pointer;
        }

        .btn-logout:hover {
            color: #c82333;
        }

        /* Tarjeta de inactividad */
        .inactive-card {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
            z-index: 9998;
            display: none;
        }

        .inactive-card h3 {
            margin-bottom: 20px;
            color: #9F2449;
            font-size: 18px;
            font-weight: 500;
        }

        .inactive-card .btn-ok {
            background-color: #C41242;
        }

        .inactive-card .btn-ok:hover {
            background-color: #f6104e;
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <h3>Mi Luna Cielo</h3>
    <a href="{{ route('dashboard') }}"><i class="fas fa-home"></i>Inicio</a>
    <a href="{{ route('usuarios.create') }}"><i class="fas fa-users"></i>Usuarios</a>
    <a href="{{ route('products.create') }}"><i class="fas fa-cogs"></i>Productos</a>
    <a href="{{ route('categories.create') }}"><i class="fas fa-calendar-alt"></i>Categorias</a>
    <a href="{{ route('plantillas.create') }}"><i class="fas fa-chart-line"></i>Plantillas</a>
    <a href="{{ route('inventario.index') }}"><i class="fas fa-box"></i>Inventario</a>
    <a href="#"><i class="fas fa-comments"></i>seccion5</a>
</div>

<!-- Contenido Principal -->
<div class="main-content">
    <!-- Botón de Cerrar Sesión -->
    <button class="btn-logout" id="logout-btn"><i class="fas fa-sign-out-alt"></i></button>

    @if(session('welcome_shown') && Auth::check())
    <div class="welcome-card" id="welcome-card">
        <h3>Bienvenido {{ Auth::user()->nombre }}!</h3>
        <button class="btn-ok" id="close-welcome-card">OK</button>
    </div>
@endif


    <!-- Contenido específico de cada módulo -->
    @yield('content')
</div>

<!-- Tarjeta de Inactividad -->
<div class="inactive-card" id="inactive-card">
    <h3>Has estado inactivo por 10 segundos, vuelve a iniciar sesión</h3>
    <button class="btn-ok" id="accept-inactivity">Aceptar</button>
</div>

<!-- Modal de Confirmación de Cerrar Sesión -->
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="logoutModalLabel">Cerrar Sesión</h5>
            </div>
            <div class="modal-body">
                ¿Estás seguro de que deseas cerrar sesión?
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Aceptar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
 <!-- Scripts de Bootstrap y jQuery (si no están añadidos ya) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<script>
    // Mostrar el modal de cierre de sesión
    document.getElementById('logout-btn').addEventListener('click', function() {
        var logoutModal = new bootstrap.Modal(document.getElementById('logoutModal'));
        logoutModal.show();
    });

    document.getElementById('close-welcome-card').addEventListener('click', function() {
    document.getElementById('welcome-card').style.display = 'none';
    
    // Eliminar la variable de sesión para que no aparezca la tarjeta en futuras cargas
    fetch('/clear-welcome-session', { 
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    });
});


    // Función para manejar la inactividad
    var inactivityTime = function () {
        var time;
        window.onload = resetTimer;
        document.onmousemove = resetTimer;
        document.onkeypress = resetTimer;
        
        function logout() {
            window.location.href = '/login';
        }

        function resetTimer() {
            clearTimeout(time);
            time = setTimeout(showInactivityCard, 10000);
        }

        function showInactivityCard() {
            document.getElementById('inactive-card').style.display = 'block';
        }

        document.getElementById('accept-inactivity').addEventListener('click', function() {
            window.location.href = '/login';
        });
    };

    inactivityTime();
</script>

</body>
</html>