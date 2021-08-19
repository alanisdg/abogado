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
                                        @if ($item->status == 1)
                                            <a href="{{ url('annexes/creditors/'.$item->id) }}"><img src="{{ asset('backend/images/assets/group.svg') }}" alt="" title="Acreedores" width="25"></a>

                                            <a style="margin-left: 3px;" href="{{ url('list-contracts/annexes/edit/'.$item->id) }}"><img src="{{ asset('backend/images/assets/edit.svg') }}" alt="" title="Editar Anexo" width="25"></a>

                                            <a style="margin-left: 3px;" href="{{ url('contract/actualize/'.$item->id) }}"><img src="{{ asset('backend/images/assets/update.svg') }}" alt="" title="Actualizaciones" width="25"></a>

                                            <a style="margin-left: 3px;" title="Finiquitar Contrato" onclick="terminateContract({{ $item->id }})"><img src="{{ asset('backend/images/assets/handshake.svg') }}" width="25"></a>
                                        @endif

                                        <a style="margin-left: 3px;" href="{{ url('contract/print/'.$item->id) }}"><img src="{{ asset('backend/images/assets/print.svg') }}" alt="" title="Imprimir Contrato" width="25"></a>
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

        // Terminate contract
        function terminateContract(id) {
                swal({
                    title: "¿Desea finiquitar el contrato?",
                    text: "",
                    type: "warning",
                    showCancelButton: !0,
                    confirmButtonText: "¡Si, finiquitar contracto!",
                    cancelButtonText: "No, cancelar!",
                    reverseButtons: !0
                }).then(function (e) {

                    if (e.value === true) {
                        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                        let userId = id
                        let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                        let url = '/contract/setle';

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
                                id: id
                            })
                        })
                        .then((response) => response.json())
                        .then((data) => {

                            if (data == 200) {
                                toastr["success"]("", "¡Contrato finiquitado!")

                                setTimeout(function(){
                                    window.location.reload(1);
                                }, 4000);
                            }
                            else if(data == 404) {
                                toastr["error"]("", "¡Aún hay Cuotas pendientes por pagar para la fecha actual!")
                            }
                            else {
                                toastr["error"]("", "¡Error en la finiquitación del contrato!")
                            }

                        })
                        .catch(function(error) {
                            toastr["error"]("", "¡Error en la consulta de datos!")
                        });

                    } else {
                        e.dismiss;
                    }

                }, function (dismiss) {
                    return false;
                })
            }
    </script>
@endsection
