@extends('backend.layouts.app')

@section('title',  __('Edit Zone'))

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">{{ __('Edit') }}</h4>
        </div>
        <div class="card-body">
            {!! Form::model($row, ['url' => 'customers/update', 'method' => 'put', 'autocomplete' => 'off', 'id' => 'form', 'class' => 'form form-vertical']) !!}
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="first-name-icon">{{ __("Name") }} </label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i data-feather='file-text'></i>
                                    </span>
                                </div>
                                    {!! Form::text("name", old('name', @$row->name), ["class" => "form-control", "required", "Placeholder" => __('Name'), "id" => "name", "onkeyup" => "upperCase(this);"]) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="first-name-icon">{{ __("State") }} </label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i data-feather='file-text'></i>
                                    </span>
                                </div>
                                    {!! Form::text("state", old('state', @$row->state), ["class" => "form-control", "required", "Placeholder" => __('State'), "id" => "state", "onkeyup" => "upperCase(this);"]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-warning mr-1 waves-effect waves-float waves-light" id="send">
                            <i data-feather='refresh-cw'></i>
                            {{ __("Update") }}
                        </button>
                        <a class="btn btn-danger waves-effect waves-float waves-light" href="{{ url($config['routeLink']) }}" id="cancel">
                            <i data-feather='corner-up-left'></i>
                            {{ __("To Return") }}
                        </a>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://unpkg.com/imask"></script>
    <script>
        var phoneMask = IMask(
            document.getElementById('phone'), {
                mask: '+{00} (000) 000-00-00'
            }
        );
    </script>
@endsection
