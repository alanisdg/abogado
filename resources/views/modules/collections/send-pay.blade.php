@extends('layouts.app')

@section('title', "Enviar Pago")

@section('content')
    <div class="card">
        <div class="card-header bg-primary">
            <h4 class="card-title text-white">Enviar Pago</h4>
        </div>
        <div class="card-body mt-2">
                {!! Form::open(['url' => 'https://webpay3gint.transbank.cl/webpayserver/initTransaction', 'autocomplete' => 'off', 'id' => 'form', 'class' => 'form form-vertical']) !!}

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                {!! Form::text("token_ws", old('token_ws', @$resp->token), ["class" => "form-control", "readonly"]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-warning mr-1 waves-effect waves-float waves-light" id="send"><i data-feather='send'></i> Enviar Pago</button>

                            <a class="btn btn-danger waves-effect waves-float waves-light" href="{{ url("list-fees/".$contract) }}" id="cancel"><i data-feather='alert-octagon'></i> Cancelar</a>
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
