@extends('layouts.app')

@section('title', 'Registro de Actualizaciones')

@section('content')
    <section id="basic-datatable">
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
    </section>
    <div class="card">
        <div class="card-body">
                {!! Form::open(['url' => 'contract/'.@$row->id.'/actualize/register', 'autocomplete' => 'off', 'id' => 'form', 'class' => 'form form-vertical', 'enctype' => 'multipart/form-data']) !!}
                    <input type="hidden" value="{{ @$row->id }}" name="contract_id">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label class="form-label" for="customer">Tipo de Actualización</label>
                            <select name="type" id="" class="form-control" required>
                                <option value="">Seleccione</option>
                                <option value="1">CAMBIO DE ACREEDOR</option>
                                <option value="2">CAMBIO DE ESTRATEGIA</option>
                                <option value="3">CAMBIO FECHA DE PAGO</option>
                                <option value="4">CAMBIO TITULAR CUENTA</option>
                                <option value="5">DAR DE BAJA ACREEDOR</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button class="btn btn-primary" type="submit"><i data-feather='send'></i> Enviar</button>
                        </div>
                    </div>
                {!! Form::close() !!}
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
    </script>
@endsection
