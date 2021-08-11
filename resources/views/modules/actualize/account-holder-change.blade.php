{!! Form::open(['url' => 'contract/update/account-holder-change', 'autocomplete' => 'off', 'id' => 'form', 'class' => 'form form-vertical']) !!}
    <input type="hidden" value="{{ @$row->id }}" name="contract_id">

    <div class="divider">
        <div class="divider-text"><h4>Cambio de Titular de Cuenta</h4></div>
    </div>

    @include('partials.paymentPlanTable')

    <div class="card">
        <div class="card-body">
            <div class="row mt-2">
                <div class="col-12 col-md-7">
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label class="form-label" for="customer">Titular</label>
                            {!! Form::text("new_account_holder", old('new_account_holder', null), ["class" => "form-control", "id" => "new_account_holder", "onkeyup" => "upperCase(this);", "required"]) !!}
                        </div>
                        <div class="form-group col-md-3">
                            <label class="form-label" for="customer">RUT</label>
                            {!! Form::text("rut", old('rut', null), ["class" => "form-control", "id" => "rut", "required"]) !!}
                        </div>
                        <div class="form-group col-md-3">
                            <label class="form-label" for="nationality">Nacionalidad</label>
                            {!! Form::text("nationality", old('nationality', @$contract->customer->nationality), ["class" => "form-control", "id" => "nationality", "onkeyup" => "upperCase(this);"]) !!}
                        </div>
                        <div class="form-group col-md-3">
                            <label class="form-label" for="customer">Estado Civil</label>
                            {!! Form::text("civil_status", old('civil_status', null), ["class" => "form-control", "id" => "civil_status", "onkeyup" => "upperCase(this);", "required"]) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label class="form-label" for="customer">Profesión</label>
                            {!! Form::text("profession", old('profession', null), ["class" => "form-control", "id" => "profession", "onkeyup" => "upperCase(this);", "required"]) !!}
                        </div>
                        <div class="form-group col-md-3">
                            <label class="form-label" for="phone">Teléfono Celular</label>
                            {!! Form::text("phone", old('phone', null), ["class" => "form-control", "id" => "phone"]) !!}
                        </div>
                        <div class="form-group col-md-3">
                            <label class="form-label" for="home_phone">Teléfono Casa</label>
                            {!! Form::text("home_phone", old('home_phone', null), ["class" => "form-control", "id" => "home_phone"]) !!}
                        </div>
                        <div class="form-group col-md-3">
                            <label class="form-label" for="email">Email</label>
                            {!! Form::text("email", old('email', null), ["class" => "form-control", "id" => "email"]) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label class="form-label" for="customer">Dirección</label>
                            {!! Form::textarea("address", old('address', null), ["placeholder" => "Dirección", "class" => "form-control", "required", "size" => "1x2", "onkeyup" => "upperCase(this);" ]) !!}
                        </div>
                        <div class="form-group col-md-4">
                            <label class="form-label" for="commune">Comuna</label>
                            {!! Form::text("commune", old('commune', null), ["class" => "form-control", "id" => "commune", "onkeyup" => "upperCase(this);"]) !!}
                        </div>
                        <div class="form-group col-md-4">
                            <label class="form-label" for="region">Región</label>
                            {!! Form::text("region", old('region', null), ["class" => "form-control", "id" => "region", "onkeyup" => "upperCase(this);"]) !!}
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-5">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label class="form-label" for="customer">Monto del Contrato</label>
                            {!! Form::text("contract_amount", old('contract_amount', null), ["class" => "form-control", "id" => "contract_amount_holder", "required"]) !!}
                        </div>
                        <div class="form-group col-md-4">
                            <label class="form-label" for="customer">Número de Cuotas</label>
                            {!! Form::number("number_installments", old('number_installments', null), ["class" => "form-control", "id" => "number_fees_holder", "required"]) !!}
                        </div>
                        <div class="form-group col-md-4">
                            <label class="form-label" for="customer">Monto de Cuotas</label>
                            {!! Form::text("amount_fees", old('amount_fees', null), ["class" => "form-control", "id" => "amount_fees_holder", "readonly", "required", "onclick" => "holderCalculateCuotes()", "onfocus" => "holderCalculateCuotes()"]) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="form-label" for="customer">Fecha Pago Primera Cuota</label>
                            {!! Form::date("date_first_payment", old('date_first_payment', null), ["class" => "form-control", "id" => "date_first_payment", "required"]) !!}
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="customer">Observaciones</label>
                            {!! Form::textarea("observations", old('observations', null), ["placeholder" => "Observaciones", "class" => "form-control", "id" => "observations", "size" => "1x2", "onkeyup" => "upperCase(this);" ]) !!}
                        </div>
                    </div>
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
