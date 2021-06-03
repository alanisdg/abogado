@extends('backend.layouts.app')

@if ($typeForm == 'create')
    @section('title', __($config['addSkill']))
@else
    @section('title', __($config['editSkill']))
@endif


@section('content')
    <div class="card">
        <div class="card-header">
            @if ($typeForm == 'create')
                <h4 class="card-title">{{ __($config['addSkill']) }}</h4>
            @else
                <h4 class="card-title">{{ __($config['editSkill']) }}</h4>
            @endif
        </div>
        <div class="card-body">
            @if ($typeForm == 'create')
                {!! Form::open(['route' => $config['routeLink'].'.store', 'autocomplete' => 'off', 'id' => 'form', 'class' => 'form form-vertical', 'enctype' => 'multipart/form-data']) !!}
            @else
                {!! Form::model($row, ['route' => [$config['routeLink'].'.update', $row->id], 'method' => 'patch', 'autocomplete' => 'off', 'id' => 'form', 'class' => 'form form-vertical', 'enctype' => 'multipart/form-data']) !!}
            @endif
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                            <label for="first-name-icon">{{ __("Name") }} <span class="text-danger"><strong>*</strong></span></label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i data-feather='file-text'></i></span>
                                </div>
                                    {!! Form::text("name", old('name', @$row->name), ["class" => "form-control", "onkeyup" => "upperCase(this);", "required"]) !!}
                            </div>
                        </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="first-name-icon">{{ __("Image") }} <span class="text-danger"><strong>*</strong></span></label></label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="file" name="file_name" {{ $typeForm == "create" ? "required" : "" }}>
                                    <label class="custom-file-label" for="customFile">{{ __("Choose file") }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="card" id="preview" width: 180px; height: 160px;>
                                @if ($typeForm == "create")
                                    <img class="img-fluid" src="{{ asset('backend/images/assets/image-placeholder.png') }}" width: 180px; height: 160px;>
                                @else
                                    <img class="img-fluid" src="{{ asset('backend/images/uploads/skills/'.$row->file_name) }}" width: 180px; height: 160px;>
                                @endif
                            </div>
                        </div>
                        <div class="col-12">
                            @if ($typeForm == 'create')
                                <button type="submit" class="btn btn-primary mr-1 waves-effect waves-float waves-light" id="send"><i data-feather='save'></i> {{ __("Register") }}</button>
                            @else
                                <button type="submit" class="btn btn-warning mr-1 waves-effect waves-float waves-light" id="send"><i data-feather='refresh-cw'></i> {{ __("Update") }}</button>
                            @endif
                            <a class="btn btn-danger waves-effect waves-float waves-light" href="{{ url("skills") }}" id="cancel"><i data-feather='corner-up-left'></i> {{ __("To Return") }}</a>
                        </div>
                    </div>
                {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Upload image
        document.getElementById("file").onchange = function(e) {
            // Creamos el objeto de la clase FileReader
            let reader = new FileReader();

            // Leemos el archivo subido y se lo pasamos a nuestro fileReader
            reader.readAsDataURL(e.target.files[0]);

            // Le decimos que cuando este listo ejecute el código interno
            reader.onload = function(){
                let preview = document.getElementById('preview'),
                        image = document.createElement('img');

                image.src = reader.result;
                image.style.width = "90%";

                preview.innerHTML = '';
                preview.append(image);
            };
        }
    </script>
@endsection
