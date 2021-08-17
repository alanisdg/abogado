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
        Entre ABOPROC, Rut: 77.409.772-4, representante legal Franco Caro Aguilera, Abogado, RUT. 19.094.981-8 domiciliado en Salar del Carmen 767, Santiago, en adelante indistintamente, “Estudio jurídico aboproc y Asociados” o “el mandatario” y doña/don <strong>{{ $data->contract->customer->customer }}</strong>, RUT: <strong>{{ $data->contract->customer->rut }}</strong>, domiciliada/o en <strong>{{ $data->contract->customer->address }}</strong>, <strong>{{ $data->contract->customer->commune }}</strong>, <strong>{{ $data->contract->customer->region }}</strong>. Teléfono red fija <strong>{{ $data->contract->customer->home_phone }}</strong>, celular: <strong>{{ $data->contract->customer->phone }}</strong>, correo electrónico: <strong>{{ $data->contract->customer->email }}</strong> estado civil: <strong>{{ $data->contract->customer->civil_status }}</strong>, ocupación: <strong>{{ $data->contract->customer->profession }}</strong>; en adelante “el cliente” se celebra el siguiente contrato de actualización de prestación de servicios con fecha <strong>{{ date("d-m-Y", strtotime($data->created_at)) }}</strong>.
    </p>

    <p style="margin-top: 50px;">
        <strong>PRIMERO:</strong> Firma este contrato en representación del cliente fallecido, su heredero/a o continuador individualizado en la comparecencia del presente contrato, por medio del cual se obliga a continuar con todas las obligaciones contraídas por el causante en el contrato de prestación de servicios profesionales celebrado con fecha <strong>{{ date("d-m-Y", strtotime($data->contract->created_at)) }}</strong> con el Estudio Jurídico Aboproc y Asociados.
    </p>

    @php
        $totalPaid = 0;
    @endphp

    @foreach ($data->contract->collections as $item)
        @if ($item->status == "PAGADA")
            @php
                $totalPaid += floatval(str_replace(',', '', $item->amount));
            @endphp
        @endif
    @endforeach

    <p style="margin-top: 50px;">
        <strong>SEGUNDO:</strong> Don/Doña <strong>{{ $data->customer->customer }}</strong> paga en este acto una cuota ascendiente a $ {{ number_format($totalPaid) }}, como parte de los honorarios adeudados a Estudio Jurídico Aboproc Asociados en razón del contrato de prestación de servicios profesionales objeto de este anexo.
    </p>

    <p style="margin-top: 50px;">
        El cliente se obliga a pagar al mandatario, como contraprestación pendiente del servicio contratado la suma de <strong>$ {{ $data->deceased_new_payment_amount }}</strong>, pagaderos según el siguiente plan de pago.
    </p>

    <table style="margin-top: 50px;">
        <thead>
            <tr>
                <th>N° de Cuota</th>
                <th>Fecha de Pago</th>
                <th>Monto</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data->contract->collections as $collection)
                @if ($collection->status == "PENDIENTE")
                    <tr style="text-align: center">
                        <td>{{ $collection->installment_number }}</td>
                        <td>{{ date("d-m-Y", strtotime($collection->payment_date)) }}</td>
                        <td>{{ $collection->amount }}</td>
                        <td>{{ $collection->status }}</td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>

    <p style="margin-top: 50px;">
        Para efectuar el pago el cliente contará con los siguientes canales de recepción de pagos, sin perjuicio de que Aboproc pueda modificarlos con posterioridad a la celebración del presente contrato, en cuyo caso el mandatario informará de dicha modificación mediante su página web o bien por la sucursal virtual del cliente:
    </p>

    <p style="margin-top: 50px; margin-left: 2rem;">
        <strong>*</strong> Depósito Bancario en la cuenta corriente del Banco Santander Nº 0-000-83-16220-1 a nombre de Franco Caro RUT 19.094.981-8. En este caso el cliente deberá enviar el comprobante de pago a pagos@aboproc.cl. Si quien deposita es un tercero distinto del cliente, en dicho correo se deberá indicar RUN y nombre completo del cliente respecto del cual se hizo el pago. El cliente entiende que, de no proporcionarse dicha información el pago no podrá ser imputado y descontado como mensualidad de su contrato hasta que se proporcione los antecedentes antes mencionados.
    </p>

    <p style="margin-top: 50px; margin-left: 2rem;">
        <strong>*</strong> Transferencia Electrónica en la cuenta corriente del Banco Santander Nº 0-000-83-16220-1 a nombre de Franco Caro RUT 19.094.981-8. En este caso el cliente deberá enviar el comprobante de pago a pagos@aboproc.cl. Si quien deposita es un tercero distinto del cliente, en dicho correo se deberá indicar RUN y nombre completo del cliente respecto del cual se hizo el pago. El cliente entiende que, de no proporcionarse dicha información el pago no podrá ser imputado y descontado como mensualidad de su contrato hasta que se proporcione los antecedentes antes mencionados.
    </p>

    <p style="margin-top: 50px;">
        Las partes acuerdan que si alguno de los pagos aquí acordados, no fuese percibido o a su vencimiento informado, autorizará al Mandatario hacer exigible la totalidad de los pagos acordados según programa.
    </p>

    <p style="margin-top: 4rem;"><strong>Soc jurídica aboproc y asociados ________________________</strong></p>
    <p style="margin-top: 1rem;"><strong>{{ $data->customer->customer }}  ________________________</strong></p>
</body>
</html>
