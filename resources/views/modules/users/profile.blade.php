@extends('layouts.app')

@section('title',  "Mi Perfil")

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">{{ "Mi Perfil" }}</h4>
        </div>
        <div class="card-body">
            {!! Form::model($row, ['url' => 'user-profile-update', 'method' => 'put', 'autocomplete' => 'off', 'id' => 'form', 'class' => 'form form-vertical']) !!}
                <div class="row">
                    <div class="col-12 col-md-12">
                        <div class="form-group">
                            <label for="first-name-icon">RUT </label>
                            {!! Form::text("rut", old('rut', @$row->rut), ["class" => "form-control", "Placeholder" => "RUT", "required"]) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="first-name-icon">Nombre</label>
                            {!! Form::text("first_name", old('first_name', @$row->first_name), ["class" => "form-control", "Placeholder" => "Nombre", "id" => "name", "required", "onkeyup" => "upperCase(this);"]) !!}
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="first-name-icon">Apellido </label>
                            {!! Form::text("last_name", old('last_name', @$row->last_name), ["class" => "form-control", "Placeholder" => "Apellido", "required", "onkeyup" => "upperCase(this);"]) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="first-name-icon">Correco Electrónico </label>
                            {!! Form::email("email", old('email', @$row->email), ["class" => "form-control", "Placeholder" => "Correo Electrónico", "required", "id" => "email"]) !!}

                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="first-name-icon">{{ __('Password') }} </label>
                            <input type="password" class="form-control" name="password">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-warning mr-1 waves-effect waves-float waves-light" id="send">
                            <i data-feather='refresh-cw'></i>
                            Actualizar
                        </button>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://unpkg.com/imask"></script>
    <script>
        var phoneMask = IMask(
            document.getElementById('phone'), {
                mask: '+{00} (000) 000-00-00'
            }
        );
    </script>
@endsection
