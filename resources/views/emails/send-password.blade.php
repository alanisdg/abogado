<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
    <div class="img">
        <img width="150" src="{{ asset('assets/img/logo2.png') }}" alt="">
    </div>

    <div>
        <strong>{{ $userDetails['title'] }}</strong>
    </div>

    <p>Estimado(a) <strong>{{ $userDetails['user']['first_name'].' '.$userDetails['user']['last_name'] }},</strong></p>

    <p>La presente notificación tiene como finalidad informarle que ha sido registrado(a) en nuestra plataforma. Para acceder a esta, deberá utilizar la siguiente información:</p>

    <p><strong>Correo Electrónico: </strong> {{ $userDetails['email'] }} </p>
    <p><strong>Contraseña: </strong> {{ $userDetails['password'] }} </p>

    <span>Puede acceder a nuestra plataforma el siguiente enlace: </span> <a href="{{ $userDetails['url'] }}">Appaboproc</a>. Una vez dentro, podrá actualizar sus datos de ingreso, desde la sección perfil de usuario.

    <p>Gracias por confiar en nosotros!!</p>

</body>
</html>
