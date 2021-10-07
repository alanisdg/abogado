@extends('layouts.app')

@section('title', 'Detalles de Preview')

@section('content')
    <div class="row">

        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h4 class="card-title text-white">Datos generales Preview</h4>
                </div>
                <div class="card-body">
                    <form action="/preview/update/{{  @$row->id }}" method="post">
                        @csrf
                    <div class="row mt-2">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="first-name-icon">Fecha Entrevista </label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i data-feather='file-text'></i></span>
                                    </div>
                                    {!! Form::date("date", old('date', @$row->date), ["class" => "form-control", 'required']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="first-name-icon">Hora de: </label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i data-feather='file-text'></i></span>
                                    </div>
                                    {!! Form::time("hour_1", old('second_date', @$row->hour_1), ["class" => "form-control",'required']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="first-name-icon">a: </label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i data-feather='file-text'></i></span>
                                    </div>
                                    {!! Form::time("hour_2", old('second_date', @$row->hour_2), ["class" => "form-control", 'required']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="first-name-icon">Nombre </label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i data-feather='file-text'></i></span>
                                    </div>
                                    {!! Form::text("name", old('names', @$row->name), ["class" => "form-control", "readonly"]) !!}
                                </div>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <label for="first-name-icon">RUT </label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i data-feather='file-text'></i></span>
                                    </div>
                                    {!! Form::text("rut", old('rut', @$row->rut), ["class" => "form-control"]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="first-name-icon">Estado </label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i data-feather='file-text'></i></span>
                                    </div>
                                    <select  name="state_id" class="form-control">
                                        <option @if(@$row->state_id == 1) selected  @endif value="1">No contactado</option>
                                        <option @if(@$row->state_id == 2) selected  @endif value="2">Entrevista</option>
                                        <option @if(@$row->state_id == 3) selected  @endif value="3">Duda</option>
                                        <option @if(@$row->state_id == 4) selected  @endif value="4">No contesta</option>
                                        <option @if(@$row->state_id == 5) selected  @endif value="5">No interesado</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="first-name-icon">Correo Electrónico </label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i data-feather='mail'></i></span>
                                    </div>
                                        {!! Form::email("email", old('email', @$row->email), ["class" => "form-control"]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="first-name-icon">Teléfono </label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i data-feather='phone'></i></span>
                                    </div>
                                        {!! Form::number("phone", old('phone', @$row->phone), ["class" => "form-control"]) !!}
                                </div>
                            </div>

                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="first-name-icon">Comuna </label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i data-feather='file-text'></i></span>
                                    </div>
                                        {!! Form::text("comuna", old('phone', @$row->comuna), ["class" => "form-control"]) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <input type="submit" class="btn btn-primary waves-effect waves-float waves-light" value=" Actualizar" >
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <script>

    </script>
@endsection
