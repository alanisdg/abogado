@extends('layouts.app')

@section('title', __('Dashboard'))

@section('content')
    <section id="dashboard-ecommerce">
        <div class="row match-height">
            <!-- Statistics Card -->
            <div class="col-12">
                <div class="card card-statistics">
                    <div class="card-header">
                        <h4 class="card-title">Estadísticas</h4>
                </div>
                <div class="card-body statistics-body">
                    <div class="row">
                        @hasanyrole('executive_administrator|legal_administrator|legal_executive')
                            <div class="col-xl-4 col-sm-6 col-12 mb-2 mb-xl-0">
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
                            <div class="col-xl-4 col-sm-6 col-12 mb-2 mb-xl-0">
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
                            <div class="col-xl-4 col-sm-6 col-12 mb-2 mb-xl-0">
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
                        @endrole
                    </div>
                </div>
                </div>
            </div>
            <!--/ Statistics Card -->
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
