@extends('layouts.app')

@section('title', $config['moduleName'])

@section('content')
    <section id="basic-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card" style="padding: 15px;">
                    <div class="card-header border-bottom p-1">
                        <div class="head-label">
                            <h4 class="mb-0">Listado General de Contratos y Anexos</h4>
                        </div>
                    </div>
                    <table class="table" id="tableCrud">
                        <thead>
                            <tr>
                                <th>FECHA CONTRATO</th>
                                <th>CLIENTE</th>
                                <th>RUT</th>
                                <th>CODIGO DE ANEXO</th>
                                <th>TOTAL DE CONTRATO</th>
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
                    url: '{{ url("causes/contracts") }}',
                    data: function (data) {
                        data.contract_date = $('input[name=contract_date]').val();
                        data.customer = $('input[name=customer]').val();
                        data.customer = $('input[name=customer]').val();
                        data.annex_code = $('input[name=annex_code]').val();
                        data.total_contract = $('input[name=total_contract]').val();
                    },
                },
                columns: [
                    {data: 'contract_date'},
                    {data: 'customer'},
                    {data: 'customer'},
                    {data: 'annex_code'},
                    {data: 'total_contract'},
                    {defaultContent: ''},
                ],
                createdRow: function(row, data, dataIndex) {
                    tr = '<td class="text-left" style="width: 15%">'+ (data.contract_date ? data.contract_date : "") +'</td>'
                    tr += '<td class="text-left" style="width: 15%">'+ (data.customer.customer ? data.customer.customer : "") +'</td>'
                    tr += '<td class="text-left" style="width: 15%">'+ (data.customer.rut ? data.customer.rut : "") +'</td>'
                    tr += '<td class="text-left" style="width: 15%">'+ (data.annex_code ? data.annex_code : "") +'</td>'
                    tr += '<td class="text-left" style="width: 15%">'+ (data.total_contract ? data.total_contract : "") +'</td>'
                    tr += '<td style="width: 10%">'
                    tr +=   '<div class="pull-right">'
                    tr += 		'<a title="Registro de Causas" href="'+ BASE_URL +'/causes/contracts/record-causes/'+data.id+'" class="" style="margin-left:3px;">'
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
