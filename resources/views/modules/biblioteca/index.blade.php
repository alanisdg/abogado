@extends('layouts.app')

@section('title', __('Dashboard'))

@section('content')
<div class="card">
    <div class="card-header bg-primary">
        <h4 class="card-title text-white">Subir Documento</h4>
    </div>
    {!! Form::open(['url' => 'biblioteca/store', 'autocomplete' => 'off', 'id' => 'form', 'class' => 'form form-vertical', 'enctype' => 'multipart/form-data']) !!}
        <div class="card-body">
            <div class="row mt-2">
                <div class="form-group col-md-3">
                    <input type="hidden" name="contract_id" value="{{ $id }}">
                    <label class="form-label" for="customer">Nombre del archivo <span class="text-danger">*</span></label>
                    {!! Form::text("name", old('name', null), ["class" => "form-control", "id" => "name", "onkeyup" => "upperCase(this);", "autofocus", "required"]) !!}

                    <input type="hidden" name="contract_id" value="{{ $id }}">
                    <label class="form-label mt-3" for="customer">Archivo <span class="text-danger">*</span></label>
                    {!! Form::file("file", old('name', null), ["class" => "form-control", "id" => "name", "onkeyup" => "upperCase(this);", "autofocus", "required"]) !!}

                </div>


            </div>
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
                @endforeach
            @endif

            @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
            @endif
        <div class="card-footer">
            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary waves-effect waves-float waves-light"><i data-feather='save'></i> Subir</button>
                </div>
            </div>
        </div>
    {!! Form::close() !!}
</div>
@endsection

@section('scripts')
    <script>

    </script>
@endsection
