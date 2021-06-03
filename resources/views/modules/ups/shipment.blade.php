@extends('backend.layouts.app')

@section('title',  __('Shipment'))

@section('content')
    <div class="row">
        <div class="col-lg-7 col-md-7 col-7">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ __('Shipment') }}</h4>
                </div>
                <div class="card-body">
                    <form action="" class="form form-vertical" autocomplete="off">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-4">
                                <div class="form-group">
                                    <label for="first-name-icon">{{ __("Postal Code of Origin") }} </label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i data-feather='file-text'></i>
                                            </span>
                                        </div>
                                            <input type="text" name="postal_code_origin" id="postal_code_origin" value="" class="form-control" placeholder="{{ __('Postal Code of Origin') }}" onkeyup = "upperCase(this);">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-4">
                                <div class="form-group">
                                    <label for="first-name-icon">{{ __("Destination Zip Code") }} </label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i data-feather='file-text'></i>
                                            </span>
                                        </div>
                                            <input type="text" name="destination_zip_code" id="destination_zip_code" value="" class="form-control" placeholder="{{ __('Destination Zip Code') }}" onkeyup = "upperCase(this);">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-4">
                                <div class="form-group">
                                    <label for="first-name-icon">{{ __("Weight") }} </label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                lb
                                            </span>
                                        </div>
                                            <input type="number" name="weight" id="weight" value="" class="form-control" placeholder="{{ __('Weight') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-3">
                                <div class="form-group">
                                    <label for="first-name-icon">{{ __("Height") }} </label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                inch
                                            </span>
                                        </div>
                                            <input type="number" name="height" id="height" value="" class="form-control" placeholder="{{ __('Height') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-3">
                                <div class="form-group">
                                    <label for="first-name-icon">{{ __("Width") }} </label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                inch
                                            </span>
                                        </div>
                                            <input type="number" name="width" id="width" value="" class="form-control" placeholder="{{ __('Width') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-3 pr-0">
                                <div class="form-group">
                                    <label for="first-name-icon">{{ __("Length") }} </label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                inch
                                            </span>
                                        </div>
                                            <input type="number" name="length" id="length" value="" class="form-control" placeholder="{{ __('Length') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-1 col-md-1 col-1 pt-2">
                                <button type="button" class="btn btn-primary mr-1 waves-effect waves-float waves-light" onclick="searchTracking()">
                                    <i data-feather='search'></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-5 col-md-5 col-12">
            <div class="card card-payment">
                <div class="card-header">
                    <h4 class="card-title">Cost of Delivery</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6 col-12">
                            <div class="form-group">
                                <label for="first-name-icon">{{ __("Transportation Charges") }} </label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            $
                                        </span>
                                    </div>
                                    <input type="text" id="transportation_charges" class="form-control" placeholder="Transportation Charges" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12">
                            <div class="form-group">
                                <label for="first-name-icon">{{ __("Service Options Charges") }} </label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            $
                                        </span>
                                    </div>
                                    <input type="text" id="service_options_charges" class="form-control" placeholder="Service Options Charges" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="first-name-icon">{{ __("Total Charges") }} </label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            $
                                        </span>
                                    </div>
                                    <input type="text" id="total_charges" class="form-control" placeholder="Total Charges" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://unpkg.com/imask"></script>
    <script>
        var phoneMask = IMask(
            document.getElementById('phone'), {
                mask: '+{00} (000) 000-00-00'
            }
        );

        // Search
            function searchTracking() {

                let url = '/ups/shipment/search';
                let code_origin = document.getElementById('postal_code_origin').value
                let code_destination = document.getElementById('destination_zip_code').value
                let weight = document.getElementById('weight').value
                let height = document.getElementById('height').value
                let width = document.getElementById('width').value
                let length = document.getElementById('length').value
                let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                if(code_origin == "" || code_destination == "" || weight == "" || height == "" || width == "" || length == "") {
                    toastr["error"]("", "¡Debe ingresar todos los parametros del paquete a consultar!")
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
                            code_origin: code_origin,
                            code_destination: code_destination,
                            weight: weight,
                            height: height,
                            width: width,
                            length: length,
                        })
                    })
                    .then((response) => response.json())
                    .then((data) => {
                        document.getElementById("transportation_charges").value = data[0].MonetaryValue
                        document.getElementById("service_options_charges").value = data[1].MonetaryValue

                        let percentage = (data[2].MonetaryValue * data[3]) / 100
                        let totalCost = parseFloat(data[2].MonetaryValue) + parseFloat(percentage)

                        document.getElementById("total_charges").value = totalCost.toFixed(2)
                    })
                    .catch(function(error) {
                        toastr["error"]("", "¡Error en los parametros de consula!")
                    });
                }
            }
    </script>
@endsection
