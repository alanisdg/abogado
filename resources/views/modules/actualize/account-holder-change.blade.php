{!! Form::open(['url' => 'contract/update/account-holder-change', 'autocomplete' => 'off', 'id' => 'form', 'class' => 'form form-vertical']) !!}
    <input type="hidden" value="{{ @$row->id }}" name="contract_id">

    <div class="divider">
        <div class="divider-text"><h4>Cambio de Titular de Cuenta</h4></div>
    </div>
    <div class="row">
        <div class="form-group col-md-4">
            <label class="form-label" for="customer">Nuevo Titular de Cuenta</label>
            {!! Form::text("new_account_holder", old('new_account_holder', @$row->new_account_holder), ["class" => "form-control", "id" => "new_account_holder", "onkeyup" => "upperCase(this);", "required"]) !!}
        </div>
        <div class="form-group col-md-4">
            <label class="form-label" for="customer">RUT</label>
            {!! Form::text("rut", old('rut', @$row->rut), ["class" => "form-control", "id" => "rut", "onkeyup" => "upperCase(this);", "required"]) !!}
        </div>
        <div class="form-group col-md-4">
            <label class="form-label" for="customer">Observaciones</label>
            {!! Form::textarea("observations", old('observations', @$row->observations), ["placeholder" => "Observaciones", "class" => "form-control", "id" => "observations", "size" => "1x2", "onkeyup" => "upperCase(this);" ]) !!}
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <button class="btn btn-primary" type="submit"><i data-feather='refresh-ccw'></i> Actualizar</button>
        </div>
    </div>
{!! Form::close() !!}
