@extends('backend.layouts.app')

@section('title', __('Zones'))

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
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('State') }}</th>
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
                    url: '{{ url("shipping/zones") }}',
                    data: function (data) {
                        data.name = $('input[name=name]').val();
                        data.state = $('input[name=state]').val();
                        data.type = $('input[name=type]').val();
                    },
                },
                columns: [
                    {data: 'name'},
                    {data: 'state'},
                    {defaultContent: ''},
                ],
                createdRow: function(row, data, dataIndex) {
                    if (data.type == 1) {
                        tr = '<td class="text-left" style="width: 40%; color: #002b5d;">'+ (data.name ? data.name : "") +'</td>'
                    } else {
                        tr = '<td class="text-left" style="width: 40%; color: #ff5f00;">'+ (data.name ? data.name : "") +'</td>'
                    }
                    tr += '<td class="text-left" style="width: 50%">'+ (data.state ? data.state : "") +'</td>'
                    tr += '<td style="width: 10%">'
                    tr +=   '<div class="pull-right">'
                    tr += 		'<a title="{{ __("Edit") }}" href="'+ BASE_URL +'/shipping/zones/edit/'+data.id+'" class="btn btn-sm btn-warning waves-effect waves-float waves-light" style="margin-left:3px;">'
                    tr += 			"{{ __("Edit") }}"
                    tr += 		'</a>'
                    tr += 	'</div>'
                    tr += '</td>'
                    $(row).html(tr)
                }
            });
        });
    </script>
@endsection
