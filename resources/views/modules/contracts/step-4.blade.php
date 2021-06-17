@extends('layouts.app')

@if ($typeForm == 'create')
    @section('title', $config['add'])
@else
    @section('title', $config['edit'])
@endif

@section('content')
    <div class="">
        <div class="card-header">
            @if ($typeForm == 'create')
                <h2 class="card-title">Cofirmación</h2>
            @else
                <h4 class="card-title">{{ $config['edit'] }}</h4>
            @endif
        </div>
    </div>
    <section class="horizontal-wizard">
        <div class="bs-stepper horizontal-wizard-example linear">
            <div class="bs-stepper-header">
                <div class="step" data-target="#customers">
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
                <div class="step" data-target="#type-contract">
                    <button type="button" class="step-trigger" aria-selected="false" disabled="disabled">
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
                <div class="step" data-target="#parameters">
                    <button type="button" class="step-trigger" aria-selected="false" disabled="disabled">
                        <span class="bs-stepper-box">3</span>
                        <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Parametrización</span>
                        {{--<span class="bs-stepper-subtitle">Add Address</span>--}}
                        </span>
                    </button>
                </div>
                <div class="line">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right font-medium-2"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </div>
                <div class="step active" data-target="#confirmation">
                    <button type="button" class="step-trigger" aria-selected="true">
                        <span class="bs-stepper-box">4</span>
                        <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Confirmación</span>
                        {{--<span class="bs-stepper-subtitle">Add Social Links</span>--}}
                        </span>
                    </button>
                </div>
            </div>
            <div class="bs-stepper-content">
                <div id="customers" class="content active dstepper-block">
                    <section id="basic-divider">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="divider">
                                            <div class="divider-text"><h4>CLIENTE</h4></div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-4">
                                                <label class="form-label" for="customer">Nombre</label>
                                                <input type="text" name="customer" id="customer" class="form-control" onkeyup = "upperCase(this);" readonly>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label class="form-label" for="rut">RUT</label>
                                                <input type="text" name="rut" id="rut" class="form-control" onkeyup = "upperCase(this);" readonly>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label class="form-label" for="nationality">Nacionalidad</label>
                                                <input type="text" name="nationality" id="nationality" class="form-control" onkeyup = "upperCase(this);" readonly>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-4">
                                                <label class="form-label" for="customer">Estado Civil</label>
                                                <input type="text" name="civil_status" id="civil_status" class="form-control" onkeyup = "upperCase(this);" readonly>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label class="form-label" for="profession">Profesión</label>
                                                <input type="text" name="profession" id="profession" class="form-control" onkeyup = "upperCase(this);" readonly>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label class="form-label" for="email">Email</label>
                                                <input type="text" name="email" id="email" class="form-control" onkeyup = "upperCase(this);" readonly>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-4">
                                                <label class="form-label" for="phone">Teléfono</label>
                                                <input type="text" name="phone" id="phone" class="form-control" onkeyup = "upperCase(this);" readonly>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label class="form-label" for="commune">Comuna</label>
                                                <input type="text" name="commune" id="commune" class="form-control" onkeyup = "upperCase(this);" readonly>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label class="form-label" for="region">Región</label>
                                                <input type="text" name="region" id="region" class="form-control" onkeyup = "upperCase(this);" readonly>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label class="form-label" for="customer">Dirección</label>
                                                <input type="text" name="address" id="address" class="form-control" onkeyup = "upperCase(this);" readonly>
                                            </div>
                                        </div>
                                        <div class="divider">
                                            <div class="divider-text"><h4>CAUSA</h4></div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label class="form-label" for="date">Fecha</label>
                                                <input type="text" name="contract_date" id="contract_date" class="form-control" readonly>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label" for="number_rit">Número de RIT</label>
                                                <input type="text" name="number_rit" id="number_rit" class="form-control" onkeyup = "upperCase(this);" readonly>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label class="form-label" for="cours">Tribunal</label>
                                                <input type="text" name="cours" id="cours" class="form-control" onkeyup = "upperCase(this);" readonly>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label" for="matter">Materia</label>
                                                <input type="text" name="matter" id="matter" class="form-control" onkeyup = "upperCase(this);" readonly>
                                            </div>
                                        </div>
                                        <div class="divider">
                                            <div class="divider-text"><h4>COBRANZA</h4></div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label class="form-label" for="total_contract">Total de Contrato</label>
                                                <input type="text" name="total_contract" id="total_contract" class="form-control" readonly>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label" for="first_payment_date">Fecha del Primer Pago</label>
                                                <input type="date" name="first_payment_date" id="first_payment_date" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-4">
                                                <label class="form-label" for="first_payment_amount">Monto Primer Pago</label>
                                                <input type="text" name="first_payment_amount" id="first_payment_amount" class="form-control" readonly>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label class="form-label" for="amount_installments">Cantidad de Cuotas</label>
                                                <input type="number" name="amount_installments" id="amount_installments" class="form-control" readonly>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label class="form-label" for="amount_fees">Monto de Cuotas</label>
                                                <input type="text" name="amount_fees" id="amount_fees" class="form-control" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <div class="d-flex justify-content-between">
                        <a href="{{ url('contract/create/parameters') }}" class="btn btn-primary btn-next waves-effect waves-float waves-light">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left align-middle mr-sm-25 mr-0"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                            <span class="align-middle d-sm-inline-block d-none">Regresar</span>
                        </a>
                        <form>
                            @csrf
                            <input type="hidden" name="data_customer" id="data_customer">
                            <input type="hidden" name="data_parameters" id="data_parameters">
                            <input type="hidden" name="data_cuotes" id="data_cuotes">

                            <button type="button" onclick="sendForm()" class="btn btn-primary btn-next waves-effect waves-float waves-light">
                                <span class="align-middle d-sm-inline-block d-none">Confirmar</span>
                                <i data-feather='check-square'></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Get current customer variable
                let current_customer = JSON.parse(localStorage.getItem('current_customer'))
                let contract_parameters = JSON.parse(localStorage.getItem('contract_parameters'))
                let cuotes = JSON.parse(localStorage.getItem('cuotes'))

                document.getElementById("data_customer").value = JSON.stringify(current_customer)
                document.getElementById("data_parameters").value = JSON.stringify(contract_parameters)
                document.getElementById("data_cuotes").value = JSON.stringify(cuotes)

                document.getElementById("customer").value = current_customer[0]
                document.getElementById("civil_status").value = current_customer[1]
                document.getElementById("rut").value = current_customer[2]
                document.getElementById("profession").value = current_customer[3]
                document.getElementById("nationality").value = current_customer[4]
                document.getElementById("address").value = current_customer[5]
                document.getElementById("phone").value = current_customer[6]
                document.getElementById("commune").value = current_customer[7]
                document.getElementById("email").value = current_customer[8]
                document.getElementById("region").value = current_customer[9]

                document.getElementById("contract_date").value = contract_parameters[0]
                document.getElementById("number_rit").value = contract_parameters[2]
                document.getElementById("cours").value = contract_parameters[4]
                document.getElementById("matter").value = contract_parameters[6]

                document.getElementById("total_contract").value = contract_parameters[1]
                document.getElementById("first_payment_date").value = contract_parameters[3]
                document.getElementById("first_payment_amount").value = contract_parameters[5]

                document.getElementById("amount_installments").value = cuotes[0]
                document.getElementById("amount_fees").value = cuotes[1]

            // Create localstorage
                localStorage.setItem('contract_parameters', JSON.stringify(contract_parameters))
                localStorage.setItem('cuotes', JSON.stringify(cuotes))
        })

        // Send form
            function sendForm() {
                // Variables
                    let customer = document.getElementById('data_customer').value
                    let parameters = document.getElementById('data_parameters').value
                    let cuotes = document.getElementById('data_cuotes').value
                    let url = '/contract/register'
                    let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content')

                // Send info
                    fetch(url, {
                        headers: {
                            "Content-Type": "application/json",
                            "Accept": "application/json, text-plain, */*",
                            "X-Requested-With": "XMLHttpRequest",
                            "X-CSRF-TOKEN": token
                        },
                        method: 'post',
                        credentials: "same-origin",
                        body: JSON.stringify({
                            data_customer: customer,
                            data_parameters: parameters,
                            data_cuotes: cuotes
                        })
                    })
                    .then((response) => response.json())
                    .then((data) => {
                        if (data == 1) {
                            toastr["success"]("", "¡Contrato Creado!")

                            localStorage.removeItem('customer')
                            localStorage.removeItem('cuotes')
                            localStorage.removeItem('contract_parameters')
                            localStorage.removeItem('current_customer')

                            window.setTimeout(function () {
                                window.location.href = "/list-contracts/list"
                            }, 5000)
                        }
                    })
                    .catch(function(error) {
                        //emptyInputs()
                        clearVariables()
                        location.reload()

                        toastr["error"]("", "¡Error en la consulta de clientes!")
                    });
            }
    </script>
@endsection
