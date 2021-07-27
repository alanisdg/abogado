@extends('layouts.app')

@section('title', 'Detalles de Pendiente')

@section('content')
    <div class="row">
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h4 class="card-title text-white">Datos generales</h4>
                </div>
                <div class="card-body">
                    <div class="row mt-2">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="first-name-icon">Fecha Entrevista </label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i data-feather='file-text'></i></span>
                                    </div>
                                    {!! Form::text("interview_date", old('interview_date', @$row->interview_date), ["class" => "form-control", "readonly"]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="first-name-icon">Fecha Segunda Cita </label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i data-feather='file-text'></i></span>
                                    </div>
                                    {!! Form::text("second_date", old('second_date', @$row->second_date), ["class" => "form-control", "readonly"]) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="first-name-icon">Nombre </label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i data-feather='file-text'></i></span>
                                    </div>
                                    {!! Form::text("names", old('names', @$row->names), ["class" => "form-control", "readonly"]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="first-name-icon">Apellidos </label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i data-feather='file-text'></i></span>
                                    </div>
                                    {!! Form::text("surnames", old('surnames', @$row->surnames), ["class" => "form-control", "readonly"]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="first-name-icon">RUT </label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i data-feather='file-text'></i></span>
                                    </div>
                                    {!! Form::text("rut", old('rut', @$row->rut), ["class" => "form-control", "readonly"]) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="first-name-icon">RUT </label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i data-feather='file-text'></i></span>
                                    </div>
                                        {!! Form::text("rut", old('rut', @$row->rut), ["class" => "form-control", "readonly"]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="first-name-icon">Correo Electrónico </label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i data-feather='mail'></i></span>
                                    </div>
                                        {!! Form::email("email", old('email', @$row->email), ["class" => "form-control", "readonly"]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="first-name-icon">Teléfono </label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i data-feather='phone'></i></span>
                                    </div>
                                        {!! Form::email("phone", old('phone', @$row->phone), ["class" => "form-control", "readonly"]) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6 col-m-6">
            <div class="card">
                <div class="card-header bg-primary">
                    <h4 class="card-title text-white">Acreedores</h4>
                </div>
                <div class="card-body">
                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="first-name-icon">Acreedor 1 </label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i data-feather='file-text'></i></span>
                                    </div>
                                        {!! Form::text("creditor_1", old('creditor_1', @$row->creditor_1), ["class" => "form-control", "readonly"]) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="first-name-icon">Acreedor 2 </label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i data-feather='file-text'></i></span>
                                    </div>
                                        {!! Form::text("creditor_2", old('creditor_2', @$row->creditor_2), ["class" => "form-control", "readonly"]) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-m-6">
            <div class="card">
                <div class="card-header bg-primary">
                    <h4 class="card-title text-white">Montos</h4>
                </div>
                <div class="card-body">
                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="first-name-icon">Saldo DD </label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i data-feather='file-text'></i></span>
                                    </div>
                                        {!! Form::text("balance_dd", old('balance_dd', @$row->balance_dd), ["class" => "form-control", "readonly"]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="first-name-icon">Acreedor 1 </label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i data-feather='file-text'></i></span>
                                    </div>
                                        {!! Form::text("creditor_1", old('creditor_1', @$row->creditor_1), ["class" => "form-control", "readonly"]) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="first-name-icon">Acreedor 2 </label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i data-feather='file-text'></i></span>
                                    </div>
                                        {!! Form::text("creditor_2", old('creditor_2', @$row->creditor_2), ["class" => "form-control", "readonly"]) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header bg-primary">
            <h4 class="card-title text-white">Demandas</h4>
        </div>
        <div class="card-body">
            <div class="row mt-2">
                <div class="col-6">
                    <div class="form-group">
                        <label for="first-name-icon">Patrimonio </label>
                        <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i data-feather='file-text'></i></span>
                            </div>
                                {!! Form::text("heritage", old('heritage', @$row->heritage), ["class" => "form-control", "readonly"]) !!}
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="first-name-icon">Demandas Activas </label>
                        <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i data-feather='file-text'></i></span>
                            </div>
                                {!! Form::text("active_demand", old('active_demand', @$row->active_demand), ["class" => "form-control", "readonly"]) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="first-name-icon">Demanda 1 </label>
                        <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i data-feather='file-text'></i></span>
                            </div>
                                {!! Form::text("demand_1", old('demand_1', @$row->demand_1), ["class" => "form-control", "readonly"]) !!}
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="first-name-icon">Estado 1 </label>
                        <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i data-feather='file-text'></i></span>
                            </div>
                                {!! Form::text("state_1", old('state_1', @$row->state_1), ["class" => "form-control", "readonly"]) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="first-name-icon">Demanda 2 </label>
                        <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i data-feather='file-text'></i></span>
                            </div>
                                {!! Form::text("demand_2", old('demand_2', @$row->demand_2), ["class" => "form-control", "readonly"]) !!}
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="first-name-icon">Estado 2 </label>
                        <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i data-feather='file-text'></i></span>
                            </div>
                                {!! Form::text("state_2", old('state_2', @$row->state_2), ["class" => "form-control", "readonly"]) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <a class="btn btn-danger waves-effect waves-float waves-light" href="{{ url("list-pending") }}" id="cancel"><i data-feather='x-circle'></i> Regresar</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>

    </script>
@endsection
