<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
    <div class="img">
        <img width="150" src="../backend/images/logo.png" alt="">
    </div>

    <div>
        <strong>{{ $title }}</strong>
    </div>

    <p>Estimado(a) <strong>{{ $user }},</strong></p>

    <p>La presente notificación tiene como finalidad informarle que ha sido Creado el Contrato, una vez cumplido con todos los requerimientos de nuestra Institución.</p>

    <p>
        Ingrese a nuestra plataforma, con los datos de acceso suministrados anteriormente, desde donde podrá llevar un control de todas sus cuotas asociadas a su Contrato.
    </p>

    <span>Puede acceder a nuestra plataforma el siguiente enlace: </span> <a href="{{ $url }}">Appaboproc</a>.

    <p>Gracias por confiar en nosotros!!</p>

</body>
</html>
