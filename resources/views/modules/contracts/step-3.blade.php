@extends('layouts.app')

@section('title', $config['add'])

@section('content')
    <div class="">
        <div class="card-header">
            <h2 class="card-title">{{ $config['add'] }}</h2>
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
                <div class="step active" data-target="#parameters">
                    <button type="button" class="step-trigger" aria-selected="true">
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
                <div class="step" data-target="#social-links">
                    <button type="button" class="step-trigger" aria-selected="false" disabled="disabled">
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
                <form class="" autocomplete="off">
                    <input type="hidden" value="{{ $config["typeRegister"] }}" id="type_register">
                    <div class="row mt-1 mb-1">
                        <div class="col-12">
                            <span class="text-danger"> <strong>Nota: </strong> Por favor ingrese el RUT en el formato correcto.</span>
                        </div>
                        <div class="col-12">
                            <span class="text-danger"> <strong>Ejemplo: </strong> 16407136-7 o 9407136-1.</span>
                        </div>
                        <div class="col-12">
                            <span class="text-danger"> <strong>* : </strong> Campos Requeridos.</span>
                        </div>
                    </div>
                    <div class="divider mb-2">
                        <div class="divider-text"></div>
                      </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="form-label" for="date">Fecha <span class="text-danger">*</span></label>
                            <input type="text" name="date" id="contract_date" class="form-control" value="{{ date("Y-m-d") }}" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="first-name-icon">Total del Contrato <span class="text-danger">*</span></label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i data-feather='dollar-sign'></i></span>
                                </div>
                                {!! Form::text("total_contract", old('total_contract', @$row->total_contract), ["class" => "form-control", "id" => "total_contract"]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="form-label" for="number_rit">Número de RIT <span class="text-danger">*</span></label>
                            <input type="text" name="number_rit" id="number_rit" class="form-control" onkeyup = "upperCase(this);">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="first_payment_date">Fecha del Primer Pago <span class="text-danger">*</span></label>
                            <input type="date" name="first_payment_date" id="first_payment_date" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="form-label" for="cours">Tribunal <span class="text-danger">*</span></label>
                            <input type="text" name="cours" id="cours" class="form-control" onkeyup = "upperCase(this);">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="first_payment_amount">Monto Primer Pago <span class="text-danger">*</span></label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i data-feather='dollar-sign'></i></span>
                                </div>
                                {!! Form::text("first_payment_amount", old('first_payment_amount', @$row->first_payment_amount), ["class" => "form-control", "id" => "first_payment_amount"]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="form-label" for="matter">Materia <span class="text-danger">*</span></label>
                            <input type="text" name="matter" id="matter" class="form-control" onkeyup = "upperCase(this);">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="first_installment_payment_date">Fecha de Pago Primera Cuota <span class="text-danger">*</span></label>
                            <input type="date" name="first_installment_payment_date" id="first_installment_payment_date" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="amount_installments">Cantidad de Cuotas <span class="text-danger">*</span></label>
                            <input type="number" name="amount_installments" id="amount_installments" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">

                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="amount_fees">Monto de Cuotas <span class="text-danger">*</span></label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i data-feather='dollar-sign'></i></span>
                                </div>
                                {!! Form::text("amount_fees", old('amount_fees', @$row->amount_fees), ["class" => "form-control", "id" => "amount_fees", "readonly", "onclick" => "calculateCuotes()", "onfocus" => "calculateCuotes()"]) !!}
                            </div>
                        </div>
                    </div>
                </form>
                <div class="d-flex justify-content-between">
                    @if ($config["typeRegister"] == "annexed")
                        @php
                            $url = "/list-contracts/annexes/add/type_contract";
                        @endphp
                    @else
                        @php
                            $url = "/contract/create/type-contract";
                        @endphp
                    @endif
                    <a href="{{ $url }}" class="btn btn-primary btn-next waves-effect waves-float waves-light">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left align-middle mr-sm-25 mr-0"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                        <span class="align-middle d-sm-inline-block d-none">Regresar</span>
                    </a>

                    <button onclick="storeParameters()" class="btn btn-primary btn-next waves-effect waves-float waves-light">
                        <span class="align-middle d-sm-inline-block d-none">Siguiente</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right align-middle ml-sm-25 ml-0"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                    </button>
                </div>
            </div>
          </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        $("#total_contract").on({
            "focus": function(event) {
                $(event.target).select();
            },
            "keyup": function(event) {
                $(event.target).val(function(index, value) {
                return value.replace(/\D/g, "")
                    .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ".");
                });
            }
        });

        $("#first_payment_amount").on({
            "focus": function(event) {
                $(event.target).select();
            },
            "keyup": function(event) {
                $(event.target).val(function(index, value) {
                return value.replace(/\D/g, "")
                    .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ".");
                });
            }
        });

        // Calculate cuotes
            function calculateCuotes()
            {
                // Varibales
                    let total_contract = document.getElementById('total_contract').value,
                        first_payment_amount = document.getElementById('first_payment_amount').value
                        amount_installments = document.getElementById('amount_installments').value


                // Calculate
                    let totalContract = total_contract.replace('.', ''),
                        totalFirstPayment = first_payment_amount.replace('.', ''),
                        totalCost = (parseFloat(totalContract.replace('.', '')) - parseFloat(totalFirstPayment.replace('.', ''))) / parseFloat(amount_installments)
                        //total = Math.floor(totalCost)

                // Assignate
                    //document.getElementById('amount_fees').value = String(totalCost).replace(/(.)(?=(\d{3})+$)/g,'$1,')
                    document.getElementById('amount_fees').value = totalCost.toLocaleString("de-DE", {minimumFractionDigits: 0})

            }

        // Validate localstorage, contract parameters
            document.addEventListener("DOMContentLoaded", function () {
                // Get current customer variable
                    let contract_parameters = JSON.parse(localStorage.getItem('contract_parameters')),
                        cuotes = JSON.parse(localStorage.getItem('cuotes'))

                    if (contract_parameters != null) {
                        document.getElementById("contract_date").value = contract_parameters[0]
                        document.getElementById("number_rit").value = contract_parameters[2]
                        document.getElementById("cours").value = contract_parameters[5]
                        document.getElementById("matter").value = contract_parameters[7]

                        document.getElementById("total_contract").value = contract_parameters[1]
                        document.getElementById("first_payment_date").value = contract_parameters[3]
                        document.getElementById("first_payment_amount").value = contract_parameters[6]
                        document.getElementById("first_installment_payment_date").value = contract_parameters[4]

                        document.getElementById("amount_installments").value = cuotes[0]
                        document.getElementById("amount_fees").value = cuotes[1]

                    // Create localstorage
                        localStorage.setItem('contract_parameters', JSON.stringify(contract_parameters))
                        localStorage.setItem('cuotes', JSON.stringify(cuotes))
                    }
            })

        // Customer current rut
            let customer_rut = localStorage.getItem('current_customer_rut')

        // Create new variable in localstorage with current customer rut
            localStorage.setItem('current_customer_rut', customer_rut)

        // Store parameters
            function storeParameters() {

                let type_register = document.getElementById('type_register').value,
                    url = (type_register == "annexed") ? "/list-contracts/annexes/add/confirm" : "/contract/create/confirmation",
                    contract_date = document.getElementById('contract_date').value,
                    total_contract = document.getElementById('total_contract').value,
                    number_rit = document.getElementById('number_rit').value,
                    first_payment_date = document.getElementById('first_payment_date').value,
                    first_installment_payment_date = document.getElementById('first_installment_payment_date').value,
                    cours = document.getElementById('cours').value,
                    first_payment_amount = document.getElementById('first_payment_amount').value,
                    matter = document.getElementById('matter').value

                // Validamos todos los campos
                    const data_inputs = [contract_date, total_contract, number_rit, first_payment_date, first_installment_payment_date, cours, first_payment_amount, matter]
                    let input_empty = ""

                    if (data_inputs.includes(input_empty)) {
                        toastr["error"]("", "¡Ingrese los detalles completos!")
                    }
                    else {

                        // Comparamos sfecha del primer pago y pago de l aprimera cuota
                            let date1 = new Date(first_payment_date)
                                date2 = new Date(first_installment_payment_date)

                            if (date1< date2) {

                                    let parameters = [
                                        contract_date,
                                        total_contract,
                                        number_rit,
                                        first_payment_date,
                                        first_installment_payment_date,
                                        cours,
                                        first_payment_amount,
                                        matter
                                    ]

                                    let cuotes = [
                                        document.getElementById('amount_installments').value,
                                        document.getElementById('amount_fees').value,
                                    ]

                                    localStorage.setItem('contract_parameters', JSON.stringify(parameters))
                                    localStorage.setItem('cuotes', JSON.stringify(cuotes))

                                    window.location.href = url;
                            }
                            else {
                                toastr["error"]("", "¡La fecha de pago de la Primera Cuota, debe ser mayor a la fecha del Primer Pago!")
                            }
                    }
            }
    </script>
@endsection
