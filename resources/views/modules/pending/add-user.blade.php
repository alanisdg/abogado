@extends('layouts.app')

@section('title', "Agregar Usuario")

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Agregar Usuario</h4>
        </div>
        <div class="card-body">
            {!! Form::open(['route' => 'users.store', 'autocomplete' => 'off', 'id' => 'form', 'class' => 'form form-vertical', 'enctype' => 'multipart/form-data']) !!}
                <input type="hidden" value="{{ @$row->id }}" name="pending_id">
                <input type="hidden" value="5" name="rol">
                <input type="hidden" value="2" name="option">
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="first-name-icon">Nombre <span class="text-danger"><strong>*</strong></span></label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i data-feather='file-text'></i></span>
                                </div>
                                    {!! Form::text("first_name", old('first_name', @$row->names), ["class" => "form-control", "readonly", "onkeyup" => "upperCase(this);"]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="first-name-icon">Apellido <span class="text-danger"><strong>*</strong></span></label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i data-feather='file-text'></i></span>
                                </div>
                                    {!! Form::text("last_name", old('last_name', @$row->surnames), ["class" => "form-control", "readonly", "onkeyup" => "upperCase(this);"]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="first-name-icon">RUT <span class="text-danger"><strong>*</strong></span></label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i data-feather='file-text'></i></span>
                                </div>
                                    {!! Form::text("rut", old('rut', @$row->rut), ["class" => "form-control", "readonly", "id" => "rut"]) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="first-name-icon">Correo Electrónico <span class="text-danger"><strong>*</strong></span></label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i data-feather='mail'></i></span>
                                </div>
                                    {!! Form::email("email", old('email', @$row->email), ["class" => "form-control"]) !!}
                            </div>
                            @error('email')
                                <div class="text-danger">{{ ($message) }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="first-name-icon">Contraseña <span class="text-danger"><strong>*</strong></span></label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i data-feather='key'></i></span>
                                </div>
                                    <input type="password" class="form-control" name="password">
                            </div>
                            @error('password')
                                <div class="text-danger">{{ ($message) }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary mr-1 waves-effect waves-float waves-light" id="send"><i data-feather='save'></i> Registrar</button>

                        <a class="btn btn-danger waves-effect waves-float waves-light" href="{{ url("list-pending") }}" id="cancel"><i data-feather='corner-up-left'></i> Cancelar</a>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://unpkg.com/imask"></script>
    <script>
    </script>
@endsection
