@extends('layouts.app')

@section('title', 'Causas (Registro de Tareas)')

@section('content')
    <section id="basic-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card table-responsive" style="padding: 15px;">
                    <div class="card-header border-bottom p-1">
                        <div class="head-label">
                            <h3 class="mb-0">Causas (Registro de Tareas)</h3><br>
                            <span class="mt-3">
                                {{--<strong>Cliente: </strong>{{ $row->customer->customer }} || {{ $row->type_contract }}--}}
                            </span>
                        </div>
                        <div class="dt-buttons btn-group flex-wrap">
                            <a href="{{ url('causes/contracts/record-causes/'.$causes->contract_id) }}" class="btn btn-danger mt-50"> Regresar</a>
                            <a href="{{ url('causes/'.$causes->id.'/tasks/add') }}" class="btn btn-primary mt-50"> Agregar</a>
                        </div>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Tarea</th>
                                <th>Responsable</th>
                                <th>Fecha Límite</th>
                                <th>Fecha de Realización</th>
                                <th>Estado</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($causes->tasks as $item)
                                <tr>
                                    <td>{{ $item->description }}</td>
                                    <td>{{ $item->responsible }}</td>
                                    <td>{{ $item->deadline }}</td>
                                    <td>{{ $item->date_realization }}</td>
                                    <td>
                                        @if ($item->status == 1)
                                            <span class="text-warning">PENDIENTE</span>
                                        @else
                                            <span class="text-success">REALIZADA</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->status == 1)
                                            <a href="{{ url('causes/tasks/edit/'.$item->id) }}">
                                                <img src="{{ asset('backend/images/assets/edit.svg') }}" title="Editar Tarea" alt="" width="20">
                                            </a>

                                            <a id="{{ $item->id }}" href="#" onclick="completeHomework(this.id);">
                                                <img src="{{ asset('backend/images/assets/comment.svg') }}" title="Completar Tarea" alt="" width="20">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr class="text-center">
                                    <td colspan="5">La Causa no posee TAREAS asignadas.</td>
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
        // Complete homework
            function completeHomework(id) {

                let taskId = id
                let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                let url = '/causes/tasks/complete';

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
                        task_id: taskId
                    })
                })
                .then((response) => response.json())
                .then((data) => {

                    if (data == 1) {
                        toastr["success"]("", "¡Tarea Completada!")

                        location.reload(true);
                    } else {
                        toastr["error"]("", "¡Error al completar la tarea!")
                    }

                })
            }
    </script>
@endsection
