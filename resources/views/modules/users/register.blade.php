@extends('layouts.app')

@if ($typeForm == 'create')
    @section('title', $config['add'])
@else
    @section('title', $config['edit'])
@endif


@section('content')
    <div class="card">
        <div class="card-header">
            @if ($typeForm == 'create')
                <h4 class="card-title">{{ $config['add'] }}</h4>
            @else
                <h4 class="card-title">{{ $config['edit'] }}</h4>
            @endif
        </div>
        <div class="card-body">
            @if ($typeForm == 'create')
                {!! Form::open(['route' => $config['routeLink'].'.store', 'autocomplete' => 'off', 'id' => 'form', 'class' => 'form form-vertical', 'enctype' => 'multipart/form-data']) !!}
            @else
                {!! Form::model($row, ['route' => [$config['routeLink'].'.update', $row->id], 'method' => 'patch', 'autocomplete' => 'off', 'id' => 'form', 'class' => 'form form-vertical', 'enctype' => 'multipart/form-data']) !!}
            @endif
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="first-name-icon">Nombre <span class="text-danger"><strong>*</strong></span></label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i data-feather='file-text'></i></span>
                                    </div>
                                        {!! Form::text("first_name", old('first_name', @$row->first_name), ["class" => "form-control", "onkeyup" => "upperCase(this);"]) !!}
                                </div>
                                @error('first_name')
                                    <div class="text-danger">{{ ($message) }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="first-name-icon">Apellido <span class="text-danger"><strong>*</strong></span></label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i data-feather='file-text'></i></span>
                                    </div>
                                        {!! Form::text("last_name", old('last_name', @$row->last_name), ["class" => "form-control", "onkeyup" => "upperCase(this);"]) !!}
                                </div>
                                @error('last_name')
                                    <div class="text-danger">{{ ($message) }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="first-name-icon">RUT <span class="text-danger"><strong>*</strong></span></label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i data-feather='file-text'></i></span>
                                    </div>
                                        {!! Form::text("rut", old('rut', @$row->rut), ["class" => "form-control", "id" => "rut"]) !!}
                                </div>
                                @error('rut')
                                    <div class="text-danger">{{ ($message) }}</div>
                                @enderror
                            </div>
                        </div>
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
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="first-name-icon">Rol <span class="text-danger"><strong>*</strong></span></label>
                                <select name="rol" class="form-control">
                                    <option value="">Seleccione...</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}" @if(old('rol') == $role->id OR @$role->id == @$rolId) selected @endif >
                                            {{ $role->description }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('rol')
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
                                        <input type="text" class="form-control" name="password">
                                </div>
                                @error('password')
                                    <div class="text-danger">{{ ($message) }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            @if ($typeForm == 'create')
                                <button type="submit" class="btn btn-primary mr-1 waves-effect waves-float waves-light" id="send"><i data-feather='save'></i> Registrar</button>
                            @else
                                <button type="submit" class="btn btn-warning mr-1 waves-effect waves-float waves-light" id="send"><i data-feather='refresh-cw'></i> Actualizar</button>
                            @endif
                            <a class="btn btn-danger waves-effect waves-float waves-light" href="{{ url($config["routeLink"]) }}" id="cancel"><i data-feather='corner-up-left'></i> Regresar</a>
                        </div>
                    </div>
                {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('scripts')

@endsection
