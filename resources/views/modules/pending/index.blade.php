@extends('layouts.app')

@section('title', $config['moduleName'])

@section('content')
    <section id="basic-datatable">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <h4 class="card-title">Cargar Base de Datos</h4>
                        <p class="card-text text-danger">Solo se permite carga de de Infomación desde Documentos Excel.</p>
                        {!! Form::open(['url' => 'pending/upload', 'autocomplete' => 'off', 'id' => 'form', 'class' => 'form', 'enctype' => 'multipart/form-data']) !!}
                            <div class="row mt-2">
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="customFile">Seleccione el archivo a cargar</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="customFile" name="file">
                                            <label class="custom-file-label" for="customFile">Seleccione</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-2"><i data-feather='upload'></i> Cargar</button>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
          </div>
    </section>
@endsection

@section("scripts")
    <script>

    </script>
@endsection
