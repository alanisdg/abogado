@extends('layouts.app')

@section('title', 'Listado de Cuotas')

@section('content')
    <div class="row" id="basic-table">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Listado de Cuotas</h4>
                </div>
                <div class="table-responsive">
                    <table class="table" id="list-collections">
                        <thead>
                            <tr>
                                <th>NRO DE CUOTA</th>
                                <th>MONTO ($)</th>
                                <th>FECHA DE PAGO</th>
                                <th>ESTADO</th>
                                <th>OPCIONES</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($dataCollections as $item)
                                <tr>
                                    <td>{{ $item->installment_number }}</td>
                                    <td>{{ $item->amount }}</td>
                                    <td>{{ date("d-m-Y", strtotime($item->amount)) }}</td>
                                    @if ($item->status == "PENDIENTE")
                                        <td><span class="text-warning">{{ $item->status }}</span></td>
                                        <td>
                                            <a href="{{ url('list-fess/pay-fee/'.$item->id) }}" title="Pagar Cuota"><img width="20" src="{{ asset('backend/images/assets/metodo-de-pago.svg') }}" alt=""></a>
                                        </td>
                                    @elseif ($item->status == "PAGADA")
                                        <td><span class="text-info">{{ $item->status }}</span></td>
                                    @else
                                        <td><span class="text-success">{{ $item->status }}</span></td>
                                    @endif
                                </tr>
                            @empty

                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="dt-buttons btn-group flex-wrap">
                    <a href="{{ url('dashboard') }}" class="btn btn-danger mt-50"> Regresar</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("scripts")
    <script>

    </script>
@endsection
