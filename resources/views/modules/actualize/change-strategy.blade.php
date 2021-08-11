{!! Form::open(['url' => 'contract/update/change-strategy', 'autocomplete' => 'off', 'id' => 'form', 'class' => 'form form-vertical']) !!}
    <input type="hidden" value="{{ @$row->id }}" name="contract_id">

    <div class="divider">
        <div class="divider-text"><h4>Cambio de Estrategia</h4></div>
    </div>

    @include('partials.paymentPlanTable')

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="form-group col-md-2">
                    <label class="form-label" for="customer">Monto</label>
                    {!! Form::text("strategy_contract_amount", old('strategy_contract_amount', null), ["class" => "form-control", "id" => "strategy_contract_amount", "required"]) !!}
                </div>
                <div class="form-group col-md-2">
                    <label class="form-label" for="customer">Número de Cuotas</label>
                    {!! Form::number("number_strategy_installments", old('number_strategy_installments', null), ["class" => "form-control", "id" => "number_strategy_installments", "onchange" => "calculateCuotes()", "required"]) !!}
                </div>
                <div class="form-group col-md-2">
                    <label class="form-label" for="customer">Monto de Cuotas</label>
                    {!! Form::text("amount_strategy_fees", old('amount_strategy_fees', null), ["class" => "form-control", "id" => "amount_strategy_fees", "readonly", "required", "onclick" => "calculateCuotes()", "onfocus" => "calculateCuotes()"]) !!}
                </div>
                <div class="form-group col-md-3">
                    <label class="form-label" for="customer">Fecha de Pago Primera Cuota</label>
                    {!! Form::date("payment_date_installment_strategy", old('payment_date_installment_strategy', null), ["class" => "form-control", "id" => "payment_date_installment_strategy", "required"]) !!}
                </div>
                <div class="form-group col-md-3">
                    <label class="form-label" for="customer">Observaciones</label>
                    {!! Form::textarea("observations", old('observations', @$row->observations), ["placeholder" => "Observaciones", "class" => "form-control", "id" => "observations", "size" => "1x2", "onkeyup" => "upperCase(this);" ]) !!}
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-12">
                    <button class="btn btn-primary" type="submit"><i data-feather='refresh-ccw'></i> Actualizar</button>
                </div>
            </div>
        </div>
    </div>
{!! Form::close() !!}
