<script src="{{ asset('backend/js/vendors/vendors.min.js') }}"></script>
{{--<script src="{{ asset('backend/js/vendors/charts/apexcharts.min.js') }}"></script>--}}
<script src="{{ asset('backend/js/vendors/extensions/toastr.min.js') }}"></script>

<script src="{{ asset('backend/js/vendors/tables/datatable/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/js/vendors/tables/datatable/datatables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('backend/js/vendors/forms/wizard/bs-stepper.min.js') }}"></script>
{{--<script src="{{ asset('backend/js/vendors/tables/datatable/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('backend/js/vendors/tables/datatable/responsive.bootstrap4.js') }}"></script>--}}

<script src="{{ asset('backend/js/vendors/forms/validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('backend/js/core/app-menu.min.js') }}"></script>
<script src="{{ asset('backend/js/core/app.min.js') }}"></script>
<script src="{{ asset('backend/js/scripts/customizer.min.js') }}"></script>
<script src="{{ asset('backend/js/scripts/pages/page-auth-login.js') }}"></script>
<script src="{{ asset('backend/js/scripts/ui/ui-feather.min.js') }}"></script>

<script src="{{ asset('backend/js/scripts/extensions/ext-component-toastr.min.js') }}"></script>
<script src="{{ asset('backend/js/scripts/table-datatables-basic.min.js') }}"></script>
<script src="{{ asset('backend/js/scripts/forms/form-wizard.min.js') }}"></script>
<script src="{{ asset('backend/js/scripts/forms/pickers/form-pickers.min.js') }}"></script>
<script src="{{ asset('backend/js/scripts.js') }}"></script>

{!! Toastr::message() !!}

<script>
    $(window).on('load',  function(){
      if (feather) {
        feather.replace({ width: 14, height: 14 });
      }
    })
</script>
