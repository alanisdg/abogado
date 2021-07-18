<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CONTRATO DE PRESTACIÓN DE SERVICIOS JURÍDICOS</title>

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

    <div style="width: 100%; text-align: center;">
        <h2 style="margin-top:120px;"><strong>CONTRATO DE PRESTACIÓN DE SERVICIOS JURÍDICOS</strong></h2>
    </div>

    <p style="margin-top:120px;">
        En Santiago de Chile, a <strong>{{ date("d-m-Y", strtotime($data->created_at)) }}</strong> entre ABOPROC, Rut N° (---), representada legalmente por don Franco Antonio Caro Aguilera, cedula nacional de identidad N° 19.094.981-8, ambos domiciliados para éstos efectos en Salar del Carmen número 767, comuna de Quilicura, ciudad de Santiago, en adelante indistintamente, “Estudio Jurídico”, “el mandatario“ o “ABOPROC”, y <strong>{{ $data->customer->customer }}</strong>, cedula nacional de identidad <strong>{{ $data->customer->rut }}</strong> , <strong>{{ $data->customer->nationality }}</strong>, <strong>{{ $data->customer->civil_status }}</strong>, <strong>{{ $data->customer->profession }}</strong>, domiciliado para estos efectos en <strong>{{ $data->customer->address }}</strong>, <strong>{{ $data->customer->commune }}</strong>, <strong>{{ $data->customer->region }}</strong>, <strong>{{ $data->customer->phone }}</strong>, <strong>{{ $data->customer->email }}</strong>, en adelante “el cliente”, se celebra el siguiente contrato remoto de prestación de servicios:
    </p>

    <h2>PRIMERO: SERVICIO CONTRATADO</h2>

    <p>
        El cliente encargará en virtud del presente contrato al mandatario su representación y asesoría jurídica en los procesos judiciales y/o extrajudiciales que a continuación se señalan:
    </p>

    <p style="margin-top: 20px;">
        <strong>PRIMERO:</strong> El motivo del presente contrato de actualización es modificar al actual titular de la cuenta, Doña/Don <strong>{{ $data->contract->customer->customer }}</strong> por Doña/Don <strong>{{ $data->new_headline }}</strong>, RUT: <strong>{{ $data->new_headline_rut }}</strong>, es decir que a partir de esta fecha <strong>{{ date("d", strtotime($data->created_at)) }}</strong> de {{ date("m", strtotime($data->created_at)) }}</strong> de {{ date("Y", strtotime($data->created_at)) }}</strong> nuestro cliente y mandante es: <strong>{{ $data->new_headline }}</strong>.
    </p>

    <p style="margin-top: 50px;">
        Por tanto, doña/don nombre nuevo cliente, encarga al mandatario la representación, tramitación y defensa de los juicios que se inicien en su contra producto de la cesación de pagos ante: Acreedores.
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
        <strong>TERCERO:</strong> Los gastos que demanden las gestiones correspondientes serán de cargo del cliente, quien deberá pagarlos previamente a su realización. Sin perjuicio de reembolsar los que hubiesen sido pagados por el mandatario.
    </p>

    <p style="margin-top: 50px;">
        <strong>CUARTO:</strong> El mandatario queda autorizado para percibir y retener directamente sus honorarios de las cantidades que reciba del cliente.
    </p>

    <p style="margin-top: 50px;">
        <strong>QUINTO:</strong> El cliente faculta al mandatario para designar abogados patrocinantes que representarán al cliente en las gestiones encargadas. El cliente se obliga a conferirle mandato judicial en la forma establecida en el artículo 6° del Código de Procedimiento Civil, a los abogados que el mandatario designe para tales efectos, confiriéndole la totalidad de las facultades señaladas en ambos incisos del artículo 7° del mismo cuerpo legal.
    </p>

    <p style="margin-top: 50px;">
        <strong>SEXTO:</strong> En el evento que el cliente quisiera desistirse del presente contrato o revocare el patrocinio y poder conferidos al mandatario o a alguno (s) de los abogados designados por éste, el cliente acepta que no procederá la devolución de los honorarios percibidos y/o devengados hasta ese momento, los cuales pertenecerán al mandatario, quien estará facultado para retenerlos y/o cobrarlos, según el caso. En el caso que el cliente quisiera desistir del presente contrato, deberá concurrir personalmente al Estudio, para ponerle término, previa liquidación de la de prestación de servicios. Las partes acuerdan que no será válido otro medio que no sea el señalado anteriormente. A su vez, en el caso que existan gestiones realizadas por el Estudio con ocasión del servicio contratado, y no estén cubiertos con los pagos realizados, el mandatario estará facultado para cobrar un monto proporcional, el cual será condición para proceder al término del contrato.
    </p>

    <p style="margin-top: 50px;">
        <strong>El Cliente entiende y acepta que, una vez finiquitado el servicio, o al  dejar  de  pagar  las  cuotas programadas, quedará en la indefensión total con relación a la o las causas previamente encargadas al Mandatario. Por lo tanto, el Mandatario se exime de toda responsabilidad sobre los daños morales o materiales que pudiera significarle al Cliente.</strong>
    </p>

    <p style="margin-top: 50px;">
        <strong>SEPTIMO:</strong> Las partes fijan domicilio en la ciudad de Santiago para todos los efectos legales de este contrato, prorrogando la competencia para ante sus tribunales.
    </p>

    <p style="margin-top: 50px;">
        <strong>OCTAVO:</strong> El Estudio Jurídicos Aboproc, se compromete a otorgar al Cliente el servicio contratado y especificado en la cláusula Primera cumpliendo todos los trámites legales en el plazo que indica la ley, sin perjuicio, de las facultades privativas del respectivo tribunal de establecer plazos acordes con el funcionamiento del mismo según corresponda.
    </p>

    <p style="margin-top: 50px;">
        <strong>NOVENO:</strong> El cliente se compromete a prestar su amplia colaboración en especial en la entrega de antecedentes, documentos y en otros en estas labores, al Estudio Jurídico Aboproc.
    </p>

    <p style="margin-top: 50px;">
        El presente contrato se firma en dos ejemplares quedando uno en poder de cada parte.
    </p>

    <p style="margin-top: 4rem;"><strong>Soc jurídica aboproc y asociados ________________________</strong></p>
    <p style="margin-top: 1rem;"><strong>{{ $data->new_headline }} ________________________</strong></p>
    <p><strong>{{ $data->new_headline_rut }} </strong></p>

    <p style="margin-top: 1rem;"><strong>{{ $data->contract->customer->customer }}  ________________________</strong></p>
    <p style=""><strong>RUT {{ $data->contract->customer->rut }}</strong></p>
</body>
</html>
