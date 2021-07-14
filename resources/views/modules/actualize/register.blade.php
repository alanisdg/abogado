@extends('layouts.app')

@section('title', 'Registrar Actualización')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Registrar Actualización</h4>
        </div>
        <div class="card-body">
                {!! Form::open(['url' => 'contract/update', 'autocomplete' => 'off', 'id' => 'form', 'class' => 'form form-vertical', 'enctype' => 'multipart/form-data']) !!}
                    <input type="hidden" value="{{ @$row->id }}" name="contract_id">
                    <input type="hidden" value="{{ @$type }}" name="type">

                    <div class="divider">
                        <div class="divider-text"><h4>Tipo de Actualización</h4></div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-4">
                            <label class="form-label" for="customer">Fecha de Contrato</label>
                            {!! Form::text("contract_date", old('contract_date', @$row->contract_date), ["class" => "form-control", "id" => "customer", "onkeyup" => "upperCase(this);", "readonly"]) !!}
                        </div>
                        <div class="form-group col-md-4">
                            <label class="form-label" for="customer">Total del Contrato</label>
                            {!! Form::text("total_contract", old('total_contract', @$row->total_contract), ["class" => "form-control", "id" => "customer", "onkeyup" => "upperCase(this);", "readonly"]) !!}
                        </div>
                        <div class="form-group col-md-4">
                            <label class="form-label" for="customer">Tipo de Contrato</label>
                            {!! Form::text("type_contract", old('type_contract', @$row->type_contract), ["class" => "form-control", "id" => "customer", "onkeyup" => "upperCase(this);", "readonly"]) !!}
                        </div>
                    </div>
                    <div class="divider">
                        <div class="divider-text">
                            <h4>
                                @if ($type == 1)
                                    Cambio de Acreedor
                                @else

                                @endif
                            </h4>
                        </div>
                    </div>
                    @if ($type == 1)
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="form-label" for="customer">Acreedor Actual</label>
                                {!! Form::text("current_creditor", old('current_creditor', @$row->current_creditor), ["class" => "form-control", "onkeyup" => "upperCase(this);", "required", "autofocus"]) !!}
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label" for="customer">Nuevo Acreedor</label>
                                {!! Form::text("new_creditor", old('new_creditor', @$row->new_creditor), ["class" => "form-control", "onkeyup" => "upperCase(this);", "required"]) !!}
                            </div>
                        </div>
                    @else

                    @endif

                    <div class="row">
                        <div class="col-12">
                            <a class="btn btn-danger waves-effect waves-float waves-light" href="{{ url("list-contracts/list") }}" id="cancel"><i data-feather='corner-up-left'></i> Regresar</a>

                            <button class="btn btn-primary" type="submit"><i data-feather='refresh-ccw'></i> Actualizar</button>
                        </div>
                    </div>
                {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://unpkg.com/imask"></script>
    <script>
        // Rut
            var phoneMask = IMask(
                document.getElementById('rut'), {
                    mask: '000000000-0'
                }
            );
            var phoneMask = IMask(
                document.getElementById('phone'), {
                    mask: '(+56) 000-000-000'
            });
        // Clear localstorage
            document.addEventListener("DOMContentLoaded", function () {
                localStorage.removeItem('customer')
                localStorage.removeItem('cuotes')
                localStorage.removeItem('contract_parameters')
                localStorage.removeItem('current_customer')
            })
    </script>
@endsection
