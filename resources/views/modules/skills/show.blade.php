@extends('backend.layouts.app')

@section('title', __($config['addSkill']))

@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="card-title">{{ __($config['skillDetails']) }}</h4>
    </div>
    <div class="card-body">
        {!! Form::model($row, ['route' => [$config['routeLink'].'.update', $row->id], 'method' => 'patch', 'autocomplete' => 'off', 'id' => 'form', 'class' => 'form form-vertical']) !!}
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                    <label for="first-name-icon">{{ __("Name") }}</label>
                    <div class="input-group input-group-merge">
                        <div class="input-group-prepend">
                        <span class="input-group-text"><i data-feather='file-text'></i></span>
                        </div>
                        {!! Form::text("name", old('name', @$row->name), ["class" => "form-control", "onkeyup" => "upperCase(this);", "readonly"]) !!}
                    </div>
                    </div>
                </div>
                <div class="col-12">
                    <a class="btn btn-danger waves-effect waves-float waves-light" href="{{ url("skills") }}" id="cancel"><i data-feather='corner-up-left'></i> {{ __("To Return") }}</a>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
  </div>
@endsection
