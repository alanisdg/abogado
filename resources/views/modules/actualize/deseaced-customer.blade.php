{!! Form::open(['url' => 'contract/update/deceased-customer', 'autocomplete' => 'off', 'id' => 'form', 'class' => 'form form-vertical']) !!}
    <input type="hidden" value="{{ @$row->id }}" name="contract_id">

    <div class="divider">
        <div class="divider-text"><h4>Fallecido</h4></div>
    </div>

    @include('partials.paymentPlanTable')

    <div class="divider">
        <div class="divider-text"></div>
    </div>

    <div class="row">
        <div class="col-12 col-md-7">
            <div class="row">
                <div class="col-12 mt-2 mb-2 text-center">
                    <h4>Nuevo Representante</h4>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-3">
                    <label class="form-label" for="customer">Nombre</label>
                    {!! Form::text("customer", old('customer', null), ["class" => "form-control", "id" => "customer", "onkeyup" => "upperCase(this);", "required"]) !!}
                </div>
                <div class="form-group col-md-3">
                    <label class="form-label" for="customer">RUT</label>
                    {!! Form::text("rut", old('rut', null), ["class" => "form-control", "id" => "deceased_rut", "required"]) !!}
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
                    {!! Form::text("phone", old('phone', null), ["class" => "form-control", "id" => "deceased_phone"]) !!}
                </div>
                <div class="form-group col-md-3">
                    <label class="form-label" for="home_phone">Teléfono Casa</label>
                    {!! Form::text("home_phone", old('home_phone', null), ["class" => "form-control", "id" => "deceased_home_phone"]) !!}
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
                <div class="col-12 mt-2 mb-2 text-center">
                    <h4>Nuevo Plan de Pago</h4>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-4">
                    <label class="form-label" for="customer">Monto del Contrato</label>
                    {!! Form::text("deceased_new_payment_amount", old('deceased_new_payment_amount', null), ["class" => "form-control", "id" => "deceased_new_payment_amount", "required"]) !!}
                </div>
                <div class="form-group col-md-4">
                    <label class="form-label" for="customer">Número de Cuotas</label>
                    {!! Form::number("deceased_amount_fees", old('deceased_amount_fees', null), ["class" => "form-control", "id" => "deceased_amount_fees", "onchange" => "calculateCuotes()", "required"]) !!}
                </div>
                <div class="form-group col-md-4">
                    <label class="form-label" for="customer">Monto de Cuotas</label>
                    {!! Form::text("deceased_quota_amount", old('deceased_quota_amount', null), ["class" => "form-control", "id" => "deceased_quota_amount", "readonly", "required", "onclick" => "deceasedCalculateCuotes()", "onfocus" => "deceasedCalculateCuotes()"]) !!}
                </div>
                <div class="form-group col-md-6">
                    <label class="form-label" for="customer">Pago Primera Cuota</label>
                    {!! Form::date("deceased_new_payment_date", old('deceased_new_payment_date', null), ["class" => "form-control", "id" => "deceased_new_payment_date", "required"]) !!}
                </div>
                <div class="form-group col-md-6">
                    <label class="form-label" for="customer">Observaciones</label>
                    {!! Form::textarea("observations", old('observations', @$row->observations), ["placeholder" => "Observaciones", "class" => "form-control", "id" => "observations", "size" => "1x2", "onkeyup" => "upperCase(this);" ]) !!}
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
