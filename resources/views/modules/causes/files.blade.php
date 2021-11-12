@extends('layouts.app')



@section('content')
<div class="card">
    <table class="table">
        <thead>
            <th>Id</th>
            <th>Fecha</th>
            <th>Nombre</th>
            <th></th>
        </thead>
        <tbody>
            @foreach($files as $file)
            <tr>
                <td>{{$file->id}}</td>
                <td>{{$file->name}}</td>
                <td>{{$file->created_at}}</td>
                <td><a href="/file/{{$file->id}}">Descargar</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @include('partials.modalCauses')
@endsection

@section("scripts")
    <script>

    </script>
@endsection
