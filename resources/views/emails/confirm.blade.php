<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
</head>
<body>
    <h3>Hola {{ $name }}</h3>
    <p>Por favor confirma tu correo electronico.</p>
    <p>Haz click en el siguente <a href="{{ url('confirmar/'.$email.'/cod/'. $confirmation_code) }}">enlace para verificar tu correo</a> y activar tu cuenta.</p>
</body>
</html>