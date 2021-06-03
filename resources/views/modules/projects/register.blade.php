@extends('backend.layouts.app')

@section('title',  $typeForm == 'create' ? __($config['addProject']) : __($config['editProject']))

@section('styles')
    <link rel="stylesheet" href="{{ asset('backend/css/assets/vendors/css/forms/select/select2.min.css') }}">
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">{{ $typeForm == 'create' ? __($config['addProject']) : __($config['editProject']) }}</h4>
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
                                <label for="first-name-icon">{{ __("Title") }} <span class="text-danger"><strong>*</strong></span></label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i data-feather='file-text'></i></span>
                                    </div>
                                        {!! Form::text("title", old('title', @$row->title), ["class" => "form-control", "Placeholder" => __('Title')]) !!}
                                </div>

                                @error('title')
                                    <div class="text-danger">{{ __('The title field is required..') }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="first-name-icon">{{ __("Description") }} <span class="text-danger"><strong>*</strong></span></label>
                                {!! Form::textarea("description", old('description', @$row->description), ["Placeholder" => __('Description'), "class" => "form-control", "size" => "1x3"]) !!}
                            </div>
                            @error('description')
                                <div class="text-danger">{{ __('The description field is required..') }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="first-name-icon">{{ __("Client") }} <span class="text-danger"><strong>*</strong></span></label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i data-feather='user'></i></span>
                                    </div>
                                        {!! Form::text("client", old('client', @$row->client), ["class" => "form-control", "Placeholder" => __('Client')]) !!}
                                </div>
                                @error('client')
                                    <div class="text-danger">{{ __('The client field is required..') }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="first-name-icon">{{ __("Industry") }} <span class="text-danger"><strong>*</strong></span></label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i data-feather='trello'></i></span>
                                    </div>
                                        {!! Form::text("industry", old('industry', @$row->industry), ["class" => "form-control", "Placeholder" => __('Industry')]) !!}
                                </div>
                                @error('industry')
                                    <div class="text-danger">{{ __('The industry field is required..') }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="first-name-icon">{{ __("Skills") }} <span class="text-danger"><strong>*</strong></span></label>
                                <select name="skills[]" class="form-control select2" id="normalMultiSelect" multiple="multiple">
                                    @foreach ($skills as $skill)
                                        <option value="{{ $skill->id }}" @if(old('skill_id') == $skill->id OR @$skill->id == @$row->skill_id) selected @endif >
                                            {{ $skill->name }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('skills[]')
                                    <div class="text-danger">{{ __('The skills[] field is required.') }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="first-name-icon">{{ __("Image") }} <span class="text-danger"><strong>*</strong></span></label></label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="file" name="file_name">
                                    <label class="custom-file-label" for="customFile">{{ __("Choose file") }}</label>
                                </div>

                                @error('file_name')
                                    <div class="text-danger">{{ __('The file name field is required.') }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="card" id="preview" width: 180px; height: 160px;>
                                @if ($typeForm == "create")
                                    <img class="img-fluid" src="{{ asset('backend/images/assets/image-placeholder.png') }}" width: 180px; height: 160px;>
                                @else
                                    <img class="img-fluid" src="{{ asset('backend/images/uploads/projects/'.$row->file_name) }}" width: 180px; height: 160px;>
                                @endif
                            </div>
                        </div>
                        <div class="col-12">
                            @if ($typeForm == 'create')
                                <button type="submit" class="btn btn-primary mr-1 waves-effect waves-float waves-light" id="send"><i data-feather='save'></i> {{ __("Register") }}</button>
                            @else
                                <button type="submit" class="btn btn-warning mr-1 waves-effect waves-float waves-light" id="send"><i data-feather='refresh-cw'></i> {{ __("Update") }}</button>
                            @endif
                            <a class="btn btn-danger waves-effect waves-float waves-light" href="{{ url("projects") }}" id="cancel"><i data-feather='corner-up-left'></i> {{ __("To Return") }}</a>
                        </div>
                    </div>
                {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('backend/js/vendors/forms/select/select2.full.min.js') }}"></script>
    <script src="{{ asset('backend/js/scripts/forms/form-select2.min.js') }}"></script>
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
