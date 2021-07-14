@extends('layouts.app')

@section('title', 'Listado de Contratos')

@section('content')
    <section id="basic-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card" style="padding: 15px;">
                    <div class="card-header border-bottom p-1">
                        <div class="head-label">
                            <h4 class="mb-0">Listado de Contratos</h4>
                        </div>
                        <div class="dt-buttons btn-group flex-wrap">
                            <a href="{{ url('contract/create/customer') }}" class="btn btn-primary mt-50"> Nuevo Contrato</a>
                        </div>
                    </div>
                    <table class="table" id="tableCrud">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Usuario</th>
                                <th>Cliente</th>
                                <th>Contrato</th>
                                <th>Opciones</th>
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
                    url: '{{ url("list-contracts/list") }}',
                    data: function (data) {
                        data.contract_date = $('input[name=contract_date]').val();
                        data.user = $('input[name=user]').val();
                        data.customer = $('input[name=customer]').val();
                        data.type_contract = $('input[name=type_contract]').val();
                    },
                },
                columns: [
                    {data: 'contract_date'},
                    {data: 'user'},
                    {data: 'customer'},
                    {data: 'type_contract'},
                    {defaultContent: ''},
                ],
                createdRow: function(row, data, dataIndex) {
                    tr = '<td class="text-left" style="width: 10%">'+ (data.contract_date ? data.contract_date : "") +'</td>'
                    tr += '<td class="text-left" style="width: 20%">'+ (data.user.first_name ? data.user.first_name : "") + ' ' + (data.user.last_name ? data.user.last_name : "") + '</td>'
                    tr += '<td class="text-left" style="width: 20%">'+ (data.customer.customer ? data.customer.customer : "") +'</td>'
                    tr += '<td class="text-left" style="width: 35%">'+ (data.type_contract ? data.type_contract : "") +'</td>'
                    tr += '<td style="width: 15%">'
                    tr +=   '<div class="pull-right">'
                    tr += 		'<a title="Editar Detalles" href="'+ BASE_URL +'/contract/edit/'+data.id+'" class="" style="margin-left:8px;">'
                    tr += 			'<img src="../backend/images/assets/edit.svg" style="width: 15%">'
                    tr += 		'</a>'
                    tr += 		'<a title="Anexos" href="'+ BASE_URL +'/list-contracts/annexes/'+data.id+'" class="" style="margin-left:3px;">'
                    tr += 			'<img src="../backend/images/assets/attach.png" style="width: 15%">'
                    tr += 		'</a>'
                    tr += 		'<a title="Finiquito" href="" class="" style="margin-left:8px;">'
                    tr += 			'<img src="../backend/images/assets/handshake.svg" style="width: 15%">'
                    tr += 		'</a>'
                    tr += 		'<a title="Actualizar" href="'+ BASE_URL +'/contract/actualize/'+data.id+'" class="" style="margin-left:8px;">'
                    tr += 			'<img src="../backend/images/assets/update.svg" style="width: 15%">'
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
