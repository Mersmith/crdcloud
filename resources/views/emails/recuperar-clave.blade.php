<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Recuperar Clave</title>
</head>
<body>
    <p>Hola,</p>

    <p>Hemos recibido una solicitud para restablecer la contraseña de su cuenta. Si no hizo esta solicitud, puede ignorar este mensaje y su contraseña no cambiará.</p>

    <p>Para restablecer su contraseña, haga clic en el siguiente enlace:</p>

    <p><a href="{{ $resetLink }}">{{ $resetLink }}</a></p>

    <p>Este enlace caducará en {{ config('auth.passwords.'.config('auth.defaults.passwords').'.expire') }} minutos.</p>

    <p>Si tiene alguna pregunta o necesita ayuda, no dude en ponerse en contacto con nosotros.</p>

    <p>Gracias.</p>
</body>
</html>
