@extends('layouts.app')

@section('title', __('Dashboard'))

@section('content')
    <section id="dashboard-ecommerce">
        <div class="row match-height">
            <div class="col-12">
                <div class="card card-statistics">
                    <div class="card-header bg-primary">
                        @hasanyrole('executive_administrator|legal_administrator|collection_executive|legal_executive')
                            <h4 class="card-title text-white">Estadísticas Generales</h4>
                        @endrole
                        @hasanyrole('customer')
                            <h4 class="card-title text-white">Registro de Contratos</h4>
                        @endrole
                    </div>
                    <div class="card-body statistics-body">
                        @hasanyrole('customer')
                        @if ($user->terms == null)
                            @if ($message = Session::get('error'))
                            <div class="alert alert-danger alert-block p-1">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ $message }}</strong>
                            </div>
                            @endif
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <p>A continuación se muestra el contenido del contrato, por favor digitar su RUT si estás de acuerdo con las condiciones:</p>
                                <form class="auth-login-form mt-2" method="POST" action="/customer/complete" autocomplete="off">
                                    @csrf
                                    <div class="form-group">
                                        <label for="login-email" class="form-label">Nombre</label>
                                        <input
                                            type="text"
                                            class="form-control mb-2 @error('email') is-invalid @enderror"
                                            id="login-email"
                                            name="name"
                                            required
                                            placeholder="Nombre"
                                            aria-describedby="login-email"
                                            tabindex="1"
                                            autofocus
                                        />
                                        <label for="login-email" class="form-label">Rutificador</label>
                                        <input
                                            type="text"
                                            class="form-control @error('email') is-invalid @enderror"
                                            id="login-email"
                                            name="name"
                                            required
                                            value="{{$user->rut }}"
                                            placeholder="Nombre"
                                            aria-describedby="login-email"
                                            tabindex="1"
                                            autofocus
                                        />
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong> </strong>
                                            </span>
                                        @enderror
                                    </div>


                                    <div class="form-group">
                                        <label for="login-email" class="form-label">
                                            <input type="checkbox" name="terms" id="">
                                            Aceptar Términos y Condiciones</label>

                                    </div>
                                    <button class="btn btn-primary btn-block" tabindex="4">Continuar <i data-feather='log-in'></i></button>
                                </form>

                            </div>
                            <div class="col-md-8" style="height: 549px;
                            overflow: auto;">
                                  <img width="120" src="{{ asset('/backend/images/assets/logo.png') }}" alt="">

                                  <div style="width: 100%; text-align: center;">
                                      <h2 style="margin-top:120px;"><strong>CONTRATO DE PRESTACIÓN DE SERVICIOS JURÍDICOS</strong></h2>
                                  </div>

                                  <p style="margin-top:120px;">
                                      En Santiago de Chile, a <strong>{{ date("d-m-Y", strtotime($data->created_at)) }}</strong> entre ABOPROC, Rut N° 77.409.772-4, representada legalmente por don Franco Antonio Caro Aguilera, cedula nacional de identidad N° 19.094.981-8, ambos domiciliados para éstos efectos en Salar del Carmen número 767, comuna de Quilicura, ciudad de Santiago, en adelante indistintamente, “Estudio Jurídico”, “el mandatario“ o “ABOPROC”, y <strong>{{ $data->customer->customer }}</strong>, cedula nacional de identidad <strong>{{ $data->customer->rut }}</strong> , <strong>{{ $data->customer->nationality }}</strong>, <strong>{{ $data->customer->civil_status }}</strong>, <strong>{{ $data->customer->profession }}</strong>, domiciliado para estos efectos en <strong>{{ $data->customer->address }}</strong>, <strong>{{ $data->customer->commune }}</strong>, <strong>{{ $data->customer->region }}</strong>, <strong>{{ $data->customer->phone }}</strong>, <strong>{{ $data->customer->email }}</strong>, en adelante “el cliente”, se celebra el siguiente contrato remoto de prestación de servicios:
                                  </p>

                                  <h3 style="margin-top: 50px;">PRIMERO: SERVICIO CONTRATADO</h3>

                                  <p>
                                      El cliente encargará en virtud del presente contrato al mandatario su representación y asesoría jurídica en los procesos judiciales y/o extrajudiciales que a continuación se señalan:
                                  </p>

                                  <p style="margin-top: 20px;">
                                     <strong>{{ $data->causes->first()->number_rit }} - {{ $data->causes->first()->court }} - {{ $data->causes->first()->matter }}</strong>
                                  </p>

                                  <p style="margin-top: 20px;">
                                      El mandante en el marco de los servicios encargados estará obligado a proporcionar al mandatario toda la información necesaria para la correcta realización del encargo. Será responsabilidad del cliente los errores que se produzcan por el hecho de haber entregado información falsa, incompleta o imprecisa.
                                  </p>

                                  <p style="margin-top: 20px;">
                                      El Estudio Jurídico se obliga a otorgar al cliente el servicio contratado cumpliendo con todos los trámites legales dentro de los plazos que indica la ley, sin perjuicio de las facultades privativas del respectivo tribunal que conoce de la causa para establecer plazos acordes con el funcionamiento de su jurisdicción según corresponda.
                                  </p>

                                  <p style="margin-top: 20px;">
                                      El cliente se obliga a obtener la Identidad Electrónica Única, conformada por su RUN más una clave única, e informarla oportunamente al mandatario con el objeto de monitorear los procesos judiciales que se encuentren ingresados en la Oficina Judicial Virtual del cliente y autoriza expresamente a ABOPROC a utilizar dicha identificación Electrónica Única exclusivamente para los fines que digan relación con el objeto del presente contrato.
                                  </p>

                                  <p style="margin-top: 20px;">
                                      El cliente se obliga a prestar su más amplia colaboración para la gestión diligente de sus juicios encargados al mandatario, teniendo presente que en ocasiones sobre él pesará la obligación de dar prosecución a distintas instancias procesales, tales como: la entrega de antecedentes o documentos, el pago de honorarios para encargos a receptores judiciales, el ofrecimiento oportuno de testigos o bien su comparecencia ante el ministro de fe del tribunal.
                                  </p>

                                  <h3 style="margin-top: 50px;">SEGUNDO: PRECIO DE LOS SERVICIOS</h3>

                                  <p style="margin-top: 20px;">
                                      El cliente pagará al mandatario como contraprestación por los servicios contratados la suma de <strong>$ {{ $data->total_contract }}</strong> contrato pagaderos según el siguiente plan de pago:
                                  </p>

                                  <table style="margin-top: 20px;">
                                      <thead>
                                          <tr>
                                              <th>N° de Cuota</th>
                                              <th>Fecha de Pago</th>
                                              <th>Monto</th>
                                              <th>Estado</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          @foreach ($data->collections as $collection)
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

                                  <p style="margin-top: 20px;">
                                      Para efectuar el pago el cliente contará con los siguientes canales de recepción de pagos, sin perjuicio de que el mandatario pueda modificarlos con posterioridad a la celebración del presente contrato, en cuyo caso el mandatario informará de dicha modificación mediante su página web o bien por la sucursal virtual del cliente:
                                  </p>

                                  <p style="margin-top: 20px;">
                                     <strong>1. </strong>Depósito Bancario en la cuenta corriente del Banco Santander Nº 0-000-83-16220-1 a nombre de Franco Caro RUT 19.094.981-8. En este caso el cliente deberá enviar el comprobante de pago a la casilla de correo señala para estos efectos. Si quien deposita es un tercero distinto del cliente, en dicho correo se deberá indicar RUN y nombre completo del cliente respecto del cual se hizo el pago. El cliente entiende que, de no proporcionarse dicha información el pago no podrá ser imputado y descontado como mensualidad de su contrato hasta que se proporcione los antecedentes antes mencionados.
                                  </p>

                                  <p style="margin-top: 20px;">
                                      <strong>2. </strong>Transferencia Electrónica corriente del Banco Santander Nº 0-000-83-16220-1 a nombre de Franco Caro RUT 19.094.981-8. En este caso el cliente deberá enviar el comprobante de pago a la casilla de correo indicada para tales efectos. Si quien realiza la transferencia es un tercero distinto del cliente, en dicho correo se deberá indicar RUN y nombre completo del cliente respecto del cual se hizo el pago. El cliente entiende que, de no proporcionarse dicha información el pago no podrá ser imputado y descontado como mensualidad de su contrato hasta que se proporcione los antecedentes antes mencionados.
                                  </p>

                                  <h3 style="margin-top: 50px;">TERCERO: GASTOS DEL JUICIO</h3>

                                  <p style="margin-top: 20px;">
                                      Los gastos procesales o extraprocesales que demanden las gestiones correspondientes serán de cargo del cliente, quien deberá pagarlos previamente a su realización sin perjuicio de reembolsar los que hubiesen sido pagados por el mandatario.
                                  </p>

                                  <p style="margin-top: 20px;">
                                      En el caso que el cliente deposite fondos al mandatario con el propósito de que este gestione algún encargo o gasto relativo al proceso judicial, el mandatario se obliga a rendir cuenta de dichos gastos a expresa solicitud del mandante, solicitud que podrá efectuar mediante los canales de información que ABOPROC ha establecido para el contacto con sus clientes. Adicionalmente, el mandatario se obliga a devolver el excedente de dinero que reste como diferencia a favor del cliente salvo que este manifieste su intención de mantener dicha diferencia monetaria como un abono para futuros trámites o bien desee imputarlo como pago a sus honorarios.
                                  </p>

                                  <h3 style="margin-top: 50px;">CUARTO: DESIGNACIÓN DE ABOGADOS PATROCINANTES</h3>

                                  <p style="margin-top: 20px;">
                                      El cliente faculta al mandatario para designar abogados patrocinantes que representarán al cliente en las gestiones encargadas. El cliente se obliga a conferirles mandato judicial en la forma establecida en el artículo 6° del Código de Procedimiento Civil, confiriéndoles la totalidad de las facultades señaladas en ambos incisos del artículo 7° del mismo cuerpo legal.
                                  </p>

                                  <h3 style="margin-top: 50px;">QUINTO: DESESTIMIENTO O TERMINACIÓN DEL CONTRATO</h3>

                                  <p style="margin-top: 20px;">
                                      En el evento que el cliente quisiera desistirse del presente contrato o revocare el patrocinio y poder conferidos al mandatario o a alguno (s) de los abogados designados por éste, éste acepta expresamente que no procederá la devolución de los honorarios percibidos y/o devengados hasta el día en que comunica al mandatario su intención de desistirse del presente contrato, en tal caso los honorarios pertenecerán al mandatario, quien estará facultado para retenerlos y/o cobrarlos, según sea el caso.
                                  </p>

                                  <p style="margin-top: 20px;">
                                      El cliente podrá concurrir a las dependencias del Estudio Jurídico señaladas para estos efectos, sin perjuicio de tener la facultad de comunicarse por las vías remotas destinadas para este propósito con el fin de solicitar la terminación del presente contrato, debiendo registrar su consentimiento según los mecanismos electrónicos que el mandatario disponga al efecto.
                                  </p>

                                  <p style="margin-top: 20px;">
                                      Cualquiera que sea el mecanismo adoptado para la terminación del presente contrato, éste se efectuará previa liquidación de los honorarios adeudados por la prestación de los servicios y/o de los gastos judiciales o extrajudiciales de los trámites pendientes que hayan sido costeados por el mandatario.
                                  </p>

                                  <p style="margin-top: 20px;">
                                      El cliente declara entender que, de no cumplir con el pago oportuno de una o más cuotas del precio acordado como pago de la prestación de servicios profesionales que deriva del presente contrato, el mandatario podrá poner término a la presente relación contractual, debiendo informar de esta situación al cliente a través de los canales dispuestos para la comunicación con sus clientes.
                                  </p>

                                  <p style="margin-top: 20px;">
                                      El cliente comprende que, en caso de desistimiento del presente contrato no procederá la devolución de los honorarios percibidos y/o devengados hasta el día en que comunica al mandatario su intención de terminar del presente contrato, en tal caso los honorarios pertenecerán al mandatario, quien estará facultado para retenerlos y/o cobrarlos, según el caso.
                                  </p>

                                  <h3 style="margin-top: 50px;">SEXTO: EFECTOS DE LA TERMINACIÓN DEL CONTRATO O DEL NO PAGO DE HONORARIOS</h3>

                                  <p style="margin-top: 20px;">
                                      El cliente entiende y acepta expresamente que, una vez finiquitado el servicio o al cesar en el pago oportuno de las cuotas acordadas en el plan de pago establecido en la cláusula segunda, el Estudio Jurídico, previo análisis del estado procesal de su causa, dejará de prestar el servicio indicado en la cláusula primera, recayendo en él la responsabilidad que de esta situación derive.
                                  </p>

                                  <p style="margin-top: 20px;">
                                      Lo anterior implica una renuncia al patrocinio judicial asumido por los abogados de ABOPROC respecto de los procesos judiciales en los términos señalados en la ley N°18.120, lo que en todo caso se hará siempre precaviendo el cumplimiento del principio de indefensión que resguarda al cliente y que inspira la ley procesal.
                                  </p>

                                  <h3 style="margin-top: 50px;">SÉPTIMO: DECLARACIÓN</h3>

                                  <p style="margin-top: 20px; ">
                                      El cliente declara que al momento de contratar el servicio, fue informado en forma clara, precisa y oportuna respecto de los elementos esenciales que conforman este contrato, particularmente respecto al alcance de los servicios y/o juicios contratados, el precio, la forma de pago y los canales de recepción de él, la existencia de gastos accesorios a los procedimientos judiciales, canales de atención al cliente para recabo de información sobre el estado procesal de las causas judiciales contratadas, la naturaleza de la obligación de medio que reviste al mandatario, la obligación de confidencialidad que irroga a los contratantes y, en general, todo elemento considerado como esencial para el correcto desempeño del presente contrato.
                                  </p>
                                  <img style="margin-top: 20px;" src="https://appaboproc.com/backend/images/assets/firma.JPG">
                            </div>
                        </div>
                        @endif

                        @endrole

                        @hasanyrole('executive_administrator|legal_administrator')
                            <div class="row">
                                <div class="col-xl-3 col-sm-6 col-12 mt-2 mb-xl-0">
                                    <div class="d-flex flex-row">
                                        <div class="avatar bg-light-danger me-2">
                                            <div class="avatar-content">
                                                <i data-feather='x-square'></i>
                                            </div>
                                        </div>
                                        <div class="my-auto ml-2">
                                            <h2 class="fw-bolder mb-0">{{ $lostContracts }}</h2>
                                            <p class="card-text font-small-5 mb-0">Contratos Perdidos</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-sm-6 col-12 mt-2 mb-xl-0">
                                    <div class="d-flex flex-row">
                                        <div class="avatar bg-light-success me-2">
                                            <div class="avatar-content">
                                                <i data-feather='check-square'></i>
                                            </div>
                                        </div>
                                        <div class="my-auto ml-2">
                                            <h2 class="fw-bolder mb-0">{{ $contractsWon }}</h2>
                                            <p class="card-text font-small-5 mb-0">Contratos Ganados</p>
                                        </div>
                                    </div>
                                </div>
                        @endrole
                        @hasanyrole('executive_administrator|legal_administrator|legal_executive')

                                <div class="col-xl-3 col-sm-6 col-12 mt-2 mb-xl-0">
                                    <div class="d-flex flex-row">
                                        <div class="avatar bg-light-primary me-2">
                                            <div class="avatar-content">
                                                <i data-feather='users'></i>
                                            </div>
                                        </div>
                                        <div class="my-auto ml-2">
                                            <h2 class="fw-bolder mb-0">{{ $pendingClients }}</h2>
                                            <p class="card-text font-small-5 mb-0">Clientes Pendientes</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-sm-6 col-12 mt-2 mb-xl-0">
                                    <div class="d-flex flex-row">
                                        <div class="avatar bg-light-success me-2">
                                            <div class="avatar-content">
                                                <i data-feather='clipboard'></i>
                                            </div>
                                        </div>
                                        <div class="my-auto ml-2">
                                            <h2 class="fw-bolder mb-0">{{ $pendingTasks }}</h2>
                                            <p class="card-text font-small-5 mb-0">Tareas Pendientes</p>
                                        </div>
                                    </div>
                                </div>
                        @endrole
                        @hasanyrole('executive_administrator|legal_administrator|collection_executive')
                                <div class="col-xl-2 col-sm-6 col-12 mt-2 mb-xl-0">
                                    <div class="d-flex flex-row">
                                        <div class="avatar bg-light-warning me-2">
                                            <div class="avatar-content">
                                                <i data-feather='archive'></i>
                                            </div>
                                        </div>
                                        <div class="my-auto ml-2">
                                            <h2 class="fw-bolder mb-0">{{ $pendingFees }}</h2>
                                            <p class="card-text font-small-5 mb-0">Cuotas Pendientes</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endrole
                        @hasanyrole('customer')
                        @if ($user->terms != null)
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Contrato</th>
                                            <th scope="col">Fecha de Registro</th>
                                            <th scope="col">Monto Total</th>
                                            <th scope="col">Cuotas</th>
                                            <th scope="col">Primera Fecha de Pago</th>
                                            <th scope="col" class="text-center">Botones</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($dataContract->contracts as $item)
                                            <tr>
                                                <td style="width: 20%">{{ $item->type_contract}}</td>
                                                <td style="width: 20%">{{ date("d-m-Y", strtotime($item->created_at)) }}</td>
                                                <td style="width: 15%"><strong>$</strong>{{ $item->total_contract}}</td>
                                                <td style="width: 10%">{{ $item->number_installments}}</td>
                                                <td style="width: 15%">{{ date("d-m-Y", strtotime($item->first_installment_payment_date))}}</td>
                                                <td style="width: 20%" class="text-center">
                                                    <a href="{{ url('list-causes/'.$item->id) }}" title="Causas" class="btn btn-warning btn-sm">
                                                        Causas
                                                    </a>
                                                    <a href="{{ url('list-fees/'.$item->id) }}" title="Cuotas" class="btn btn-primary btn-sm">
                                                        Cuotas
                                                    </a>

                                                </td>
                                                <td>
                                                    <a href="{{ url('biblioteca/'.$item->id) }}"  class="btn btn-primary btn-sm">
                                                        Biblioteca
                                                    </a>
                                                    <a href="{{ url('updloadFile/'.$item->id) }}"  class="btn btn-primary btn-sm">
                                                        Subir Archivo
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5">No hay registros de Contratos</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            @endif
                        @endrole
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('scripts')
    <script>
        // Clear localstorage
            document.addEventListener("DOMContentLoaded", function () {
                localStorage.removeItem('customer')
                localStorage.removeItem('cuotes')
                localStorage.removeItem('contract_parameters')
                localStorage.removeItem('current_customer')
            })
    </script>
@endsection
