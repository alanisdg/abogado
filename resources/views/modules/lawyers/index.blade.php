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
                            <a href="{{ $config['routeLink'].'/create' }}" class="btn btn-primary mt-50"> Agregar Abogado</a>
                        </div>
                    </div>
                    <table class="table" id="tableCrud">
                        <thead>
                            <tr>
                                <th>RUT</th>
                                <th>ABOGADO</th>
                                <th>CARGO</th>
                                <th>ACCIONES</th>
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
                    url: '{{ url("lawyers") }}',
                    data: function (data) {
                        data.lawyer_rut = $('input[name=lawyer_rut]').val();
                        data.lawyer_first_name = $('input[name=lawyer_first_name]').val();
                        data.lawyer_last_name = $('input[name=lawyer_last_name]').val();
                        data.charge = $('input[name=charge]').val();
                    },
                },
                columns: [
                    {data: 'lawyer_rut'},
                    {data: 'lawyer_first_name'},
                    {data: 'charge'},
                    {defaultContent: ''},
                ],
                createdRow: function(row, data, dataIndex) {
                    tr = '<td class="text-left" style="width: 20%">'+ (data.lawyer_rut ? data.lawyer_rut : "") +'</td>'
                    tr += '<td class="text-left" style="width: 40%">'+ (data.lawyer_first_name ? data.lawyer_first_name : "") + ' ' + (data.lawyer_last_name ? data.lawyer_last_name : "") +'</td>'
                    tr += '<td class="text-left" style="width: 20%">'+ (data.charge ? data.charge : "") +'</td>'
                    tr += '<td style="width: 20%">'
                    tr +=   '<div class="pull-right">'
                    tr += 		'<a title="Editar" href="'+ BASE_URL +'/lawyers/'+data.id+'/edit" class="btn btn-sm btn-warning waves-effect waves-float waves-light" style="margin-left:3px;">'
                    tr += 			"Editar"
                    tr += 		'</a>'
                    tr += 	'</div>'
                    tr += '</td>'
                    $(row).html(tr)
                }
            });
        });
    </script>
@endsection
