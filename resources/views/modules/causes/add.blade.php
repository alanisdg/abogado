@extends('layouts.app')

@if ($typeForm == 'create')
    @section('title', 'Registro de Causa')
@else
    @section('title', 'Editar Causa')
@endif

@section('content')
    <div class="card">
        <div class="card-header">
            @if ($typeForm == 'create')
                <h4 class="card-title">Registro de Causa</h4>
            @else
                <h4 class="card-title">Editar Causa</h4>
            @endif
        </div>
        <div class="card-body">
            @if ($typeForm == 'create')
                {!! Form::open(['url' => 'causes/contracts/record-causes/add-cause/store', 'method' => 'post', 'autocomplete' => 'off', 'id' => 'form', 'class' => 'form form-vertical']) !!}
            @else
                {!! Form::open(['url' => 'causes/contracts/record-causes/add-cause/update', 'method' => 'post', 'autocomplete' => 'off', 'id' => 'form', 'class' => 'form form-vertical']) !!}

                <input type="hidden" value="{{ $row->id }}" name="cause_id" readonly>
            @endif
                <div class="row">
                    <div class="form-group col-md-12">
                        <label class="form-label" for="number_rit">Número de RIT</label>
                        {!! Form::text("number_rit", old('number_rit', @$row->number_rit), ["class" => "form-control", "required", "autofocus", "onkeyup" => "upperCase(this);"]) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12">
                        <label class="form-label" for="cours">Tribunal</label>
                        {!! Form::text("cours", old('cours', @$row->court), ["class" => "form-control", "required", "onkeyup" => "upperCase(this);"]) !!}

                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12">
                        <label class="form-label" for="matter">Materia</label>
                        {!! Form::text("matter", old('matter', @$row->matter), ["class" => "form-control", "required", "onkeyup" => "upperCase(this);"]) !!}
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <a class="btn btn-danger waves-effect waves-float waves-light" href="{{ url("causes/contracts/record-causes/".@$row->contract_id) }}" id="cancel"><i data-feather='corner-up-left'></i> Regresar</a>
                        @if ($typeForm == 'create')
                            <button type="submit" class="btn btn-primary waves-effect waves-float waves-light"><i data-feather='save'></i> Registrar</button>
                        @else
                            <button type="submit" class="btn btn-primary waves-effect waves-float waves-light"><i data-feather='refresh-ccw'></i> Actualizar</button>
                        @endif
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
