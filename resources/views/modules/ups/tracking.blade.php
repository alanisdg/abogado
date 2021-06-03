@extends('backend.layouts.app')

@section('title',  __('Tracking'))

@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ __('Tracking') }}</h4>
                </div>
                <div class="card-body">
                    <form action="" class="form form-vertical" autocomplete="off">
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-8">
                                <div class="form-group">
                                    <label for="first-name-icon">{{ __("Reference Code") }} </label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i data-feather='file-text'></i>
                                            </span>
                                        </div>
                                            <input type="text" name="reference_code" id="reference_code" class="form-control" placeholder="{{ __('Reference Code') }}" onkeyup = "upperCase(this);">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-4 pt-2">
                                <button type="button" class="btn btn-primary mr-1 waves-effect waves-float waves-light" onclick="searchTracking()">
                                    <i data-feather='search'></i>
                                    {{ __("Search") }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-12">
            <div class="card card-payment">
                <div class="card-header">
                    <h4 class="card-title">Current location</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group mb-2">
                                <label for="City">City</label>
                                <input type="text" id="city" class="form-control" placeholder="City" readonly>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12">
                            <div class="form-group mb-2">
                                <label for="country_code">Country Code</label>
                                <input type="text" id="country_code" class="form-control" placeholder="Country Code" readonly>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12">
                            <div class="form-group mb-2">
                                <label for="state_provinde_code">State Province Code</label>
                                <input type="text" id="state_provinde_code" class="form-control" placeholder="State Province Code" readonly>
                            </div>
                        </div>
                        <div class="col-12">
                        <div class="form-group mb-2">
                            <label for="date_time">Date / Time</label>
                            <input type="text" id="date_time" class="form-control" placeholder="Date / Time" readonly>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-12">
            <div class="card card-payment">
                <div class="card-header">
                    <h4 class="card-title">Detination</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group mb-2">
                                <label for="City">City</label>
                                <input type="text" id="destination_city" class="form-control" placeholder="City" readonly>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12">
                            <div class="form-group mb-2">
                                <label for="country_code">Country Code</label>
                                <input type="text" id="country_code_destination" class="form-control" placeholder="Country Code" readonly>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12">
                            <div class="form-group mb-2">
                                <label for="state_provinde_code">State Province Code</label>
                                <input type="text" id="state_provinde_code_destination" class="form-control" placeholder="State Province Code" readonly>
                            </div>
                        </div>
                        <div class="col-12">
                        <div class="form-group mb-2">
                            <label for="postal_code">Postal Code</label>
                            <input type="text" id="postal_code" class="form-control" placeholder="Postal Code" readonly>
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

                let url = '/ups/tracking/search';
                let code = document.getElementById('reference_code').value
                let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                if (code == "") {
                    toastr["error"]("", "¡Ingrese un codigo de referencia!")
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
                            code: code,
                        })
                    })
                    .then((response) => response.json())
                    .then((data) => {

                        document.getElementById("city").value = data[0].ActivityLocation.Address.City
                        document.getElementById("country_code").value = data[0].ActivityLocation.Address.CountryCode
                        document.getElementById("state_provinde_code").value = data[0].ActivityLocation.Address.StateProvinceCode
                        document.getElementById("date_time").value = data[0].GMTDate + ' // ' + data[0].GMTTime

                        // Destination
                        document.getElementById("destination_city").value = data[1].Address.City
                        document.getElementById("country_code_destination").value = data[1].Address.CountryCode
                        document.getElementById("state_provinde_code_destination").value = data[1].Address.StateProvinceCode
                        document.getElementById("postal_code").value = data[1].Address.PostalCode
                    })
                    .catch(function(error) {
                        toastr["error"]("", "¡Número de Referencia Inexistente!")
                    });
                }
            }
    </script>
@endsection
