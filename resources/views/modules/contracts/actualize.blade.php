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
                            <strong>Cliente: </strong>{{ $row->customer->customer }} || {{ $row->type_contract }}
                        </span>
                    </div>
                    <div class="dt-buttons btn-group flex-wrap">
                        <a href="{{ url('list-contracts/list') }}" class="btn btn-danger mt-50"> Regresar</a>
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
                                        @else

                                        @endif
                                    </td>
                                    <td>{{ date("d-m-Y", strtotime($item->created_at)) }}</td>
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
                                            <option value="5">DAR DE BAJA ACREEDOR</option>
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
                </div>
            </div>
        </div>
    </div>
@endsection

@section("scripts")
    <script>
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
                    else {

                    }
            }

        // Change of creditor
            function changeCreditor() {
                document.getElementById("change_creditor").style.display = "block"
                document.getElementById("change_strategy").style.display = "none"
            }

        // Change of strategy
            function changeStrategy() {
                document.getElementById("change_strategy").style.display = "block"
                document.getElementById("change_creditor").style.display = "none"
            }
    </script>
@endsection
