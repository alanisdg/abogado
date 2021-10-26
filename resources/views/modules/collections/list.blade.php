@extends('layouts.app')

@section('title', $config['moduleName'])

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-3"><h5 class="mb-0">Buscar Cliente</h5></div>
            </div>
            <div class="row mt-1">
                <div class="col-3">
                    <input type="text" class="form-control" placeholder="RUT del Cliente" id="customer_rut" autofocus>
                </div>
                <div class="col-1" style="padding-left: 0">
                    <button type="button" class="btn btn-primary" onclick="searchCustomer();"><i data-feather='search'></i></button>
                </div>
                {{--<div class="col-6"><h5 id="dataCliente"></h5></div>--}}
            </div>
            <div class="row mt-1">
                <div class="col-12">
                    <span class="text-danger"> <strong>Nota*: </strong> Por favor ingrese el RUT en el formato correcto.</span>
                </div>
                <div class="col-12">
                    <span class="text-danger"> <strong>Ejemplo: </strong> 16407136-7 o 9407136-1.</span>
                </div>
            </div>
        </div>
    </div>
    <div class="row" id="basic-table">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Cobranzas</h4>
                </div>
                <div class="table-responsive">
                    <table class="table" id="list-collections">
                        <thead>
                            <tr>
                                <th>NRO DE CONTRATO</th>
                                <th>NRO DE CUOTA</th>
                                <th>MONTO ($)</th>
                                <th>FECHA DE PAGO</th>
                                <th>ESTADO</th>
                            </tr>
                        </thead>
                        <tbody id="tbody_list_collections">
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Total</th>
                                <th><span id="totalAmount"></span></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("scripts")
    <script>
        // Clear localstorage
            document.addEventListener("DOMContentLoaded", function () {
                localStorage.removeItem('customer')
                localStorage.removeItem('cuotes')
                localStorage.removeItem('contract_parameters')
                localStorage.removeItem('current_customer')
            })

        // Search data collections from client

        function search(){
            $("#tbody_list_collections").empty();
            let customer_rut = document.getElementById('customer_rut').value,
                        token = document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        url = '/search/collections'
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
                                customer_rut: customer_rut
                            })
                        })
                        .then((response) => response.json())
                        .then((data) => {
                            if (data.collections == null) {
                                toastr["error"]("", "¡No existe un cliente asociado al RUT consultado!")
                            }
                            else {
                                let collections = data.collections,
                                    totalAmount = '0'

                                collections.forEach(collection => {
                                    collection.forEach(element => {
                                        console.log(element)
                                        let amount = element.amount,
                                            num2 = Number(amount.replace(/\./g, ''))

                                        totalAmount = parseFloat(totalAmount) + parseFloat(num2)
                                        if(element.status == 'FINIQUITADO'){
                                            $("#list-collections tbody").append("<tr>" +
                                            `<td id="valueWeigth">${ element.contract_id }</td>` +
                                            `<td id="valueWeigth">${ element.installment_number }</td>` +
                                            `<td id="valueWeigth">${ element.amount }</td>` +
                                            `<td id="valueWeigth">${ (element.payment_date == null) ? "" : element.payment_date }</td>` +
                                            `<td id="valueWeigth">
                                                <a  title="Actualizar Estado" href="#" class="" style="margin-left:3px;" onclick="updateStatus(${ element.id },'${element.status}');">
                                                <img src="../backend/images/assets/update.svg" style="width: 4%">
                                                    </a>
                                                ${ element.status }</td>`
                                        )
                                        }else{
                                            $("#list-collections tbody").append("<tr>" +
                                            `<td id="valueWeigth">${ element.contract_id }</td>` +
                                            `<td id="valueWeigth">${ element.installment_number }</td>` +
                                            `<td id="valueWeigth">${ element.amount }</td>` +
                                            `<td id="valueWeigth">${ (element.payment_date == null) ? "" : element.payment_date }</td>` +
                                            `<td id="valueWeigth">
                                               <a  title="Actualizar Estado" href="#" class="" style="margin-left:3px;" onclick="updateStatus(${ element.id },'${element.status}');">
                                                <img src="../backend/images/assets/update.svg" style="width: 4%">
                                                    </a>
                                                ${ element.status }</td>`
                                        )
                                        }

                                    })
                                });

                                document.getElementById('totalAmount').innerText = parseFloat(totalAmount).toLocaleString('de-DE')
                            }
                        })


        }
            function searchCustomer()
            {
                // Empty table
                    $("#tbody_list_collections").empty();
                    //document.getElementById('dataCliente').innerText = ""
                    //document.getElementById('totalAmount').innerText = ""

                // Variables
                    let customer_rut = document.getElementById('customer_rut').value,
                        token = document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        url = '/search/collections'

                // Fetch
                    if(customer_rut == "") {
                        toastr["error"]("", "¡Ingrese un RUT válido!")
                    }
                    else {
                        search()



                        /*.catch(function(error) {
                            //emptyInputs()
                            //clearVariables()
                            location.reload()

                            toastr["error"]("", "¡Error en la consulta de clientes!")
                        });*/
                    }
            }


            function updateStatus(id,estado) {
                console.log(estado)
                let newState;
                if(estado == 'PENDIENTE')
                {
                     newState = 'PAGADA'
                }
                if(estado == 'FINIQUITADO')
                {
                     newState = 'PAGADA'
                }
                if(estado == 'PAGADA')
                {
                    console.log('fue pagada')
                     newState = 'FINIQUITADO'
                }
                console.log(newState)
                swal({
                    title: "¿Quieres cambiar el estado a "+newState+"?",
                    text: "",
                    type: "warning",
                    showCancelButton: !0,
                    confirmButtonText: "¡Si, actualizar estado!",
                    cancelButtonText: "No, cancelar!",
                    reverseButtons: !0
                }).then(function (e) {
                    console.log( e)
                    if (e.value === true) {
                        // Variables
                            let collection_id = id,
                                token = document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                url = '/collection/update/'+ collection_id

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
                                state: newState
                            })
                        })
                        .then((response) => response.json())
                        .then((data) => {
                            search()
                            console.log(data)




                                toastr["success"]("", "¡Estado actualizado!")


                        })
                        .catch(function(error) {
                            toastr["error"]("", "¡Error en la consulta de datos!")
                        });

                    } else {
                        e.dismiss;
                    }

                }, function (dismiss) {
                    return false;
                })
            }



    </script>
@endsection
