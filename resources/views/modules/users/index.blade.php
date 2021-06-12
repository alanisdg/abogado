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
                            <a href="{{ $config['routeLink'].'/create' }}" class="btn btn-primary mt-50"> Agregar Usuario</a>
                        </div>
                    </div>
                    <table class="table" id="tableCrud">
                        <thead>
                            <tr>
                                <th>NOMBRE</th>
                                <th>APELLIDO</th>
                                <th>RUT</th>
                                <th>EMAIL</th>
                                <th>CARGO</th>
                                <th>ESTADO</th>
                                <th>OPCIONES</th>
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
                    url: '{{ url("users") }}',
                    data: function (data) {
                        data.first_name = $('input[name=first_name]').val();
                        data.last_name = $('input[name=last_name]').val();
                        data.rut = $('input[name=rut]').val();
                        data.email = $('input[name=email]').val();
                        data.roles = $('input[name=roles]').val();
                        data.status = $('input[name=status]').val();
                    },
                },
                columns: [
                    {data: 'first_name'},
                    {data: 'last_name'},
                    {data: 'rut'},
                    {data: 'email'},
                    {data: 'roles'},
                    {data: 'status'},
                    {defaultContent: ''},
                ],
                createdRow: function(row, data, dataIndex) {
                    tr = '<td class="text-left" style="width: 13%">'+ (data.first_name ? data.first_name : "") +'</td>'
                    tr += '<td class="text-left" style="width: 13%">'+ (data.last_name ? data.last_name : "") + '</td>'
                    tr += '<td class="text-left" style="width: 15%">'+ (data.rut ? data.rut : "") +'</td>'
                    tr += '<td class="text-left" style="width: 19%">'+ (data.email ? data.email : "") +'</td>'
                    tr += '<td class="text-left" style="width: 20%"><span class="bg-info">'+ (data.roles[0].description ? data.roles[0].description : "") +'</span></td>'
                    if (data.status == 1) {
                        tr += '<td class="text-left" style="width: 10%"><span class="bg-info">Activo</span></td>'
                    } else {
                        tr += '<td class="text-left" style="width: 10%"><span class="bg-danger">Inactivo</span></td>'
                    }
                    tr += '<td style="width: 10%">'
                    tr +=   '<div class="pull-right">'
                    tr += 		'<button id="'+data.id+'" title="Actualizar Estado" class="btn btn-sm btn-primary waves-effect waves-float waves-light" style="margin-left:3px;" onclick="updateStatus(this.id);">'
                    tr += 			"<i data-feather='edit'></i>"
                    tr += 		'</button>'
                    tr += 		'<a title="Editar Usuario" href="'+ BASE_URL +'/users/'+data.id+'/edit" class="btn btn-sm btn-primary waves-effect waves-float waves-light" style="margin-left:3px;">'
                    tr += 			"<i data-feather='edit'></i>"
                    tr += 		'</a>'
                    tr += 	'</div>'
                    tr += '</td>'
                    $(row).html(tr)
                }
            });
        });

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
