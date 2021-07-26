{!! Form::open(['url' => 'contract/update/change-creditor', 'autocomplete' => 'off', 'id' => 'form', 'class' => 'form form-vertical']) !!}
    <input type="hidden" value="{{ @$row->id }}" name="contract_id">

    <div class="divider">
        <div class="divider-text"><h4>Cambio de Acreedor</h4></div>
    </div>

    @include('partials.paymentPlanTable')

    <div class="row">
        <div class="col-12 col-md-6">
            <div class="row mt-2 mb-2">
                <div class="col-12 text-center">
                    <h4>Datos del Nuevo Acreedor</h4>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-12 col-md-12">
                    <label class="form-label" for="customer">Acreedor Actual</label>
                    <select class="form-control" name="current_creditor" id="current_creditor">
                            <option value="">Seleccione</option>
                        @forelse ($row->creditors as $creditor)
                            <option value="{{ $creditor->id }}">{{ $creditor->name }}</option>
                        @empty
                            <option value="">Sin registro de Acreedores</option>
                        @endforelse
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-12 col-md-6">
                    <label class="form-label" for="customer">Nuevo Acreedor</label>
                    {!! Form::text("new_creditor", old('new_creditor', null), ["class" => "form-control", "id" => "new_creditor", "required", "onkeyup" => "upperCase(this);"]) !!}
                </div>
                <div class="form-group col-12 col-md-6">
                    <label class="form-label" for="customer">Fecha de Registro</label>
                    {!! Form::date("creditor_registration_date", old('creditor_registration_date', null), ["class" => "form-control", "id" => "creditor_registration_date", "required"]) !!}
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
                                {!! Form::text("creditor_amount", old('creditor_amount',null), ["class" => "form-control", "id" => "creditor_amount_1", "required"]) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-12 col-md-12">
                    <label class="form-label" for="customer">Observaciones</label>
                    {!! Form::textarea("observations", old('observations', @$row->observations), ["placeholder" => "Observaciones", "class" => "form-control", "id" => "observations", "size" => "1x2", "onkeyup" => "upperCase(this);" ]) !!}
                </div>
            </div>
        </div>
        <div class="col-12 col-md-5">
            <div class="row mt-2 mb-2">
                <div class="col-12 text-center">
                    <h4>Nuevo Plan de Pago</h4>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label class="form-label" for="customer">Monto del Contrato</label>
                    {!! Form::text("contract_amount", old('contract_amount', null), ["class" => "form-control", "id" => "creditor_contract_amount", "required"]) !!}
                </div>
                <div class="form-group col-md-6">
                    <label class="form-label" for="customer">Número de Cuotas</label>
                    {!! Form::number("number_installments", old('number_installments', null), ["class" => "form-control", "id" => "creditor_number_installments", "onchange" => "calculateCuotes()", "required"]) !!}
                </div>
                <div class="form-group col-md-6">
                    <label class="form-label" for="customer">Monto de Cuotas</label>
                    {!! Form::text("amount_fees", old('amount_fees', null), ["class" => "form-control", "id" => "creditor_amount_fees", "readonly", "required", "onclick" => "creditorCalculateCuotes()", "onfocus" => "creditorCalculateCuotes()"]) !!}
                </div>
                <div class="form-group col-md-6">
                    <label class="form-label" for="customer">Pago Primera Cuota</label>
                    {!! Form::date("first_installment_payment", old('first_installment_payment', null), ["class" => "form-control", "required"]) !!}
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
