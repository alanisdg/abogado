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
                {!! Form::open(['url' => 'creditors/store', 'autocomplete' => 'off', 'id' => 'form', 'class' => 'form form-vertical']) !!}

                <input type="hidden" value="{{ $contract }}" name="contract_id">
            @else
                {!! Form::open(['url' => ['creditors/update'], 'method' => 'post', 'autocomplete' => 'off', 'id' => 'form', 'class' => 'form form-vertical']) !!}

                <input type="hidden" value="{{ @$row->id }}" name="creditor_id">
            @endif
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="first-name-icon">Nombre <span class="text-danger"><strong>*</strong></span></label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i data-feather='file-text'></i></span>
                                    </div>
                                        {!! Form::text("name", old('name', @$row->name), ["class" => "form-control", "autofocus", "onkeyup" => "upperCase(this);", "required"]) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="first-name-icon">Monto <span class="text-danger"><strong>*</strong></span></label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                        {!! Form::text("creditor_amount", old('creditor_amount', @$row->creditor_amount), ["class" => "form-control", "id" => "creditor_amount", "required"]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="first-name-icon">Fecha de Registro <span class="text-danger"><strong>*</strong></span></label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i data-feather='calendar'></i></span>
                                    </div>
                                        {!! Form::date("registration_date", old('registration_date', @$row->registration_date), ["class" => "form-control", "required"]) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                    </div>
                    <div class="row">
                        <div class="col-12">
                            @if ($typeForm == 'create')
                                <button type="submit" class="btn btn-primary mr-1 waves-effect waves-float waves-light" id="send"><i data-feather='save'></i> Registrar</button>

                                <a class="btn btn-danger waves-effect waves-float waves-light" href="{{ url($config["routeLink"].'/'.$contract) }}" id="cancel"><i data-feather='corner-up-left'></i> Regresar</a>
                            @else
                                <button type="submit" class="btn btn-warning mr-1 waves-effect waves-float waves-light" id="send"><i data-feather='refresh-cw'></i> Actualizar</button>

                                <a class="btn btn-danger waves-effect waves-float waves-light" href="{{ url($config["routeLink"].'/'.$row->contract_id) }}" id="cancel"><i data-feather='corner-up-left'></i> Regresar</a>
                            @endif
                        </div>
                    </div>
                {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Creditor amount
            $("#creditor_amount").on({
                "focus": function(event) {
                    $(event.target).select();
                },
                "keyup": function(event) {
                    $(event.target).val(function(index, value) {
                    return value.replace(/\D/g, "")
                        .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
                    });
                }
            });
    </script>
@endsection
