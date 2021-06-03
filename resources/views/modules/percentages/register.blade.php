@extends('backend.layouts.app')

@section('title', __($config['moduleName']))

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">{{ __($config['moduleName']) }}</h4>
        </div>
        <div class="card-body">
                {!! Form::open(['url' => 'shipping/percentage/update', 'autocomplete' => 'off', 'id' => 'form', 'class' => 'form form-vertical']) !!}

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                            <label for="first-name-icon">{{ __("Value") }} <span class="text-danger"><strong>*</strong></span></label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">%</span>
                                </div>
                                    {!! Form::number("value", old('value', @$row->value), ["class" => "form-control", "required"]) !!}
                            </div>
                        </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary mr-1 waves-effect waves-float waves-light" id="send"><i data-feather='refresh-ccw'></i> {{ __("Update") }}</button>
                        </div>
                    </div>
                {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('scripts')
    <script>
    </script>
@endsection
