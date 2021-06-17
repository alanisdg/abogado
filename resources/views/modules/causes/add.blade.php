@extends('layouts.app')

@section('title', 'Registro de Causa')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Registro de Causa</h4>
        </div>
        <div class="card-body">
                {!! Form::open(['url' => '', 'autocomplete' => 'off', 'id' => 'form', 'class' => 'form form-vertical', 'enctype' => 'multipart/form-data']) !!}

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="form-label" for="date">Fecha</label>
                            <input type="text" name="date" id="contract_date" class="form-control" value="{{ date("Y-m-d") }}" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="first-name-icon">Total del Contrato </label>
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
                            <label class="form-label" for="number_rit">Número de RIT</label>
                            <input type="text" name="number_rit" id="number_rit" class="form-control" onkeyup = "upperCase(this);">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="first_payment_date">Fecha del Primer Pago</label>
                            <input type="date" name="first_payment_date" id="first_payment_date" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="form-label" for="cours">Tribunal</label>
                            <input type="text" name="cours" id="cours" class="form-control" onkeyup = "upperCase(this);">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="first_payment_amount">Monto Primer Pago</label>
                            <input type="text" name="first_payment_amount" id="first_payment_amount" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="form-label" for="matter">Materia</label>
                            <input type="text" name="matter" id="matter" class="form-control" onkeyup = "upperCase(this);">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="amount_installments">Cantidad de Cuotas</label>
                            <input type="number" name="amount_installments" id="amount_installments" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">

                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="amount_fees">Monto de Cuotas</label>
                            <input type="text" name="amount_fees" id="amount_fees" class="form-control" readonly onclick="calculateCuotes()" onfocus="calculateCuotes()">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <a class="btn btn-danger waves-effect waves-float waves-light" href="{{ url("causes/list") }}" id="cancel"><i data-feather='corner-up-left'></i> Regresar</a>
                        </div>
                    </div>
                {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('scripts')
    <script>

    </script>
@endsection
