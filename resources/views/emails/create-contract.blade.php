<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <style>
        .init {
            width: 100%;
            margin: 0 auto;
            text-align: center;
            color: #ffffff;
            background-color: #7c9ccb;
            padding-top: 19px;
            padding-bottom: 19px;
            margin-bottom: 2rem;
        }

        .title, .separator {
            width: 50%;
            margin: 0 auto;
        }

        .separator {
            width: 100%;
        }

        .line {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 20%;
        }

        .subtitle {
            color: #949494;
            font-style: italic;
        }

        .img {
            width: 100%;
        }

        .img-family {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 20%;
        }

        .img-logo {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 10%;
            margin-top: 2rem;
        }

        .text {
            width: 100%
        }

        .text p {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 50%;
            margin-top: 2rem;
        }

        .logos {
            width: 100%;
            text-align: center;
            margin-top: 2rem;
        }

        .logos img {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 50%;
            width: 40px;
            display:inline-block
        }

        .text-notification {
            width: 50%;
            margin: 0 auto;
        }
    </style>

</head>
    <div class="init">
        <h2><strong>ABOPROC</strong></h2>
        <span>Tranquilo, tu problema tiene solución </span>
    </div>

    <div class="title">
        <div style="text-align: center">
            <span class="subtitle">Tenemos nuevas noticias</span>
            <h2 style="">¡Tu contrato ha sido creado!</h2>
        </div>
    </div>

    <div class="img">
        <img class="img-family" src="../backend/images/assets/unnamed.png" alt="">
    </div>

    <div class="text-notification" style="text-align: center; margin-top: 2rem; color: #949494; margin-bottom: 4rem;">
        <p>De igual forma, se le han asignado las credenciales correspondientes al acceso a nuestra plataforma, desde donde podrá realizar el seguimiento al proceso administrativo correspondiente a su contrato.</p>
        <strong>Usuario: </strong> {{ @$email }} <br>
        <strong>Contraseña: </strong> {{ @$pass }} <br><br>

        <span>Puedes ingresar a tu portal de cliente mediante este </span> <a href="{{ @$url }}">enlace</a>
    </div>

    <div class="separator">
        <div class="line" style="width: 50%; border-top: 2px solid #949494"></div>
    </div>

    <div class="img">
        <img class="img-logo" src="{{ asset("backend/images/assets/logo.png") }}" alt="">
    </div>

    <div class="logos">
        <img src="{{ asset("backend/images/assets/facebook.svg") }}" alt="">
        <img src="{{ asset("backend/images/assets/twitter.svg") }}" alt="">
        <img src="{{ asset("backend/images/assets/linkedin.svg") }}" alt="">
    </div>

    <div class="text">
        <p>Somos un estudio jurídico de la nueva generación, dejamos atrás la burocracia y optimizamos una serie de proceso con el objetivo de brindar un servicio de calidad y acorde a la necesidad de los tiempos actuales.</p>
    </div>

    <div class="separator" style="margin-top: 2rem;">
        <div class="line" style="width: 50%; border-top: 2px solid #949494"></div>
    </div>

</body>
</html>
