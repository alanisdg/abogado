{!! Form::open(['url' => 'contract/update/change-payment-date', 'autocomplete' => 'off', 'id' => 'form', 'class' => 'form form-vertical']) !!}
    <input type="hidden" value="{{ @$row->id }}" name="contract_id">

    <div class="divider">
        <div class="divider-text"><h4>Cambio de Fecha de Pago</h4></div>
    </div>

    @include('partials.paymentPlanTable')

    <div class="row">
        <div class="col-12 text-center mb-2">
            <h4>Nuevo Plan de Pago</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="row">
                <div class="form-group col-md-12">
                    <label class="form-label" for="customer">Proxima Fecha de Pago</label>
                    {!! Form::date("nextPaymentDate", old('nextPaymentDate', @$nextPaymentDate), ["class" => "form-control", "id" => "nextPaymentDate", "readonly"]) !!}
                </div>
                <div class="form-group col-md-12">
                    <label class="form-label" for="customer">Observaciones</label>
                    {!! Form::textarea("observations", old('observations', null), ["placeholder" => "Observaciones", "class" => "form-control", "id" => "observations", "size" => "1x2", "onkeyup" => "upperCase(this);" ]) !!}
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="row">
                <div class="form-group col-md-6">
                    <label class="form-label" for="customer">Monto del Contrato</label>
                    {!! Form::text("deceased_new_payment_amount", old('deceased_new_payment_amount', null), ["class" => "form-control", "id" => "payment_date_amount", "required"]) !!}
                </div>
                <div class="form-group col-md-6">
                    <label class="form-label" for="customer">Número de Cuotas</label>
                    {!! Form::number("deceased_amount_fees", old('deceased_amount_fees', null), ["class" => "form-control", "id" => "payment_date_amount_fees", "onchange" => "calculateCuotes()", "required"]) !!}
                </div>
                <div class="form-group col-md-6">
                    <label class="form-label" for="customer">Monto de Cuotas</label>
                    {!! Form::text("deceased_quota_amount", old('deceased_quota_amount', null), ["class" => "form-control", "id" => "payment_date_quota_amount", "readonly", "required", "onclick" => "paymentDateCalculateCuotes()", "onfocus" => "paymentDateCalculateCuotes()"]) !!}
                </div>
                <div class="form-group col-md-6">
                    <label class="form-label" for="customer">Pago Primera Cuota</label>
                    {!! Form::date("deceased_new_payment_date", old('deceased_new_payment_date', null), ["class" => "form-control", "required"]) !!}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <button class="btn btn-primary" type="submit"><i data-feather='refresh-ccw'></i> Actualizar</button>
        </div>
    </div>
{!! Form::close() !!}
