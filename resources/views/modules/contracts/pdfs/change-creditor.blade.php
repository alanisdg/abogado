<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ACTUALIZACIÓN DE CONTRATO DE PRESTACIÓN DE SERVICIOS PROFESIONALES</title>

    <style>
        html {
            margin: 3rem 3rem 4rem 3rem;
        }

        p {
            text-align: justify;
            text-justify: inter-word;
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body>
    <img width="120" src="{{ asset('/backend/images/assets/logo.png') }}" alt="">

    <p style="margin-top:120px;"><strong>ACTUALIZACIÓN DE CONTRATO DE PRESTACIÓN DE SERVICIOS PROFESIONALES</strong></p>

    <p style="margin-top:120px;">
        Entre ABOPROC, Rut: xx.xxx.xxx-x, representante legal Franco Caro Aguilera, Abogado, RUT. 19.094.981-8 domiciliado en Salar del Carmen 767, Santiago, en adelante indistintamente, “Estudio jurídico aboproc y Asociados” o “el mandatario” y doña/don <strong>{{ $data->contract->customer->customer }}</strong>, RUT: <strong>{{ $data->contract->customer->rut }}</strong>, domiciliada/o en <strong>{{ $data->contract->customer->address }}</strong>, <strong>{{ $data->contract->customer->commune }}</strong>, <strong>{{ $data->contract->customer->region }}</strong>. Teléfono red fija <strong>{{ $data->contract->customer->home_phone }}</strong>, celular: <strong>{{ $data->contract->customer->phone }}</strong>, correo electrónico: <strong>{{ $data->contract->customer->email }}</strong> estado civil: <strong>{{ $data->contract->customer->civil_status }}</strong>, ocupación: <strong>{{ $data->contract->customer->profession }}</strong>; en adelante “el cliente” se celebra el siguiente contrato de actualización de prestación de servicios con fecha <strong>{{ date("d-m-Y", strtotime($data->created_at)) }}</strong>.
    </p>

    <p style="margin-top: 50px;">
        <strong>PRIMERO:</strong> El Cliente se compromete a cumplir acuerdo establecido entre las partes para continuar con las gestiones de defensa contratadas anteriormente, es decir, contrato firmado con fecha <strong>{{ date("d", strtotime($data->contract->created_at)) }}</strong> de <strong>{{ date("m", strtotime($data->contract->created_at)) }}</strong> de <strong>{{ date("Y", strtotime($data->contract->created_at)) }}</strong>.
    </p>

    <p style="margin-top: 50px;">
        <strong>SEGUNDO:</strong> El motivo del presente contrato de actualización es modificar los servicios contratados y cambiar uno de los acreedores descritos. Se modifica y cambia al acreedor <strong>{{ $data->current_creditor }}</strong> por el acreedor <strong>{{ $data->new_creditor }}</strong>.
    </p>

    <p style="margin-top: 50px;">
        Por tanto, al día de hoy <strong>{{ date("d-m-Y", strtotime($data->created_at)) }}</strong>, el cliente encarga al mandatario la representación, tramitación y defensa de los juicios que se inicien en su contra producto de la XXXXXXXXXXXXXXXX
    </p>

    <p style="margin-top: 4rem;"><strong>Soc jurídica aboproc y asociados ________________________</strong></p>
    <p style="margin-top: 1rem;"><strong>RUT {{ $data->contract->customer->rut }}</strong></p>
</body>
</html>
