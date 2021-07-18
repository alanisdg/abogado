{!! Form::open(['url' => 'contract/update/change-creditor', 'autocomplete' => 'off', 'id' => 'form', 'class' => 'form form-vertical']) !!}
    <input type="hidden" value="{{ @$row->id }}" name="contract_id">

    <div class="divider">
        <div class="divider-text"><h4>Cambio de Acreedor</h4></div>
    </div>
    <div class="row">
        <div class="form-group col-md-4">
            <label class="form-label" for="customer">Acreedor Actual</label>
            {!! Form::text("current_creditor", old('current_creditor', @$row->current_creditor), ["class" => "form-control", "id" => "current_creditor", "autofocus", "onkeyup" => "upperCase(this);", "required"]) !!}
        </div>
        <div class="form-group col-md-4">
            <label class="form-label" for="customer">Nuevo Acreedor</label>
            {!! Form::text("new_creditor", old('new_creditor', @$row->new_creditor), ["class" => "form-control", "id" => "new_creditor", "onkeyup" => "upperCase(this);", "required"]) !!}
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
