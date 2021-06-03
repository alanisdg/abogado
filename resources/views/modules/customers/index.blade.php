@extends('backend.layouts.app')

@section('title', __('Customers'))

@section('content')
    <section id="basic-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card" style="padding: 15px;">
                    <div class="card-header border-bottom p-1">
                        <div class="head-label">
                            <h4 class="mb-0">{{ __($config['moduleName']) }}</h4>
                        </div>
                    </div>
                    <table class="table" id="tableCrud">
                        <thead>
                            <tr>
                                <th>{{ __('DNI') }}</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Surname') }}</th>
                                <th>{{ __('Email') }}</th>
                                <th>{{ __('Phone') }}</th>
                                <th>{{ __('Options') }}</th>
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
                        data.dni = $('input[name=dni]').val();
                        data.name = $('input[name=name]').val();
                        data.surname = $('input[name=surname]').val();
                        data.email = $('input[name=email]').val();
                        data.phone = $('input[name=phone]').val();
                    },
                },
                columns: [
                    {data: 'dni'},
                    {data: 'name'},
                    {data: 'surname'},
                    {data: 'email'},
                    {data: 'phone'},
                    {defaultContent: ''},
                ],
                createdRow: function(row, data, dataIndex) {
                    tr = '<td class="text-left" style="width: 10%">'+ (data.dni ? data.dni : "") +'</td>'
                    tr += '<td class="text-left" style="width: 15%">'+ (data.name ? data.name : "") +'</td>'
                    tr += '<td class="text-left" style="width: 15%">'+ (data.surname ? data.surname : "") +'</td>'
                    tr += '<td class="text-left" style="width: 15%">'+ (data.email ? data.email : "") +'</td>'
                    tr += '<td class="text-left" style="width: 15%">'+ (data.phone ? data.phone : "") +'</td>'
                    tr += '<td style="width: 10%">'
                    tr +=   '<div class="pull-right">'
                    tr += 		'<a title="{{ __("Details") }}" href="'+ BASE_URL +'/customers/details/'+data.id+'" class="btn btn-sm btn-info waves-effect waves-float waves-light" style="margin-left:3px;">'
                    tr += 			"{{ __("Details") }}"
                    tr += 		'</a>'
                    tr += 	'</div>'
                    tr += '</td>'
                    $(row).html(tr)
                }
            });
        });
    </script>
@endsection
