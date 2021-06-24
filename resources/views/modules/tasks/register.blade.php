@extends('layouts.app')

@if ($typeForm == 'create')
    @section('title', 'Registrar Tarea')
@else
    @section('title', 'Editar Tarea')
@endif

@section('content')
    <div class="card">
        <div class="card-header">
            @if ($typeForm == 'create')
                <h4 class="card-title">Registrar Tarea</h4>
            @else
                <h4 class="card-title">Editar Tarea</h4>
            @endif
        </div>
        <div class="card-body">
            @if ($typeForm == 'create')
                {!! Form::open(['url' => 'causes/tasks/add/store', 'method' => 'post', 'autocomplete' => 'off', 'id' => 'form', 'class' => 'form form-vertical']) !!}

                <input type="hidden" name="cause_id" value="{{ $cause }}" readonly>
            @else
                {!! Form::open(['url' => 'causes/tasks/edit/update', 'method' => 'post', 'autocomplete' => 'off', 'id' => 'form', 'class' => 'form form-vertical']) !!}

                <input type="hidden" value="{{ $row->id }}" name="task_id" readonly>
            @endif
                <div class="row">
                    <div class="form-group col-md-12">
                        <label class="form-label" for="description">Descripción</label>
                        {!! Form::text("description", old('description', @$row->description), ["class" => "form-control", "required", "autofocus", "onkeyup" => "upperCase(this);"]) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12">
                        <label class="form-label" for="responsible">Responsable</label>
                        {!! Form::text("responsible", old('responsible', @$row->responsible), ["class" => "form-control", "required", "onkeyup" => "upperCase(this);"]) !!}

                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12">
                        <label class="form-label" for="deadline">Fecha Límite</label>
                        {!! Form::date("deadline", old('deadline', @$row->deadline), ["class" => "form-control", "required"]) !!}
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        @if ($typeForm == 'create')
                            <a class="btn btn-danger waves-effect waves-float waves-light" href="{{ url("causes/".$cause."/tasks") }}" id="cancel"><i data-feather='corner-up-left'></i> Regresar</a>

                            <button type="submit" class="btn btn-primary waves-effect waves-float waves-light"><i data-feather='save'></i> Registrar</button>
                        @else
                            <a class="btn btn-danger waves-effect waves-float waves-light" href="{{ url("causes/".$row->cause_id."/tasks") }}" id="cancel"><i data-feather='corner-up-left'></i> Regresar</a>

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
