<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            height: 100vh;
            margin: 0;
            font-family: 'Roboto', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            background: none; /* No debe haber fondo en el body */
        }
        .left {
            flex: 1;
            background: linear-gradient(to right, #0097B2, #7ED957); /* Fondo degradado solo en left */
            height: 100%; /* Asegura que left ocupe toda la altura de la pantalla */
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .right {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: white; /* Fondo blanco solo en right */
            padding: 40px;
            height: 100%; /* Asegura que right ocupe toda la altura de la pantalla */
            flex-direction: column;
            width: 100%;
            opacity: 0;
            animation: fadeIn 1s forwards; /* Animación para hacer que aparezca */
        }
        h2 {
            color: #00bf63;
            font-weight: bold;
            text-align: center;
            font-size: 32px;
            text-transform: uppercase;
        }
        .form-control {
            border-radius: 5px;
            border: 1px solid #ccc; /* Color de borde */
            color: #8f8e8e; /* Igual que el color del label */
        }
        .btn-custom {
            background: linear-gradient(to right, #0097B2, #7ED957);
            border: none;
            color: white;
            padding: 10px;
            width: 100%;
            border-radius: 5px;
            font-weight: bold;
        }
        .btn-custom:hover {
           color: #ccc;
        }
        .form-label {
            text-transform: uppercase;
            color: #8f8e8e;
            font-size: 10px;
            letter-spacing: 0.5px; /* Espaciado entre las letras */
        }
 
        /* Quitar subrayado y color del enlace */
        a {
            text-decoration: none;
            color: #8f8e8e; /* Color igual al del label */
            font-size: 13px;
            font-family: 'Roboto', sans-serif;
        }

        /* Cambiar color del placeholder */
        .form-control::placeholder {
            color: #8f8e8e; /* Igual que el color del label */
            font-family: 'Roboto', sans-serif;
            font-size: 12px;
        }

        /* Nuevo estilo para "Ingrese su cuenta" */
        .account-text {
            color: #00bf63; /* Mismo color que "Bienvenido" */
            text-align: center;
            font-size: 16px;
            font-family: 'Roboto', sans-serif;
            margin-bottom: 10px;
        }

        /* Línea debajo del texto "Ingrese su cuenta", ahora ocupa todo el ancho del right */
        .underline {
            width: 100%; /* Línea ocupa todo el ancho del contenedor right */
            height: 2px;
            background: linear-gradient(to right, #0097B2, #7ED957);
            margin-bottom: 20px; /* Espacio debajo de la línea */
        }

        /* Asegura que la imagen se ajuste al tamaño y se centre en el left */
        .left img {
            max-width: 80%; /* Controla el tamaño máximo de la imagen */
            height: auto; /* Mantiene la proporción de la imagen */
        }

        /* Animación para hacer que el contenido del formulario aparezca suavemente */
        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .password-eye {
            position: absolute;
            right: 15px;
            top: 70%;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 18px; /* Ajusta el tamaño del icono */
            color: #8f8e8e; /* Color verde degradado */
            transition: color 0.3s ease-in-out; /* Suaviza el cambio de color del ojo */
        }

        .password-container {
            position: relative;
        }

        .password-eye:hover {
            color: #7ED957; /* Efecto hover para cambiar el color del ojo */
        }
    </style>
</head>
<body>

<div style="display: flex; width: 100%; height: 100vh;">
    <div class="left">
        <!-- Imagen centrada en el contenedor izquierdo -->
        <img src="{{ asset('recursos/luna-login.png') }}" alt="Descripción de la imagen" width="350px">
    </div>
    <div class="right">
        <div>
            <h2>Bienvenido a mi <br> Luna Cielo</h2>
            <div class="account-text">Ingrese su cuenta</div>
        </div>
        
        <!-- Línea que ahora ocupa todo el ancho del right -->
        <div class="underline"></div>
        
        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-3 text-start">
                <label class="form-label">Ingresa tu correo</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required placeholder="Tu correo">
            </div>
            <div class="mb-3 text-start password-container">
                <label class="form-label">Ingresa tu contraseña</label>
                <input type="password" name="password" id="password" class="form-control" required placeholder="Tu clave">
                <i class="fas fa-eye password-eye" id="toggle-password"></i> <!-- Icono de ojo -->
            </div>
            <a href="#" class="d-block mb-3 text-center">¿Olvidaste tu contraseña?</a>
            <button type="submit" class="btn btn-custom">INICIAR</button>
        </form>
    </div>
</div>

<script>
    // Función para mostrar/ocultar la contraseña al hacer clic en el icono de ojo
    const togglePassword = document.getElementById('toggle-password');
    const passwordInput = document.getElementById('password');

    togglePassword.addEventListener('click', function () {
        const type = passwordInput.type === 'password' ? 'text' : 'password';
        passwordInput.type = type;
        this.classList.toggle('fa-eye-slash'); // Cambia el icono del ojo
    });
</script>

</body>
</html>
