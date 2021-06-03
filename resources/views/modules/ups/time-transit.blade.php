@extends('backend.layouts.app')

@section('title',  __('Time in Transit'))

@section('styles')
    <link rel="stylesheet" href="{{ asset('backend/css/assets/vendors/css/forms/select/select2.min.css') }}">
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-7 col-md-7 col-7">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ __('Time in Transit') }}</h4>
                </div>
                <div class="card-body">
                    <form action="" class="form form-vertical" autocomplete="off">
                        <div class="row">
                            <div class="col-lg-5 col-md-5 col-5">
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
                            <div class="col-lg-5 col-md-5 col-5">
                                <div class="form-group">
                                    <label for="first-name-icon">{{ __("Country Origin Code") }}</label>
                                    <select name="country_origin_code" id="country_origin_code" class="select2 form-control form-control-lg" required>
                                        <option value="">Seleccione...</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->iso }}">
                                                {{ $country->name.' ('.$country->iso.')' }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-5 col-md-5 col-5">
                                <div class="form-group">
                                    <label for="first-name-icon">{{ __("Destination Zip Code") }} </label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i data-feather='file-text'></i>
                                            </span>
                                        </div>
                                            <input type="text" name="destination_zip_code" id="destination_zip_code" value="" class="form-control" placeholder="{{ __('Postal Code of Origin') }}" onkeyup = "upperCase(this);">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-5 col-5">
                                <div class="form-group">
                                    <label for="first-name-icon">{{ __("Destination Zip Code") }}</label>
                                    <select name="destination_country_code" id="destination_country_code" class="select2 form-control form-control-lg" required>
                                        <option value="">Seleccione...</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->iso }}">
                                                {{ $country->name.' ('.$country->iso.')' }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-1 col-md-1 col-1 pt-2">
                                <button type="button" class="btn btn-primary mr-1 waves-effect waves-float waves-light" onclick="calculateTime()">
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
    <script src="{{ asset('backend/js/vendors/forms/select/select2.full.min.js') }}"></script>
    <script src="{{ asset('backend/js/scripts/forms/form-select2.min.js') }}"></script>
    <script src="https://unpkg.com/imask"></script>
    <script>
        var phoneMask = IMask(
            document.getElementById('phone'), {
                mask: '+{00} (000) 000-00-00'
            }
        );

        // Search
            function calculateTime() {

                let url = '/ups/time-transit/search';
                let postal_code_origin = document.getElementById('postal_code_origin').value
                let country_origin_code = document.getElementById('country_origin_code').value
                let destination_zip_code = document.getElementById('destination_zip_code').value
                let destination_country_code = document.getElementById('destination_country_code').value
                let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');


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
                            postal_code_origin: postal_code_origin,
                            country_origin_code: country_origin_code,
                            destination_zip_code: destination_zip_code,
                            destination_country_code: destination_country_code
                        })
                    })
                    .then((response) => response.json())
                    .then((data) => {
                        console.log(data)
                        //document.getElementById("transportation_charges").value = data[0].MonetaryValue
                        //document.getElementById("service_options_charges").value = data[1].MonetaryValue
                    })
                    .catch(function(error) {
                        toastr["error"]("", "¡Error en los parametros de consula!")
                    });
            }
    </script>
@endsection
