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
                <div class="col-6"><h5 id="dataCliente"></h5></div>
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
    <script src="https://unpkg.com/imask"></script>
    <script>
         // Rut
            var phoneMask = IMask(
                document.getElementById('customer_rut'), {
                    mask: '000000000-0'
                }
            );

        // Clear localstorage
            document.addEventListener("DOMContentLoaded", function () {
                localStorage.removeItem('customer')
                localStorage.removeItem('cuotes')
                localStorage.removeItem('contract_parameters')
                localStorage.removeItem('current_customer')
            })

        // Search data collections from client
            function searchCustomer()
            {
                // Empty table
                    $("#tbody_list_collections").empty();
                    document.getElementById('dataCliente').innerText = ""
                // Variables
                    let customer_rut = document.getElementById('customer_rut').value,
                        token = document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        url = '/search/collections'

                // Fetch
                    if(customer_rut == "") {
                        toastr["error"]("", "¡Ingrese un RUT válido!")
                    }
                    else {
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
                            let collections = data.collections.contracts[0].collections,
                                totalAmount = '0,0'

                            collections.forEach(element => {

                                let amount = element.amount,
                                    num2 = Number(amount.replace(/[^0-9\.]+/g,""))

                                totalAmount = parseFloat(totalAmount) + parseFloat(num2)

                                $("#list-collections tbody").append("<tr>" +
                                    `<td id="valueWeigth">${ element.installment_number }</td>` +
                                    `<td id="valueWeigth">${ element.amount }</td>` +
                                    `<td id="valueWeigth">${ (element.payment_date == null) ? "" : element.payment_date }</td>` +
                                    `<td id="valueWeigth">${ element.status }</td>`
                                )
                            });

                            document.getElementById('totalAmount').innerText = String(totalAmount).replace(/(.)(?=(\d{3})+$)/g,'$1,')
                            document.getElementById('dataCliente').innerText = "Cliente: " + data.collections.customer + "|| Email: " + data.collections.email + "|| Teléfono: " + data.collections.phone
                        })
                        /*.catch(function(error) {
                            //emptyInputs()
                            //clearVariables()
                            location.reload()

                            toastr["error"]("", "¡Error en la consulta de clientes!")
                        });*/
                    }
            }
    </script>
@endsection
