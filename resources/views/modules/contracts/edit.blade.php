@extends('layouts.app')

@section('title', 'Editar Contrato')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Editar Contrato</h4>
        </div>
        <div class="card-body">
                {!! Form::open(['url' => 'contract/update', 'autocomplete' => 'off', 'id' => 'form', 'class' => 'form form-vertical', 'enctype' => 'multipart/form-data']) !!}
                    <input type="hidden" value="{{ @$row->id }}" name="contract_id">

                    <div class="divider">
                        <div class="divider-text"><h4>Detalles del Contrato</h4></div>
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
                        <div class="divider-text"><h4>CLIENTE</h4></div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label class="form-label" for="customer">Nombres</label>
                            {!! Form::text("customer", old('customer', @$row->customer->customer), ["class" => "form-control", "id" => "customer", "onkeyup" => "upperCase(this);", "required"]) !!}
                        </div>
                        <div class="form-group col-md-4">
                            <label class="form-label" for="rut">RUT</label>
                            {!! Form::text("rut", old('rut', @$row->customer->rut), ["class" => "form-control", "id" => "rut", "onkeyup" => "upperCase(this);", "required"]) !!}
                        </div>
                        <div class="form-group col-md-4">
                            <label class="form-label" for="nationality">Nacionalidad</label>
                            {!! Form::text("nationality", old('nationality', @$row->customer->nationality), ["class" => "form-control", "id" => "nationality", "onkeyup" => "upperCase(this);", "required"]) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label class="form-label" for="customer">Estado Civil</label>
                            {!! Form::text("civil_status", old('civil_status', @$row->customer->civil_status), ["class" => "form-control", "id" => "customer", "onkeyup" => "upperCase(this);", "required"]) !!}
                        </div>
                        <div class="form-group col-md-4">
                            <label class="form-label" for="profession">Profesión</label>
                            {!! Form::text("profession", old('profession', @$row->customer->profession), ["class" => "form-control", "id" => "customer", "onkeyup" => "upperCase(this);", "required"]) !!}
                        </div>
                        <div class="form-group col-md-4">
                            <label class="form-label" for="email">Email</label>
                            {!! Form::text("email", old('email', @$row->customer->email), ["class" => "form-control", "id" => "customer", "onkeyup" => "upperCase(this);", "required"]) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label class="form-label" for="phone">Teléfono</label>
                            {!! Form::text("phone", old('phone', @$row->customer->phone), ["class" => "form-control", "id" => "phone", "onkeyup" => "upperCase(this);", "required"]) !!}
                        </div>
                        <div class="form-group col-md-4">
                            <label class="form-label" for="phone">Teléfono Casa</label>
                            {!! Form::text("home_phone", old('home_phone', @$row->customer->home_phone), ["class" => "form-control", "id" => "home_phone", "onkeyup" => "upperCase(this);", "required"]) !!}
                        </div>
                        <div class="form-group col-md-4">
                            <label class="form-label" for="commune">Comuna</label>
                            {!! Form::text("commune", old('commune', @$row->customer->commune), ["class" => "form-control", "id" => "customer", "onkeyup" => "upperCase(this);", "required"]) !!}
                        </div>

                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="form-label" for="region">Región</label>
                            {!! Form::text("region", old('region', @$row->customer->region), ["class" => "form-control", "id" => "customer", "onkeyup" => "upperCase(this);", "required"]) !!}
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="customer">Dirección</label>
                            {!! Form::text("address", old('address', @$row->customer->address), ["class" => "form-control", "id" => "customer", "onkeyup" => "upperCase(this);", "required"]) !!}
                        </div>
                    </div>
                    <div class="divider">
                        <div class="divider-text"><h4>CAUSA</h4></div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label class="form-label" for="number_rit">Número de RIT</label>
                            {!! Form::text("number_rit", old('number_rit', @$cause->number_rit), ["class" => "form-control", "name" => "number_rit", "id" => "number_rit", "readonly"]) !!}
                        </div>
                        <div class="form-group col-md-4">
                            <label class="form-label" for="court">Tribunal</label>
                            {!! Form::text("court", old('court', @$cause->court), ["class" => "form-control", "id" => "court", "name" => "court", "readonly"]) !!}
                        </div>
                        <div class="form-group col-md-4">
                            <label class="form-label" for="nationality">Materia</label>
                            {!! Form::text("matter", old('matter', @$cause->matter), ["class" => "form-control", "id" => "matter", "name" => "matter", "readonly"]) !!}
                        </div>
                    </div>

                    <div class="row mt-3">
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
            var phoneMask = IMask(
                document.getElementById('home_phone'), {
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
