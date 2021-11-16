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
                            <div class="col-md-6">
                                <form class="auth-login-form mt-2" method="POST" action="/customer/complete" autocomplete="off">
                                    @csrf
                                    <div class="form-group">
                                        <label for="login-email" class="form-label">Nombre</label>
                                        <input
                                            type="text"
                                            class="form-control @error('email') is-invalid @enderror"
                                            id="login-email"
                                            name="name"
                                            required
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
                            <div class="col-md-6" style="height: 249px;
                            overflow: auto;">
                                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quia corrupti, quas nam eaque nesciunt ipsam quos tenetur deserunt, voluptatum possimus enim totam provident quisquam, est quasi dolor eligendi fugit! Dolorum!
                                <br>
                                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quia corrupti, quas nam eaque nesciunt ipsam quos tenetur deserunt, voluptatum possimus enim totam provident quisquam, est quasi dolor eligendi fugit! Dolorum!
                                <br>
                                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quia corrupti, quas nam eaque nesciunt ipsam quos tenetur deserunt, voluptatum possimus enim totam provident quisquam, est quasi dolor eligendi fugit! Dolorum!
                                <br>
                                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quia corrupti, quas nam eaque nesciunt ipsam quos tenetur deserunt, voluptatum possimus enim totam provident quisquam, est quasi dolor eligendi fugit! Dolorum!
                                <br>
                                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quia corrupti, quas nam eaque nesciunt ipsam quos tenetur deserunt, voluptatum possimus enim totam provident quisquam, est quasi dolor eligendi fugit! Dolorum!
                                <br>
                                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quia corrupti, quas nam eaque nesciunt ipsam quos tenetur deserunt, voluptatum possimus enim totam provident quisquam, est quasi dolor eligendi fugit! Dolorum!
                                <br>
                                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quia corrupti, quas nam eaque nesciunt ipsam quos tenetur deserunt, voluptatum possimus enim totam provident quisquam, est quasi dolor eligendi fugit! Dolorum!
                                <br>
                                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quia corrupti, quas nam eaque nesciunt ipsam quos tenetur deserunt, voluptatum possimus enim totam provident quisquam, est quasi dolor eligendi fugit! Dolorum!
                                <br>
                                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quia corrupti, quas nam eaque nesciunt ipsam quos tenetur deserunt, voluptatum possimus enim totam provident quisquam, est quasi dolor eligendi fugit! Dolorum!
                                <br>
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
