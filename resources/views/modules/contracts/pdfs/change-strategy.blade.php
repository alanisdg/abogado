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

        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            width: 100%;
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
        <strong>PRIMERO:</strong> El motivo del presente contrato de actualización es el cambio de estrategia de defensa. Se cambia la estrategia contratada con fecha <strong>{{ date("d-m-Y", strtotime($data->contract->created_at)) }}</strong>, esto es la representación en un Procedimiento Concursal de Liquidación Voluntaria de conformidad con lo dispuesto en la Ley 20.720 de Reorganización y Liquidación de Empresas y Personas, por la defensa en cualquier juicio de cobranza que inicien algunos de los siguientes acreedores producto de la cesación de pagos del cliente: <strong>{{ $data->contract->customer->customer }}</strong>.
    </p>

    <p style="margin-top: 50px;">
        Por tanto, el cliente encarga al mandatario: la preparación, representación de la (s) causa (s) que se inicie (n) en su contra en los tribunales del país, producto de la cesación de pagos de sus obligaciones civiles y comerciales ante: <strong>{{ $data->current_creditor }}</strong>.
    </p>

    <p style="margin-top: 50px;">
        El Cliente se compromete a cumplir acuerdo establecido entre las partes.
    </p>

    <p style="margin-top: 50px;">
        <strong>SEGUNDO:</strong> El cliente se obliga a pagar al mandatario, como contraprestación pendiente del servicio contratado la suma de <strong>${{ $data->contract->total_contract }}, pagaderos según el siguiente plan de pago:
    </p>

    <table>
        <thead>
            <tr>
                <th>N° de Cuota</th>
                <th>Fecha de Pago</th>
                <th>Monto</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data->contract->collections as $collection)
                <tr style="text-align: center">
                    <td>{{ $collection->installment_number }}</td>
                    <td>{{ date("d-m-Y", strtotime($collection->payment_date)) }}</td>
                    <td>{{ $collection->amount }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p style="margin-top: 50px;">
        Para efectuar el pago el cliente contará con los siguientes canales de recepción de pagos, sin perjuicio de que Aboproc pueda modificarlos con posterioridad a la celebración del presente contrato, en cuyo caso el mandatario informará de dicha modificación mediante su página web o bien por la sucursal virtual del cliente:
    </p>

    <p style="margin-top: 50px; margin-left: 2rem;">
        <strong>*</strong> Depósito Bancario en la cuenta corriente del Banco xxx Nº xxxxxxxx a nombre de Estudio jurídico aboproc Rut ° xx.xxx.xxx-x. En este caso el cliente deberá enviar el comprobante de pago a pagos@aboproc.cl. Si quien deposita es un tercero distinto del cliente, en dicho correo se deberá indicar RUN y nombre completo del cliente respecto del cual se hizo el pago. El cliente entiende que, de no proporcionarse dicha información el pago no podrá ser imputado y descontado como mensualidad de su contrato hasta que se proporcione los antecedentes antes mencionados.
    </p>

    <p style="margin-top: 50px; margin-left: 2rem;">
        <strong>*</strong> Transferencia Electrónica en la cuenta corriente del Banco xxx Nº xxxxxxx a nombre de Estudio jurídico Aboproc Rut ° xx.xxx.xxx-x.. En este caso el cliente deberá enviar el comprobante de pago a pagos@aboproc.cl. Si quien deposita es un tercero distinto del cliente, en dicho correo se deberá indicar RUN y nombre completo del cliente respecto del cual se hizo el pago. El cliente entiende que, de no proporcionarse dicha información el pago no podrá ser imputado y descontado como mensualidad de su contrato hasta que se proporcione los antecedentes antes mencionados.
    </p>

    <p style="margin-top: 50px;">
        Las partes acuerdan que si alguno de los pagos aquí acordados, no fuese percibido o a su vencimiento informado, autorizará al Mandatario hacer exigible la totalidad de los pagos acordados según programa
    </p>

    <p style="margin-top: 4rem;"><strong>Soc jurídica aboproc y asociados ________________________</strong></p>
    <p style="margin-top: 1rem;"><strong>RUT {{ $data->contract->customer->rut }}</strong></p>
</body>
</html>
