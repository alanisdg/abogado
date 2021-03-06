@extends('layouts.app')

@section('title', $config['add'])

@section('content')
    <div class="">
        <div class="card-header">
            <h2 class="card-title">Tipo de Contrato</h2>
        </div>
    </div>
    <section class="horizontal-wizard">
        <div class="bs-stepper horizontal-wizard-example linear">
            <div class="bs-stepper-header">
                <div class="step" data-target="#customer">
                    <button type="button" class="step-trigger" aria-selected="false" disabled="disabled">
                        <span class="bs-stepper-box">1</span>
                        <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Cliente</span>
                        {{--<span class="bs-stepper-subtitle">Setup Account Details</span>--}}
                        </span>
                    </button>
                </div>
                <div class="line">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right font-medium-2"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </div>
                <div class="step active" data-target="#type-contract">
                    <button type="button" class="step-trigger" aria-selected="true">
                        <span class="bs-stepper-box">2</span>
                        <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Tipo de Contrato</span>
                        {{--<span class="bs-stepper-subtitle">Add Personal Info</span>--}}
                        </span>
                    </button>
                </div>
                <div class="line">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right font-medium-2"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </div>
                <div class="step" data-target="#address-step">
                    <button type="button" class="step-trigger" aria-selected="false" disabled="disabled">
                        <span class="bs-stepper-box">3</span>
                        <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Parametrizaci??n</span>
                        {{--<span class="bs-stepper-subtitle">Add Address</span>--}}
                        </span>
                    </button>
                </div>
                <div class="line">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right font-medium-2"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </div>
                <div class="step" data-target="#social-links">
                    <button type="button" class="step-trigger" aria-selected="false" disabled="disabled">
                        <span class="bs-stepper-box">4</span>
                        <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Confirmaci??n</span>
                        {{--<span class="bs-stepper-subtitle">Add Social Links</span>--}}
                        </span>
                    </button>
                </div>
            </div>
            <div class="bs-stepper-content">
                <div id="type-contract" class="content active dstepper-block">
                <div class="content-header">
                    <h5 class="mb-0">Tipo de Contrato</h5>
                </div>
                <form novalidate="novalidate">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <div class="demo-inline-spacing">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input" checked="">
                                    <label class="custom-control-label" for="customRadio1">Contrato de Prestaci??n de Servicios Jur??dicos</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">

                        </div>
                    </div>
                </form>
                <div class="d-flex justify-content-between mt-3">
                    @if ($config["typeRegister"] == "annexed")
                        @php
                            $url = "/list-contracts/annexes/add/customer/".session("idContract");
                            $url2 = "/list-contracts/annexes/add/parameters";
                        @endphp
                    @else
                        @php
                            $url = "/contract/create/customer";
                            $url2 = "/contract/create/parameters";
                        @endphp
                    @endif
                    <a href="{{ $url }}" class="btn btn-primary btn-next waves-effect waves-float waves-light">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left align-middle mr-sm-25 mr-0"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                        <span class="align-middle d-sm-inline-block d-none">Regresar</span>
                    </a>
                    <a href="{{ $url2 }}" class="btn btn-primary btn-next waves-effect waves-float waves-light">
                        <span class="align-middle d-sm-inline-block d-none">Siguiente</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right align-middle ml-sm-25 ml-0"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                    </a>
                </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        // Data customer
            let current_customer = localStorage.getItem('customer')

        // Current customer
            localStorage.setItem('current_customer', current_customer)
    </script>
@endsection
