@extends('backend.layouts.app')

@section('title', __('Projects'))

@section('content')
    <section id="basic-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card" style="padding: 15px;">
                    <div class="card-header border-bottom p-1">
                        <div class="head-label">
                            <h4 class="mb-0">{{ __($config['moduleName']) }}</h4>
                        </div>
                        <div class="dt-action-buttons text-right">
                            <div class="dt-buttons d-inline-flex">
                                <a class="dt-button create-new btn btn-primary" href="{{ url($config['routeLink'] . '/create') }}">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus mr-50 font-small-4">
                                            <line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line>
                                        </svg>{{ __('Add New Record') }}
                                    </span>
                                </a>
                              </div>
                        </div>
                    </div>
                    <table class="table" id="tableCrud">
                        <thead>
                            <tr>
                                <th>{{ __('Title') }}</th>
                                <th>{{ __('Description') }}</th>
                                <th>{{ __('Client') }}</th>
                                <th>{{ __('Industry') }}</th>
                                <th>{{ __('Image') }}</th>
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
                    url: '{{ url("projects") }}',
                    data: function (data) {
                        data.title = $('input[name=title]').val();
                        data.description = $('input[name=description]').val();
                        data.client = $('input[name=client]').val();
                        data.industry = $('input[name=industry]').val();
                        data.file_name = $('input[name=file_name]').val();
                    },
                },
                columns: [
                    {data: 'title'},
                    {data: 'description'},
                    {data: 'client'},
                    {data: 'industry'},
                    {data: 'file_name'},
                    {defaultContent: ''},
                ],
                createdRow: function(row, data, dataIndex) {
                    tr = '<td class="text-left" style="width: 20%">'+ (data.title ? data.title : "") +'</td>'
                    tr += '<td class="text-left" style="width: 20%">'+ (data.description ? data.description : "") +'</td>'
                    tr += '<td class="text-left" style="width: 15%">'+ (data.client ? data.client : "") +'</td>'
                    tr += '<td class="text-left" style="width: 20%">'+ (data.industry ? data.industry : "") +'</td>'
                    tr += '<td class="text-left" style="width: 15%"><img height="30" src="'+ BASE_URL +'/backend/images/uploads/projects/'+ (data.file_name ? data.file_name : "") +'"></td>'
                    tr += '<td style="width: 10%">'
                    tr +=   '<div class="pull-right">'
                    tr += 		'<a title="{{ __("Edit Record") }}" href="'+ BASE_URL +'/projects/'+data.id+'/edit" class="btn btn-icon rounded-circle btn-warning waves-effect waves-float waves-light" style="margin-left:3px;">'
                    tr += 			"<i data-feather='edit'></i>"
                    tr += 		'</a>'
                    tr += 		'<a title="{{ __("Delete Record") }}" href="'+ BASE_URL +'/projects/delete/'+data.id+'" class="btn btn-icon rounded-circle btn-danger waves-effect waves-float waves-light" style="margin-left:3px;">'
                    tr += 			"<i data-feather='delete'></i>"
                    tr += 		'</a>'
                    tr += 	'</div>'
                    tr += '</td>'
                    $(row).html(tr)
                }
            });
        });
    </script>
@endsection
