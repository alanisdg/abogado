@extends('layouts.app')

@section('title', __('Dashboard'))

@section('content')
<div class="card">
    <table class="table">
        <thead>
            <th>Id</th>
            <th>Fecha</th>
            <th></th>
        </thead>
        <tbody>
            @foreach($files as $file)
            <tr>
                <td>{{$file->id}}</td>
                <td>{{$file->created_at}}</td>
                <td><a href="/file/{{$file->id}}">Descargar</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @foreach($files as $file)

    @endforeach
</div>
@endsection

@section('scripts')
    <script>

    </script>
@endsection
