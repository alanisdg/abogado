<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>FINIQUITO DE CONTRATO DE PRESTACION DE SERVICIOS PROFESIONALES</title>

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

    <p style="margin-top:120px;"><strong>FINIQUITO DE CONTRATO DE PRESTACION DE SERVICIOS PROFESIONALES</strong></p>

    <p style="margin-top:120px;">
        Entre <strong>ABOPROC</strong>, Rut: xx.xxx.xxx-x, representante legal Franco Caro Aguilera, Abogado, RUT. 19.094.981-8 domiciliado en Salar del Carmen 767, Santiago, en adelante indistintamente, “Estudio jurídico aboproc y Asociados” o “el mandatario” y don(a) <strong>{{ $contract->customer->customer }}</strong>, Cédula de Identidad número <strong>{{ $contract->customer->rut }}</strong>, domiciliado en, comuna de <strong>{{ $contract->customer->commune }}</strong>, ciudad de <strong>{{ $contract->customer->region }}</strong>, teléfono red fija número, celular número <strong>{{ $contract->customer->phone }}</strong>, correo electrónico	<strong>{{ $contract->customer->email }}</strong>, estado civil <strong>{{ $contract->customer->civil_status }}</strong>, ocupación	<strong>{{ $contract->customer->profession }}</strong>, en adelante indistintamente como “el cliente” o “el representado” se celebra, con fecha <strong>{{ date("d") }}</strong> del mes <strong>{{ date("m") }}</strong> del año <strong>{{ date("Y") }}</strong> la presente resciliación respecto del contrato de prestación de servicios profesionales celebrado entre las partes en razón de los antecedentes que a continuación se exponen.
    </p>

    <p style="margin-top: 50px;">
        <strong>PRIMERO:</strong> Que el cliente celebró con Sociedad jurídica Aboproc y asociados contrato de prestación de servicios profesionales con fecha <strong>{{ date("d", strtotime($contract->customer->created_at)) }}</strong> del mes <strong>{{ date("m", strtotime($contract->customer->created_at)) }} </strong>del año <strong>{{ date("Y", strtotime($contract->customer->created_at)) }}</strong>. En virtud dicho contrato se encargó a Aboproc: la protección judicial de los derechos e intereses de nuestro cliente frente a cualquier juicio ejecutivo que Acreedor 1, Acreedor 2, Acreedor 3 iniciara en su contra. - La presentación y tramitación del procedimiento concursal de Liquidación / Reorganización / Renegociación de persona / empresa deudora en virtud de lo establecido en la ley N°20.720 sobre Reorganización y Liquidación de Empresas y Personas. - Especificar otro servicio.
    </p>

    <p style="margin-top: 50px;">
        <strong>SEGUNDO:</strong> Por la prestación de los servicios profesionales el cliente se obligó al pago de <strong>${{ $contract->total_contract }}</strong>. - mil pesos, en <strong>{{ $contract->number_installments }}</strong> cuotas de <strong>${{ $contract->amount_fees }}</strong>. - mil pesos. En virtud de dichos honorarios el cliente pagó la suma correspondiente de $	. - mil pesos.
    </p>

    <p style="margin-top: 50px;">
        <strong>TERCERO:</strong> Las partes de común acuerdo otorgan el más amplio y completo finiquito al contrato de prestación de servicios profesionales individualizado en la cláusula primera de este instrumento. En consecuencia, don (a) <strong>{{ $contract->customer->customer }}</strong>	renuncia a todas las acciones judiciales y administrativas que pudiere interponer con relación al contrato de prestación de servicios profesionales.
    </p>

    <p style="margin-top: 50px;">
        <strong>CUARTO:</strong> Las partes declaran no tener pendiente ni deberse entre sí el pago de ninguna obligación, ya sea por concepto de honorarios profesionales o bien por la prestación de algún servicio de carácter profesional.
    </p>

    <p style="margin-top: 50px;">
        <strong>QUINTO:</strong> Las partes acuerdan que los términos de este contrato, sus anexos, documentos, comunicaciones, información enviada o recibida entre ellas durante la celebración, preparación y ejecución del contrato de prestación de servicios profesionales y en general cualquier antecedente que emane del vínculo contractual que en este acto se rescinde, reviste el carácter de confidencial. Con todo, las partes se obligan a guardar estricta reserva y confidencialidad respecto de toda la información, documentos, formularios, anexos y, en general, cualquier información o antecedente que por vía directa o indirecta hubieren obtenido o conocido con motivo del contrato de prestación de servicios profesionales salvo en cuanto pudieran ser requeridas cualquiera de las partes con dicha información en conformidad a la ley, por los tribunales de justicia, organismos fiscalizadores y/o entes reguladores competentes. Por su parte, Aboproc declara que todo tipo de información o antecedente que se vincule con el desarrollo del vínculo contractual existente con el cliente se encuentra debidamente protegido bajo el amparo del secreto profesional. En razón de lo anterior, salvo que medie un requerimiento de la autoridad o bien exista una obligación legal o reglamentaria, las partes no podrán entregar ni difundir parte alguna de la información o antecedentes señalados precedentemente, cualquiera sea el medio o canal dispuesto para aquello, salvo cuando se haya notificado el requerimiento a la otra parte por escrito en forma previa y oportuna y ésta haya autorizado por el mismo medio entregar o revelar la información confidencial para el caso en cuestión o bien haya renunciado total o parcialmente y de forma previa a la confidencialidad. La obligación de confidencialidad nace para las partes con la celebración de este contrato y se mantendrá en el tiempo con una vigencia indefinida a menos que ambas partes estipularen expresamente lo contrario. Las partes responderán de todo daño o perjuicio que se derive del incumplimiento de las obligaciones que se convienen en esta cláusula.
    </p>

    <p style="margin-top: 8rem;"><strong>Soc jurídica aboproc y asociados ________________________</strong></p>
    <p style="margin-top: 1rem;"><strong>RUT {{ $contract->customer->rut }}</strong></p>
</body>
</html>
