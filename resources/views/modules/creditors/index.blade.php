@extends('layouts.app')

@section('title', $config['moduleName'])

@section('content')
    <section id="basic-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card" style="padding: 15px;">
                    <div class="card-header border-bottom p-1">
                        <div class="head-label">
                            <h4 class="mb-0">{{ $config['moduleName'] }}</h4>
                        </div>
                        <div class="dt-buttons btn-group flex-wrap">
                            <a href="{{ (!is_null($contract[1])) ? url('list-contracts/annexes/'.$contract[2]) : url('list-contracts/list') }}" class="btn btn-danger mt-50"> Regresar</a>
                            <a href="{{ url('creditors/create/'.$contract[0]) }}" class="btn btn-primary mt-50"> Registrar Acreedor</a>
                        </div>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>CLIENTE</th>
                                <th>NOMBRE</th>
                                <th>MONTO</th>
                                <th>FECHA DE REGISTRO</th>
                                <th>OPCIONES</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $item)
                                <tr>
                                    <td>{{ $item->contract->customer->customer }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td><strong>$</strong>{{ $item->creditor_amount }}</td>
                                    <td>{{ date("d-m-Y", strtotime($item->registration_date)) }}</td>
                                    <td><a href="{{ url('creditors/edit/'.$item->id) }}"><img width="25" title="Editar Acreedor" src="{{ asset('backend/images/assets/edit.svg') }}"></a></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No existen registros de acreedores asociados al Contrato</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection

@section("scripts")
    <script>

        // Update status
            function updateStatus(id) {

                let userId = id
                let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                let url = '/users/update-status';

                fetch(url, {
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json, text-plain, */*",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-TOKEN": token
                    },
                    method: 'post',
                    credentials: "same-origin",
                    body: JSON.stringify({
                        user_id: userId
                    })
                })
                .then((response) => response.json())
                .then((data) => {

                    if (data == 1) {

                        $('#tableCrud').DataTable().ajax.reload();

                        toastr["success"]("", "¡Estado actualizado!")
                    } else {
                        toastr["error"]("", "¡Error en la acutalización del estado!")
                    }

                })
                .catch(function(error) {
                    toastr["error"]("", "¡Error en la consulta de datos!")
                });

            }
    </script>
@endsection
