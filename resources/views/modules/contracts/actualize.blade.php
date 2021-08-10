@extends('layouts.app')

@section('title', 'Registro de Actualizaciones')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card table-responsive" style="padding: 15px;">
                <div class="card-header border-bottom p-1">
                    <div class="head-label">
                        <h3 class="mb-0">Registro de Actualizaciones</h3><br>
                        <span class="mt-3">
                            <strong>Cliente: </strong>{{ $row->customer->customer }} || {{ $row->type_contract }} || <strong>Total del Contrato: </strong> ${{ number_format($contractAmount, 0, '', '.') }}
                        </span>
                    </div>
                    <div class="dt-buttons btn-group flex-wrap">
                        <a href="{{ (!is_null($row->number_contract) ? url('list-contracts/annexes/'.$row->number_contract) : url('list-contracts/list')) }}" class="btn btn-danger mt-50"> Regresar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row" id="basic-table">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Historico de Actualizaciones</h4>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>TIPO</th>
                                <th>FECHA</th>
                                <th>OBSERVACIONES</th>
                                <th>opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($row->updates as $item)
                                <tr>
                                    <td>
                                        @if ($item->type == 1)
                                            CAMBIO DE ACREEDOR
                                        @elseif ($item->type == 2)
                                            CAMBIO DE ESTRATEGIA
                                        @elseif ($item->type == 3)
                                            CAMBIO FECHA DE PAGO
                                        @elseif ($item->type == 4)
                                            CAMBIO TITULAR DE CUENTA
                                        @else
                                            FALLECIDO
                                        @endif
                                    </td>
                                    <td>{{ date("d-m-Y", strtotime($item->created_at)) }}</td>
                                    <td>{{ $item->observations }}</td>
                                    <td>
                                        <a href="{{ url('contract/update/print/document/'.$item->id.'/'.$item->type) }}"><img width="25" src="{{ asset("backend/images/assets/print.svg") }}" alt="Imprimir Documento"></a>
                                    </td>
                                </tr>
                            @empty

                            @endforelse
                        </tbody>
                    </table>
                </div>
          </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card table-responsive">
                <div class="card-body">
                    {!! Form::open(['url' => '#', 'autocomplete' => 'off', 'id' => 'form', 'class' => 'form form-vertical']) !!}
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-1 row">
                                    <div class="col-sm-2" style="padding-right: 0;">
                                        <label class="col-form-label" for="first-name">Tipo de Actualización</label>
                                    </div>
                                    <div class="col-sm-6" style="padding-left: 0;">
                                        <select name="type" id="type_update" class="form-control" required>
                                            <option value="">Seleccione</option>
                                            <option value="1">CAMBIO DE ACREEDOR</option>
                                            <option value="2">CAMBIO DE ESTRATEGIA</option>
                                            <option value="3">CAMBIO FECHA DE PAGO</option>
                                            <option value="4">CAMBIO TITULAR CUENTA</option>
                                            <option value="5">FALLECIDO</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-2">
                                        <button class="btn btn-primary" type="button" onclick="typeUpdate();"><i data-feather='search'></i> Consultar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 id="option_title"></h3>
                </div>
                <div class="card-body">
                    <div id="change_creditor" style="display: none">
                        @include('modules.actualize.change-creditor')
                    </div>
                    <div id="change_strategy" style="display: none">
                        @include('modules.actualize.change-strategy')
                    </div>
                    <div id="change_payment_date" style="display: none">
                        @include('modules.actualize.change-payment-date')
                    </div>
                    <div id="account_holder_change" style="display: none">
                        @include('modules.actualize.account-holder-change')
                    </div>
                    <div id="deseaced_customer" style="display: none">
                        @include('modules.actualize.deseaced-customer')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("scripts")
    <script src="https://unpkg.com/imask"></script>
    <script>
        // Rut
            var phoneMask = IMask(
                document.getElementById('rut'), {
                    mask: '000000000-0'
                }
            );

            var phoneMask = IMask(
                document.getElementById('deceased_rut'), {
                    mask: '000000000-0'
                }
            );

        // Phone
            var phoneMask = IMask(
                document.getElementById('phone'), {
                    mask: '(+56)000-000-000'
                }
            );

            var phoneMask = IMask(
                document.getElementById('home_phone'), {
                    mask: '(+56)000-000-000'
                }
            );

            var phoneMask = IMask(
                document.getElementById('deceased_phone'), {
                    mask: '(+56)000-000-000'
                }
            );

            var phoneMask = IMask(
                document.getElementById('deceased_home_phone'), {
                    mask: '(+56)000-000-000'
                }
            );

        // Creditor Amount contract
            $("#creditor_contract_amount").on({
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

            $("#creditor_amount_1").on({
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

        // Amount contract
            $("#strategy_contract_amount").on({
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

        // Amount contract
            $("#deceased_new_payment_amount").on({
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

        // Amount contract
            $("#deceased_new_payment_amount").on({
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

        // Amount contract
            $("#payment_date_amount").on({
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

        // Amount contract
            $("#contract_amount_holder").on({
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

        // Creditor calculate cuotes
            function creditorCalculateCuotes()
            {
                // Varibales
                    let total_contract = document.getElementById('creditor_contract_amount').value,
                        amount_installments = document.getElementById('creditor_number_installments').value

                // Calculate
                    let totalContract = total_contract.replace('.', ''),
                        totalCost = parseFloat(totalContract.replace('.', '')) / amount_installments,
                        total = Math.floor(totalCost)

                // Assignate
                    document.getElementById('creditor_amount_fees').value = total.toLocaleString("de-DE", {minimumFractionDigits: 0})

            }

        // Calculate cuotes
            function calculateCuotes()
            {
                // Varibales
                    let total_contract = document.getElementById('strategy_contract_amount').value,
                        amount_installments = document.getElementById('number_strategy_installments').value

                // Calculate
                    total_contract = Number(total_contract.replace(/[^0-9\.]+/g,""))
                    totalCost = parseFloat(total_contract) / amount_installments

                // Assignate
                    document.getElementById('amount_strategy_fees').value = String(totalCost).replace(/(.)(?=(\d{3})+$)/g,'$1,')

            }

        // Deceased calculate cuotes
            function deceasedCalculateCuotes()
            {
                // Varibales
                    let total_contract = document.getElementById('deceased_new_payment_amount').value,
                        amount_installments = document.getElementById('deceased_amount_fees').value

                // Calculate
                    total_contract = Number(total_contract.replace(/[^0-9\.]+/g,""))
                    totalCost = parseFloat(total_contract) / amount_installments

                // Assignate
                    document.getElementById('deceased_quota_amount').value = String(totalCost).replace(/(.)(?=(\d{3})+$)/g,'$1,')

            }

        // Deceased calculate cuotes
            function holderCalculateCuotes()
            {
                // Varibales
                    let total_contract = document.getElementById('contract_amount_holder').value,
                        amount_installments = document.getElementById('number_fees_holder').value

                // Calculate
                    total_contract = Number(total_contract.replace(/[^0-9\.]+/g,""))
                    totalCost = parseFloat(total_contract) / amount_installments

                // Assignate
                    document.getElementById('amount_fees_holder').value = String(totalCost).replace(/(.)(?=(\d{3})+$)/g,'$1,')

            }

        // Change payment calculate cuotes
            function paymentDateCalculateCuotes()
            {
                // Varibales
                    let total_contract = document.getElementById('payment_date_amount').value,
                        amount_installments = document.getElementById('payment_date_amount_fees').value

                // Calculate
                    total_contract = Number(total_contract.replace(/[^0-9\.]+/g,""))
                    totalCost = parseFloat(total_contract) / amount_installments

                // Assignate
                    document.getElementById('payment_date_quota_amount').value = String(totalCost).replace(/(.)(?=(\d{3})+$)/g,'$1,')

            }

        // Clear localstorage
            document.addEventListener("DOMContentLoaded", function () {
                localStorage.removeItem('customer')
                localStorage.removeItem('cuotes')
                localStorage.removeItem('contract_parameters')
                localStorage.removeItem('current_customer')
            })

        // Select type of update
            function typeUpdate()
            {
                // Select opion
                    let optionId = document.getElementById('type_update').value


                // Select option
                    if (optionId == 1) { // Change creditor
                        return changeCreditor()
                    }
                    else if(optionId == 2) { // Change strategy
                        return changeStrategy()
                    }
                    else if(optionId == 3) { // Change payment date
                        return changePaymentDate()
                    }
                    else if(optionId == 4) { // Account holder change
                        return accountHolderChange()
                    }
                    else if(optionId == 5) { // Deceased customer
                        return deseacedCustomer()
                    }
                    else {
                        return optionDefault()
                    }
            }

        // Change of creditor
            function changeCreditor() {
                document.getElementById("change_creditor").style.display = "block"
                document.getElementById("change_payment_date").style.display = "none"
                document.getElementById("change_strategy").style.display = "none"
                document.getElementById("account_holder_change").style.display = "none"
                document.getElementById("deseaced_customer").style.display = "none"
            }

        // Change of strategy
            function changeStrategy() {
                document.getElementById("change_strategy").style.display = "block"
                document.getElementById("change_creditor").style.display = "none"
                document.getElementById("change_payment_date").style.display = "none"
                document.getElementById("account_holder_change").style.display = "none"
                document.getElementById("deseaced_customer").style.display = "none"
            }

        // Account change payment date
            function changePaymentDate() {
                document.getElementById("change_payment_date").style.display = "block"
                document.getElementById("account_holder_change").style.display = "none"
                document.getElementById("change_strategy").style.display = "none"
                document.getElementById("change_creditor").style.display = "none"
                document.getElementById("deseaced_customer").style.display = "none"
            }

        // Account holder change
            function accountHolderChange() {
                document.getElementById("account_holder_change").style.display = "block"
                document.getElementById("change_strategy").style.display = "none"
                document.getElementById("change_payment_date").style.display = "none"
                document.getElementById("change_creditor").style.display = "none"
                document.getElementById("deseaced_customer").style.display = "none"
            }

        // Deceased customer
            function deseacedCustomer() {
                document.getElementById("deseaced_customer").style.display = "block"
                document.getElementById("account_holder_change").style.display = "none"
                document.getElementById("change_strategy").style.display = "none"
                document.getElementById("change_payment_date").style.display = "none"
                document.getElementById("change_creditor").style.display = "none"
            }

        // Default
            function optionDefault() {
                document.getElementById("deseaced_customer").style.display = "none"
                document.getElementById("account_holder_change").style.display = "none"
                document.getElementById("change_strategy").style.display = "none"
                document.getElementById("change_payment_date").style.display = "none"
                document.getElementById("change_creditor").style.display = "none"
            }

    </script>
@endsection
