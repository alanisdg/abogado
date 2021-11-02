@extends('layouts.app')

@section('title', 'Listado de Causas')

@section('content')
    <div class="row" id="basic-table">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h4 class="card-title text-white">Listado de Causas</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="list-collections">
                            <thead>
                                <tr>
                                    <th>RIT</th>
                                    <th>TRIBUNAL</th>
                                    <th>MATERIA</th>
                                    <th>PORCENTAJE</th>
                                    <th>ESTADO</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($list as $item)
                                    <tr>
                                        <td>{{ $item->number_rit }}</td>
                                        <td>{{ $item->court }}</td>
                                        <td>{{ $item->matter }}</td>
                                        <td>% {{ $item->percent }}</td>
                                        <td>
                                            @if ($item->status == 1)
                                                <span class="text-warning">ABIERTA</span>
                                            @elseif ($item->status == 2)
                                                <span class="text-success">CERRADA</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty

                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="dt-buttons btn-group flex-wrap">
                            <a href="{{ url('dashboard') }}" class="btn btn-danger mt-50"> Regresar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("scripts")
    <script>

    </script>
@endsection
