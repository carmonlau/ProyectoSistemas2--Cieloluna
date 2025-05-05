<!DOCTYPE html>
<html>
<head>
    <title>Credenciales de Acceso</title>
</head>
<body>
    <h2>Hola {{ $usuario->nombre }},</h2>
    <p>Te han registrado en nuestro sistema. Aquí están tus credenciales de acceso:</p>

    <p><strong>Correo:</strong> {{ $usuario->email }}</p>
    <p><strong>Contraseña:</strong> {{ $password }}</p>

    <p>Por seguridad, te recomendamos cambiar tu contraseña después de iniciar sesión.</p>

    <p>Saludos,</p>
    <p>El equipo de Mi luna Cielo</p>
</body>
</html>
