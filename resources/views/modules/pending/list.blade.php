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
                    <div class="dropdown">
                        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Contratos por Estado
                        </a>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="/list-pending">Todos</a>
                            <a class="dropdown-item" href="?id=1">Pendientes</a>
                          <a class="dropdown-item" href="?id=2">Ganados</a>
                          <a class="dropdown-item" href="?id=3">Perdidos</a>
                          <a class="dropdown-item" href="?id=4">Duda</a>
                        </div>
                      </div>
                    <table class="table" id="tableCrud">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>NOMBRE</th>
                                <th>RUT</th>
                                <th>TELEFONO</th>
                                <th>ORIGEN</th>
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

            getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return typeof sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
    }
    return false;
};


            var get = getUrlParameter('id');

            var tableInit = $('#tableCrud').DataTable({
                language: {"url":"//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"},
                responsive: true,
                processing: true,
                serverSide: true,
                lengthChange: false,
                drawCallback: function( settings ) {
                    updateStatusButton()
                },
                deferRender: true,
                autoWidth: true,
                scrollX: true,
                lengthMenu: false,
                dom: 'Blfrtip',
                order:[],
                buttons: [
                ],
                ajax: {

                    url: '/list-pending?id='+get,
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
                    {data: 'rut'},
                    {data: 'phone'},
                    {data: 'origen'},
                    {data: 'status'},

                    {defaultContent: ''},
                ],




                createdRow: function(row, data, dataIndex) {
                    tr = '<td class="text-left" style="width: 6%">'+ (data.id ? data.id : "") +'</td>'
                    tr += '<td class="text-left" style="width: 12%">'+ (data.names ? data.names : "") +'</td>'
                     tr += '<td class="text-left" style="width: 10%">'+ (data.rut ? data.rut : "") +'</td>'
                    tr += '<td class="text-left" style="width: 15%">'+ (data.phone ? data.phone : "") +'</td>'
                    name=''
                    if(data.origen == 1){
                        name = 'Instagram'
                    }
                    if(data.origen == 2){
                        name = 'Facebook'
                    }
                    if(data.origen == 3){
                        name = 'Llamadas'
                    }
                    if(data.origen == 4){
                        name = 'Email'
                    }
                    if(data.origen == 5){
                        name = 'Mensaje de texto'
                    }
                    if(data.origen == 6){
                        name = 'Campa??a Presencial'
                    }
                    tr += '<td class="text-left" style="width: 15%">'+ name +'</td>'
                    tr += '<td class="text-left" style="width: 15%">'+ (data.interview_date ? data.interview_date : "") +'</td>'
                    if (data.status == 1) {
                        tr += '<td class="text-left" style="width: 15%"><span class="text-warning">PENDIENTE</span></td>'
                    }
                    else if (data.status == 2) {
                        tr += '<td class="text-left" style="width: 15%"><span class="text-success">GANADO</span></td>'
                    }
                    else if (data.status == 4) {
                        tr += '<td class="text-left" style="width: 15%"><span class="text-success">DUDA</span></td>'
                    }
                    else {
                        tr += '<td class="text-left" style="width: 15%"><span class="text-danger">PERDIDO</span></td>'
                    }
                    tr += '<td style="width: 15%">'
                    tr +=   '<div class="pull-right">'
                        tr += '<div class="dropdown"><button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">Estado</button><div class="dropdown-menu" aria-labelledby="dropdownMenuButton"><a class="dropdown-item duda" state="4" ide="'+data.id+'"  >Duda</a><a class="dropdown-item duda" state="1" ide="'+data.id+'" >Pendiente</a><a class="dropdown-item duda" state="2" ide="'+data.id+'" >Ganado</a><a class="dropdown-item duda" state="3" ide="'+data.id+'" >Perdido</a></div></div>'



                    tr += 		'<a title="Detalles" href="'+ BASE_URL +'/list-pending/details/'+data.id+'" class="" style="margin-left:8px;">'
                    tr += 			'<img src="../backend/images/assets/detail.svg" style="width: 15%">'
                    tr += 		'</a>'
                    tr += 	'</div>'
                    tr += '</td>'
                    $(row).html(tr)
                },
                "initComplete": function () {
                    updateStatusButton()

                }
            });


        });

        // Update status

        function updateStatusButton(){
            $('.duda').click(function(){
                        id = $(this).attr("ide")
                        state = $(this).attr("state")
                        console.log(state)
                        if(state == 1){
                            name = 'PENDIENTE'

                        }
                        if(state == 2){
                            name = 'GANADO'

                        }

                        if(state == 4){
                            name = 'DUDA'

                        }
                        if(state == 3){
                            name = 'PERDIDO'

                        }
                        swal({
                    title: "??Quieres cambiar el estado a "+name+"?",
                    text: "",
                    type: "warning",
                    showCancelButton: !0,
                    confirmButtonText: "??Si, actualizar estado!",
                    cancelButtonText: "No, cancelar!",
                    reverseButtons: !0
                }).then(function (e) {
                    console.log(id + ' ' + state)
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
                                id: pending_id,
                                status:state
                            })
                        })
                        .then((response) => response.json())
                        .then((data) => {

                            if (data == 1) {

                                $('#tableCrud').DataTable().ajax.reload(function(){
                                    updateStatusButton()
                                });

                                toastr["success"]("", "??Estado actualizado!")
                            } else {
                                toastr["error"]("", "??Error en la acutalizaci??n del estado!")
                            }

                        })
                        .catch(function(error) {
                            toastr["error"]("", "??Error en la consulta de datos!")
                        });

                    } else {
                        e.dismiss;
                    }

                }, function (dismiss) {
                    return false;
                })

                    })
        }
            function updateStatus(id,status) {
                console.log(status)
                console.log(id)

                let state
                if(status == 1){
                    status = 'GANADO'
                    state = 2
                }
                if(status == 2){
                    status = 'DUDA'
                    state = 4
                }

                if(status == 4){
                    status = 'PERDIDO'
                    state = 3
                }
                if(status == 3){
                    status = 'GANADO'
                    state = 1
                }
                swal({
                    title: "??Quieres cambiar el estado a "+status+"?",
                    text: "",
                    type: "warning",
                    showCancelButton: !0,
                    confirmButtonText: "??Si, actualizar estado!",
                    cancelButtonText: "No, cancelar!",
                    reverseButtons: !0
                }).then(function (e) {
                    console.log(id + ' ' + state)
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
                                id: pending_id,
                                status:state
                            })
                        })
                        .then((response) => response.json())
                        .then((data) => {

                            if (data == 1) {

                                $('#tableCrud').DataTable().ajax.reload();

                                toastr["success"]("", "??Estado actualizado!")
                            } else {
                                toastr["error"]("", "??Error en la acutalizaci??n del estado!")
                            }

                        })
                        .catch(function(error) {
                            toastr["error"]("", "??Error en la consulta de datos!")
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
