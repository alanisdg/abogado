@extends('layouts.app')

@section('title', "Pago de Cuota")

@section('content')
    <div class="card">
        <div class="card-header bg-primary">
            <h4 class="card-title text-white">Pago de Cuota</h4>
        </div>
        <div class="card-body mt-2">
                {!! Form::open(['url' => 'list-fess/create/transaction', 'autocomplete' => 'off', 'id' => 'form', 'class' => 'form form-vertical']) !!}

                    <input type="hidden" name="contract" value="{{ @$row->contract_id }}">

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="first-name-icon">N° de Cuota <span class="text-danger"><strong>*</strong></span></label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">#</span>
                                    </div>
                                        {!! Form::text("installment_number", old('installment_number', @$row->installment_number), ["class" => "form-control", "onkeyup" => "upperCase(this);", "readonly"]) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="first-name-icon">Fecha de Pago <span class="text-danger"><strong>*</strong></span></label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i data-feather='calendar'></i></span>
                                    </div>
                                        {!! Form::text("payment_date", old('payment_date', date("d-m-Y", strtotime(@$row->payment_date))), ["class" => "form-control", "id" => "payment_date", "readonly"]) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="first-name-icon">Monto <span class="text-danger"><strong>*</strong></span></label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                        {!! Form::text("amount", old('amount', str_replace('.','', @$row->amount)), ["class" => "form-control", "id" => "amount", "readonly"]) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="first-name-icon">Estado <span class="text-danger"><strong>*</strong></span></label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i data-feather='alert-circle'></i></span>
                                    </div>
                                        {!! Form::text("status", old('status', @$row->status), ["class" => "form-control", "id" => "status", "readonly"]) !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                {{--<label for="first-name-icon">Referencia <span class="text-danger"><strong>*</strong></span></label>--}}
                                {!! Form::hidden("buy_order", old('buy_order', @$data["reference"]), ["class" => "form-control", "id" => "buy_order", "readonly"]) !!}
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                {{--<label for="first-name-icon">Sesión <span class="text-danger"><strong>*</strong></span></label>--}}
                                {!! Form::hidden("session_id", old('session_id', @$data["sessionId"]), ["class" => "form-control", "id" => "session_id", "readonly"]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary mr-1 waves-effect waves-float waves-light" id="send"><i data-feather='save'></i> Confirmar Pago</button>

                            <a class="btn btn-danger waves-effect waves-float waves-light" href="{{ url("list-fees/".$row->contract_id) }}" id="cancel"><i data-feather='corner-up-left'></i> Regresar</a>
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
