@extends('layouts.app')

@section('title', 'Anexos')

@section('content')
    <section id="basic-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card" style="padding: 15px;">
                    <div class="card-header border-bottom p-1">
                        <div class="head-label">
                            <h3 class="mb-0">Anexos</h3><br>
                            <span class="mt-3">
                                <strong>Cliente: </strong>{{ $row->customer->customer }} || {{ $row->type_contract }}
                            </span>
                        </div>
                        <div class="dt-buttons btn-group flex-wrap">
                            <a href="{{ url('list-contracts/list') }}" class="btn btn-danger mt-50"> Regresar</a>
                            <a href="{{ url('list-contracts/annexes/add/customer/'.$row->id) }}" class="btn btn-primary mt-50"> Agregar</a>
                        </div>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Código de Anexo</th>
                                <th>Tipo de Anexo</th>
                                <th>Costo(USD)</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $item)
                                <tr>
                                    <td>{{ $item->contract_date }}</td>
                                    <td>{{ $item->annex_code }}</td>
                                    <td>{{ $item->type_contract }}</td>
                                    <td>{{ $item->total_contract }}<strong>$</strong> </td>
                                    <td>
                                        <a href="{{ url('list-contracts/annexes/edit/'.$item->id) }}"><img src="{{ asset('backend/images/assets/edit.svg') }}" alt="" title="Editar Anexo" width="20"></a>
                                    </td>
                                </tr>
                            @empty
                                <tr class="text-center">
                                    <td colspan="5">El Contrado NO posee anexos registrados</td>
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
        // Clear localstorage
            document.addEventListener("DOMContentLoaded", function () {
                localStorage.removeItem('customer')
                localStorage.removeItem('cuotes')
                localStorage.removeItem('contract_parameters')
                localStorage.removeItem('current_customer')
            })
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
