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
                    </div>
                    <table class="table" id="tableCrud">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>NOMBRE</th>
                                <th>APELLIDO</th>
                                <th>RUT</th>
                                <th>TELEFONO</th>
                                <th>FECHA DE ENTREVISTA</th>
                                <th>ESTADO</th>
                                <th>BOTONES</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection

@section("scripts")
    <script>
        $(document).ready(function (){
            // ejecuta la tabla
            var tableInit = $('#tableCrud').DataTable({
                language: {"url":"//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"},
                responsive: true,
                processing: true,
                serverSide: true,
                lengthChange: false,
                deferRender: true,
                autoWidth: true,
                scrollX: true,
                lengthMenu: false,
                dom: 'Blfrtip',
                buttons: [
                ],
                ajax: {
                    url: '{{ url("list-pending") }}',
                    data: function (data) {
                        data.id = $('input[name=id]').val();
                        data.interview_date = $('input[name=interview_date]').val();
                        data.names = $('input[name=names]').val();
                        data.surnames = $('input[name=surnames]').val();
                        data.rut = $('input[name=rut]').val();
                        data.phone = $('input[name=phone]').val();
                        data.status = $('input[name=status]').val();
                    },
                },
                columns: [
                    {data: 'id'},
                    {data: 'interview_date'},
                    {data: 'names'},
                    {data: 'surnames'},
                    {data: 'rut'},
                    {data: 'phone'},
                    {data: 'status'},
                    {defaultContent: ''},
                ],
                createdRow: function(row, data, dataIndex) {
                    tr = '<td class="text-left" style="width: 6%">'+ (data.id ? data.id : "") +'</td>'
                    tr += '<td class="text-left" style="width: 12%">'+ (data.names ? data.names : "") +'</td>'
                    tr += '<td class="text-left" style="width: 12%">'+ (data.surnames ? data.surnames : "") + '</td>'
                    tr += '<td class="text-left" style="width: 10%">'+ (data.rut ? data.rut : "") +'</td>'
                    tr += '<td class="text-left" style="width: 15%">'+ (data.phone ? data.phone : "") +'</td>'
                    tr += '<td class="text-left" style="width: 15%">'+ (data.interview_date ? data.interview_date : "") +'</td>'
                    if (data.status == 1) {
                        tr += '<td class="text-left" style="width: 15%"><span class="text-warning">PENDIENTE</span></td>'
                    }
                    else if (data.status == 2) {
                        tr += '<td class="text-left" style="width: 15%"><span class="text-success">GANADO</span></td>'
                    }
                    else {
                        tr += '<td class="text-left" style="width: 15%"><span class="text-danger">PERDIDO</span></td>'
                    }
                    tr += '<td style="width: 15%">'
                    tr +=   '<div class="pull-right">'
                    if (data.status == 1) {
                        tr += 		'<a id="'+data.id+'" title="Actualizar Estado" href="#" class="" style="margin-left:3px;" onclick="updateStatus(this.id);">'
                        tr += 			'<img src="../backend/images/assets/update.svg" style="width: 15%">'
                        tr += 		'</a>'
                    }
                    tr += 		'<a title="Detalles" href="'+ BASE_URL +'/list-pending/details/'+data.id+'" class="" style="margin-left:8px;">'
                    tr += 			'<img src="../backend/images/assets/detail.svg" style="width: 15%">'
                    tr += 		'</a>'
                    tr += 	'</div>'
                    tr += '</td>'
                    $(row).html(tr)
                }
            });
        });

        // Update status
            function updateStatus(id) {
                swal({
                    title: "¿Quieres cambiar el estado a Cliente Perdido?",
                    text: "",
                    type: "warning",
                    showCancelButton: !0,
                    confirmButtonText: "¡Si, actualizar estado!",
                    cancelButtonText: "No, cancelar!",
                    reverseButtons: !0
                }).then(function (e) {

                    if (e.value === true) {
                        // Variables
                            let pending_id = id,
                                token = document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                url = '/pending/update-status'

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
                                id: pending_id
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

                    } else {
                        e.dismiss;
                    }

                }, function (dismiss) {
                    return false;
                })
            }

        // Clear localstorage
            document.addEventListener("DOMContentLoaded", function () {
                localStorage.removeItem('customer')
                localStorage.removeItem('cuotes')
                localStorage.removeItem('contract_parameters')
                localStorage.removeItem('current_customer')
            })
    </script>
@endsection
