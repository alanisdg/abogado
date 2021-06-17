@extends('layouts.app')

@if ($typeForm == 'create')
    @section('title', $config['add'])
@else
    @section('title', $config['edit'])
@endif


@section('content')
    <div class="">
        <div class="card-header">
            @if ($typeForm == 'create')
                <h2 class="card-title">{{ $config['add'] }}</h2>
            @else
                <h4 class="card-title">{{ $config['edit'] }}</h4>
            @endif
        </div>
    </div>
    <section class="horizontal-wizard">
        <div class="bs-stepper horizontal-wizard-example linear">
            <div class="bs-stepper-header">
                <div class="step active" data-target="#customers">
                    <button type="button" class="step-trigger" aria-selected="true">
                        <span class="bs-stepper-box">1</span>
                        <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Cliente</span>
                        {{--<span class="bs-stepper-subtitle">Setup Account Details</span>--}}
                        </span>
                    </button>
                </div>
                <div class="line">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right font-medium-2"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </div>
                <div class="step" data-target="#type-contract">
                    <button type="button" class="step-trigger" aria-selected="false" disabled="disabled">
                        <span class="bs-stepper-box">2</span>
                        <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Tipo de Contrato</span>
                        {{--<span class="bs-stepper-subtitle">Add Personal Info</span>--}}
                        </span>
                    </button>
                </div>
                <div class="line">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right font-medium-2"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </div>
                <div class="step" data-target="#address-step">
                    <button type="button" class="step-trigger" aria-selected="false" disabled="disabled">
                        <span class="bs-stepper-box">3</span>
                        <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Parametrización</span>
                        {{--<span class="bs-stepper-subtitle">Add Address</span>--}}
                        </span>
                    </button>
                </div>
                <div class="line">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right font-medium-2"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </div>
                <div class="step" data-target="#social-links">
                    <button type="button" class="step-trigger" aria-selected="false" disabled="disabled">
                        <span class="bs-stepper-box">4</span>
                        <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Confirmación</span>
                        {{--<span class="bs-stepper-subtitle">Add Social Links</span>--}}
                        </span>
                    </button>
                </div>
            </div>
          <div class="bs-stepper-content">
            <div id="customers" class="content active dstepper-block">
                <div class="content-header">
                    <div class="row">
                        <div class="col-3"><h5 class="mb-0">Buscar Cliente</h5></div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-3">
                            <input type="text" class="form-control" placeholder="RUT del Cliente" id="customer_rut">
                        </div>
                        <div class="col-1" style="padding-left: 0">
                            <button class="btn btn-primary" onclick="searchCustomer();"><i data-feather='search'></i></button>
                        </div>
                    </div>
                </div>
                <form class="mt-3">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="form-label" for="customer">Cliente</label>
                            <input type="text" name="name_customer" id="name_customer" class="form-control" onkeyup = "upperCase(this);">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="customer">Estado Civil</label>
                            <input type="text" name="civil_status" id="civil_status" class="form-control" onkeyup = "upperCase(this);">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="form-label" for="rut">RUT</label>
                            <input type="text" name="rut" id="rut" class="form-control" onkeyup = "upperCase(this);">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="profession">Profesión</label>
                            <input type="text" name="profession" id="profession" class="form-control" onkeyup = "upperCase(this);">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="form-label" for="nationality">Nacionalidad</label>
                            <input type="text" name="nationality" id="nationality" class="form-control" onkeyup = "upperCase(this);">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="customer">Dirección</label>
                            <input type="text" name="address" id="address" class="form-control" onkeyup = "upperCase(this);">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="form-label" for="phone">Teléfono</label>
                            <input type="text" name="phone" id="phone" class="form-control" onkeyup = "upperCase(this);">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="commune">Comuna</label>
                            <input type="text" name="commune" id="commune" class="form-control" onkeyup = "upperCase(this);">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="form-label" for="email">Email</label>
                            <input type="text" name="email" id="email" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="region">Región</label>
                            <input type="text" name="region" id="region" class="form-control" onkeyup = "upperCase(this);">
                        </div>
                    </div>
                </form>
                <div class="d-flex justify-content-between">
                    <button class="btn btn-primary btn-next waves-effect waves-float waves-light" onclick="storeCustomer();">
                        <span class="align-middle d-sm-inline-block d-none">Siguiente</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right align-middle ml-sm-25 ml-0"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                    </button>
                    {{--<a href="{{ url('contract/create/type-contract') }}" class="btn btn-primary btn-next waves-effect waves-float waves-light">
                        <span class="align-middle d-sm-inline-block d-none">Siguiente</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right align-middle ml-sm-25 ml-0"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                    </a>--}}
                </div>
            </div>
          </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="https://unpkg.com/imask"></script>
    <script>
        // Rut
            var phoneMask = IMask(
                document.getElementById('customer_rut'), {
                    mask: '000000000-0'
                }
            );

            var phoneMask = IMask(
                document.getElementById('rut'), {
                    mask: '000000000-0'
                }
            );

        // Search customer
            function searchCustomer() {

                let url = '/contract/create/search-customer';
                window.localStorage.removeItem('customer_rut');

                let customer_rut = document.getElementById('customer_rut').value
                let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

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
                        if (data == 2) {
                            emptyInputs()
                            clearVariables()

                            toastr["error"]("", "¡No existe un Cliente asociado al RUT consultado!")
                        }
                        else {

                            let customer = [
                                data.first_name,
                                data.last_name,
                                data.civil_status,
                                data.rut,
                                data.profession,
                                data.nationality,
                                data.address,
                                data.phone,
                                data.commune,
                                data.email,
                                data.region,
                            ]

                            localStorage.setItem('customer_rut', data.rut)
                            localStorage.setItem('customer', JSON.stringify(customer))

                            document.getElementById("customer").value = data.first_name+ ' ' +data.last_name
                            document.getElementById("civil_status").value = data.civil_status
                            document.getElementById("rut").value = data.rut
                            document.getElementById("profession").value = data.profession
                            document.getElementById("nationality").value = data.nationality
                            document.getElementById("address").value = data.address
                            document.getElementById("phone").value = data.phone
                            document.getElementById("commune").value = data.commune
                            document.getElementById("email").value = data.email
                            document.getElementById("region").value = data.region
                        }
                    })
                    .catch(function(error) {
                        //emptyInputs()
                        clearVariables()
                        location.reload()

                        toastr["error"]("", "¡Error en la consulta de clientes!")
                    });
                }
            }

        // Search customer with function onload, from variblae current customer rut
            document.addEventListener("DOMContentLoaded", function () {
                // Get current customer variable
                    let current_customer = localStorage.getItem('current_customer')

                    if (current_customer == null) {
                        emptyInputs()
                        localStorage.removeItem('customer')
                        localStorage.removeItem('current_customer')
                    }
                    else {

                        let current_customer = JSON.parse(localStorage.getItem('current_customer'))

                        document.getElementById("name_customer").value = current_customer[0]
                        document.getElementById("civil_status").value = current_customer[1]
                        document.getElementById("rut").value = current_customer[2]
                        document.getElementById("profession").value = current_customer[3]
                        document.getElementById("nationality").value = current_customer[4]
                        document.getElementById("address").value = current_customer[5]
                        document.getElementById("phone").value = current_customer[6]
                        document.getElementById("commune").value = current_customer[7]
                        document.getElementById("email").value = current_customer[8]
                        document.getElementById("region").value = current_customer[9]
                    }
            })

        // Capture data
            function storeCustomer() {

                let current_customer = localStorage.getItem('current_customer')

                // Si no existen datos en localstorage actualmente, se crea una nueva variable
                if (current_customer == null) {
                    let dataCustomer = [
                        document.getElementById("name_customer").value,
                        document.getElementById("civil_status").value,
                        document.getElementById("rut").value,
                        document.getElementById("profession").value,
                        document.getElementById("nationality").value,
                        document.getElementById("address").value,
                        document.getElementById("phone").value,
                        document.getElementById("commune").value,
                        document.getElementById("email").value,
                        document.getElementById("region").value,
                    ]

                    localStorage.setItem('customer', JSON.stringify(dataCustomer))
                    window.location.href = "/contract/create/type-contract";
                }
                else { // Se actualiza la el arreglo actual
                    let dataCustomer = [
                        document.getElementById("name_customer").value,
                        document.getElementById("civil_status").value,
                        document.getElementById("rut").value,
                        document.getElementById("profession").value,
                        document.getElementById("nationality").value,
                        document.getElementById("address").value,
                        document.getElementById("phone").value,
                        document.getElementById("commune").value,
                        document.getElementById("email").value,
                        document.getElementById("region").value,
                    ]

                    localStorage.setItem('customer', JSON.stringify(dataCustomer))
                    window.location.href = "/contract/create/type-contract";
                }
            }

        // Empty inputs
            function emptyInputs()
            {
                document.getElementById("customer_rut").value = ""
                document.getElementById("civil_status").value = ""
                document.getElementById("rut").value = ""
                document.getElementById("profession").value = ""
                document.getElementById("nationality").value = ""
                document.getElementById("address").value = ""
                document.getElementById("phone").value = ""
                document.getElementById("commune").value = ""
                document.getElementById("email").value = ""
                document.getElementById("region").value = ""
            }

        // Clear variables
            function clearVariables() {
                localStorage.removeItem('customer')
                localStorage.removeItem('cuotes')
                localStorage.removeItem('contract_parameters')
                localStorage.removeItem('current_customer')
            }
    </script>
@endsection
