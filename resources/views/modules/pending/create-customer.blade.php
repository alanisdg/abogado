@extends('layouts.app')

@section('title', "Crear Cliente")

@section('content')
    <div class="card">
        <div class="card-header bg-primary">
            <h4 class="card-title text-white">Crear Cliente</h4>
        </div>

        {!! Form::open(['url' => 'customers/create/store', 'autocomplete' => 'off', 'id' => 'form', 'class' => 'form form-vertical', 'enctype' => 'multipart/form-data']) !!}
            <div class="card-body">
                <div class="row mt-2">
                    <div class="form-group col-md-3">
                        <label class="form-label" for="customer">Nombre <span class="text-danger">*</span></label>
                        {!! Form::text("name", old('name', null), ["class" => "form-control", "id" => "name", "onkeyup" => "upperCase(this);", "autofocus", "required"]) !!}
                    </div>
                    <div class="form-group col-md-3">
                        <label class="form-label" for="customer">Apellido <span class="text-danger">*</span></label>
                        {!! Form::text("last_name", old('last_name', null), ["class" => "form-control", "id" => "last_name", "onkeyup" => "upperCase(this);", "autofocus", "required"]) !!}
                    </div>
                    <div class="form-group col-md-3">
                        <label class="form-label" for="rut">RUT <span class="text-danger">*</span></label>
                        {!! Form::text("rut", old('rut', @$contract->customer->rut), ["class" => "form-control", "id" => "rut", "required"]) !!}
                    </div>
                    <div class="form-group col-md-3">
                        <label class="form-label" for="nationality">Nacionalidad <span class="text-danger">*</span></label>
                        {!! Form::text("nationality", old('nationality', @$contract->customer->nationality), ["class" => "form-control", "id" => "nationality", "onkeyup" => "upperCase(this);", "required"]) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label class="form-label" for="phone">Teléfono Celular <span class="text-danger">*</span></label>
                        {!! Form::text("phone", old('phone', @$contract->customer->phone), ["class" => "form-control", "id" => "phone", "required"]) !!}
                    </div>
                    <div class="form-group col-md-4">
                        <label class="form-label" for="home_phone">Teléfono Casa</label>
                        {!! Form::text("home_phone", old('home_phone', @$contract->customer->home_phone), ["class" => "form-control", "id" => "home_phone"]) !!}
                    </div>
                    <div class="form-group col-md-4">
                        <label class="form-label" for="email">Email <span class="text-danger">*</span></label>
                        {!! Form::text("email", old('email', @$contract->customer->email), ["class" => "form-control", "id" => "email", "required"]) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="form-label" for="customer">Estado Civil <span class="text-danger">*</span></label>
                        {!! Form::text("civil_status", old('civil_status', @$contract->customer->civil_status), ["class" => "form-control", "id" => "civil_status", "onkeyup" => "upperCase(this);", "required"]) !!}
                    </div>
                    <div class="form-group col-md-6">
                        <label class="form-label" for="profession">Profesión <span class="text-danger">*</span></label>
                        {!! Form::text("profession", old('profession', @$contract->customer->profession), ["class" => "form-control", "id" => "profession", "onkeyup" => "upperCase(this);", "required"]) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label class="form-label" for="region">Región <span class="text-danger">*</span></label>
                        {!! Form::text("region", old('region', @$contract->customer->region), ["class" => "form-control", "id" => "region", "onkeyup" => "upperCase(this);", "required"]) !!}
                    </div>
                    <div class="form-group col-md-4">
                        <label class="form-label" for="commune">Comuna <span class="text-danger">*</span></label>
                        {!! Form::text("commune", old('commune', @$contract->customer->commune), ["class" => "form-control", "id" => "commune", "onkeyup" => "upperCase(this);", "required"]) !!}
                    </div>
                    <div class="form-group col-md-4">
                        <label class="form-label" for="address">Dirección  <span class="text-danger">*</span></label>
                        {!! Form::text("address", old('address', @$contract->customer->address), ["class" => "form-control", "id" => "address", "onkeyup" => "upperCase(this);", "required"]) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12">
                        <label class="form-label" for="observations">Observaciones</label>
                        {!! Form::textarea("observations", old('observations', @$contract->customer->observations), ["class" => "form-control", "id" => "observations", "onkeyup" => "upperCase(this);", "size" => "10x15"]) !!}
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary waves-effect waves-float waves-light"><i data-feather='save'></i> Registrar</button>
                    </div>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
@endsection

@section('scripts')
    <script src="https://unpkg.com/imask"></script>
    <script>
        var phoneMask = IMask(
            document.getElementById('phone'), {
                mask: '+56 9 0000 0000'
            }
        );

        var phoneMask = IMask(
            document.getElementById('home_phone'), {
                mask: '+56 9 0000 0000'
            }
        );
    </script>
@endsection
