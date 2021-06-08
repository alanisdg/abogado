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
                            <a href="{{ $config['routeLink'].'/create' }}" class="btn btn-primary mt-50"> Agregar Cliente</a>
                        </div>
                    </div>
                    <table class="table" id="tableCrud">
                        <thead>
                            <tr>
                                <th>RUT</th>
                                <th>CLIENTE</th>
                                <th>DIRECCION</th>
                                <th>CORREO ELECTRONICO</th>
                                <th>TELEFONO</th>
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
                    url: '{{ url("customers") }}',
                    data: function (data) {
                        data.rut = $('input[name=rut]').val();
                        data.first_name = $('input[name=first_name]').val();
                        data.last_name = $('input[name=last_name]').val();
                        data.address = $('input[name=address]').val();
                        data.email = $('input[name=email]').val();
                        data.phone = $('input[name=phone]').val();
                    },
                },
                columns: [
                    {data: 'rut'},
                    {data: 'first_name'},
                    {data: 'address'},
                    {data: 'email'},
                    {data: 'phone'},
                    {defaultContent: ''},
                ],
                createdRow: function(row, data, dataIndex) {
                    tr = '<td class="text-left" style="width: 15%">'+ (data.rut ? data.rut : "") +'</td>'
                    tr += '<td class="text-left" style="width: 20%">'+ (data.first_name ? data.first_name : "") + ' ' + (data.last_name ? data.last_name : "") +'</td>'
                    tr += '<td class="text-left" style="width: 25%">'+ (data.address ? data.address : "") +'</td>'
                    tr += '<td class="text-left" style="width: 15%">'+ (data.email ? data.email : "") +'</td>'
                    tr += '<td class="text-left" style="width: 15%">'+ (data.phone ? data.phone : "") +'</td>'
                    tr += '<td style="width: 10%">'
                    tr +=   '<div class="pull-right">'
                    tr += 		'<a title="Editar" href="'+ BASE_URL +'/customers/'+data.id+'/edit" class="btn btn-sm btn-warning waves-effect waves-float waves-light" style="margin-left:3px;">'
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
