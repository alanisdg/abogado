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
                                        {!! Form::text("lawyer_first_name", old('lawyer_first_name', @$row->lawyer_first_name), ["class" => "form-control", "onkeyup" => "upperCase(this);"]) !!}
                                </div>
                                @error('lawyer_first_name')
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
                                        {!! Form::text("lawyer_last_name", old('lawyer_last_name', @$row->lawyer_last_name), ["class" => "form-control", "onkeyup" => "upperCase(this);"]) !!}
                                </div>
                                @error('lawyer_last_name')
                                    <div class="text-danger">{{ ($message) }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="first-name-icon">RUT <span class="text-danger"><strong>*</strong></span></label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i data-feather='file-text'></i></span>
                                    </div>
                                        {!! Form::text("lawyer_rut", old('lawyer_rut', @$row->lawyer_rut), ["class" => "form-control", "id" => "lawyer_rut"]) !!}
                                </div>
                                @error('lawyer_rut')
                                    <div class="text-danger">{{ ($message) }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="first-name-icon">Cargo <span class="text-danger"><strong>*</strong></span></label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i data-feather='file-text'></i></span>
                                    </div>
                                        {!! Form::text("charge", old('charge', @$row->charge), ["class" => "form-control", "id" => "charge", "onkeyup" => "upperCase(this);"]) !!}
                                </div>
                                @error('charge')
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
    <script src="https://unpkg.com/imask"></script>
    <script>
        // Phone
            var phoneMask = IMask(
                document.getElementById('lawyer_rut'), {
                    mask: '000000000-0'
                }
            );
    </script>
@endsection
