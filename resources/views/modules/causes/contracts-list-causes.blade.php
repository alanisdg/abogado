@extends('layouts.app')

@section('title', 'Registro de Causas')

@section('content')
    <section id="basic-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card table-responsive" style="padding: 15px;">
                    <div class="card-header border-bottom p-1">
                        <div class="head-label">
                            <h3 class="mb-0">Registro de Causas</h3><br>
                            <span class="mt-3">
                                <strong>Cliente: </strong>{{ $row->customer->customer }} || {{ $row->type_contract }}
                            </span>
                        </div>
                        <div class="dt-buttons btn-group flex-wrap">
                            <a href="{{ url('causes/contracts') }}" class="btn btn-danger mt-50"> Regresar</a>
                            <a href="{{ url('causes/contracts/record-causes/add-cause/'.$row->id) }}" class="btn btn-primary mt-50"> Agregar</a>
                        </div>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Número de RIT</th>
                                <th>Tribunal</th>
                                <th>Materia</th>
                                <th>Estado</th>
                                <th>Avance</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($row->causes as $item)
                                <tr>
                                    <td>{{ $item->number_rit }}</td>
                                    <td>{{ $item->court }}</td>
                                    <td>{{ $item->matter }}</td>
                                    <td>{{ ($item->status == 2) ? "CERRADA" : "ABIERTA" }}</td>
                                    <td> @if($item->percent <= 9)
                                        Recopilación preliminar de antecedentes.
                                        @endif

                                        @if($item->percent > 9 AND $item->percent<= 30)
                                        Inicio de tramitación.
                                        @endif

                                        @if($item->percent > 30 AND $item->percent<= 70)
                                        Tramitación en proceso.
                                        @endif

                                        @if($item->percent > 75 AND $item->percent<= 95)
                                        Tramitación en proceso.
                                        @endif


                                        @if($item->percent > 95)
                                        Terminada.
                                        @endif

                                        % {{ $item->percent }}</td>
                                    <td>
                                        @if ($item->status != 2)
                                            <a href="{{ url('causes/contracts/record-causes/add-cause/edit/'.$item->id) }}">
                                                <img src="{{ asset('backend/images/assets/edit.svg') }}" title="Editar Causa" alt="" width="20">
                                            </a>
                                        @endif

                                        <a href="{{ url('causes/'.$item->id.'/tasks') }}">
                                            <img src="{{ asset('backend/images/assets/to-do.svg') }}" title="Tareas" alt="" width="20">
                                        </a>
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
