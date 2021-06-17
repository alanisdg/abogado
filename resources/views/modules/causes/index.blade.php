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
                            <a href="{{ url('causes/add') }}" class="btn btn-primary mt-50"> Agregar Causa</a>
                        </div>
                    </div>
                    <table class="table" id="tableCrud">
                        <thead>
                            <tr>
                                <th>FECHA CONTRATO</th>
                                <th>NUMERO DE RIT</th>
                                <th>CORTE</th>
                                <th>MATERIA</th>
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
                    url: '{{ url("causes/list") }}',
                    data: function (data) {
                        data.contract = $('input[name=contract]').val();
                        data.number_rit = $('input[name=number_rit]').val();
                        data.court = $('input[name=court]').val();
                        data.matter = $('input[name=matter]').val();
                        data.status = $('input[name=status]').val();
                    },
                },
                columns: [
                    {data: 'contract'},
                    {data: 'number_rit'},
                    {data: 'court'},
                    {data: 'matter'},
                    {data: 'status'},
                    {defaultContent: ''},
                ],
                createdRow: function(row, data, dataIndex) {
                    tr = '<td class="text-left" style="width: 15%">'+ (data.contract.contract_date ? data.contract.contract_date : "") +'</td>'
                    tr += '<td class="text-left" style="width: 15%">'+ (data.number_rit ? data.number_rit : "") + '</td>'
                    tr += '<td class="text-left" style="width: 20%">'+ (data.court ? data.court : "") +'</td>'
                    tr += '<td class="text-left" style="width: 25%">'+ (data.matter ? data.matter : "") +'</td>'
                    if (data.status == 1) {
                        tr += '<td class="text-left" style="width: 10%"></td>'
                    } else {
                        tr += '<td class="text-left" style="width: 10%"></td>'
                    }
                    tr += '<td style="width: 10%">'
                    tr +=   '<div class="pull-right">'
                    tr += 		'<a title="Tareas" href="#" class="" style="margin-left:3px;">'
                    tr += 			'<img src="../backend/images/assets/homework.svg" style="width: 25%">'
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
