@extends('staff.layouts.app')
@section('title')
	@lang('Payments')
@endsection
@section('content')
<div class="page-bar">
    <div class="page-title-breadcrumb">
        <div class=" pull-left">
            <div class="page-title">@lang('Payments Manager')</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li>
                <i class="fa fa-home"></i>&nbsp;
                <a class="parent-item" href="index-2.html">@lang('breadcrumb.Home')</a>
                &nbsp;<i class="fa fa-angle-right">

                </i>
            </li>
            <li class="active">@lang('Configuration')&nbsp;
                <i class="fa fa-angle-right"></i>
            </li>
            <li class="active">@lang('Payments Manager')</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="tabbable-line">
            <div class="tab-content">
                <div class="tab-pane active fontawesome-demo" id="tab1">
                    <div class="row">
                        <div class="col-md-12 d-lg-flex">
                            <div class="col-md-9">
                                <div class="card  card-box">
                                    <div class="card-head">
                                        <header></header>
                                        <div class="tools">
                                            <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                                            <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                            <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                                        </div>
                                    </div>
                                    <div class="card-body ">
                                      <div class="table-scrollable responsive" >
                                        <table class="table table-hover table-checkable order-column full-width" id="paymentTable">
                                            <thead>
                                                <tr>
                                                    <th> ID </th>
                                                    <th> @lang('Image') </th>
                                                    <th> @lang('Patient') </th>
                                                    <th> @lang('Application') </th>
                                                    <th> @lang('Application Total') </th>
                                                    <th> @lang('Payment Amount') </th>
                                                    <th> @lang('Currency') </th>
                                                    <th> @lang('Payment method') </th>
                                                    <th> @lang('Date') </th>
                                                    <th> @lang('Action') </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="card-box">
                                    <div class="card-head">
                                        <header>@lang('Book Appointment')</header>
                                    </div>
                                    <div class="card-body" id="bar-parent">
                                       <form action="#" id="form_sample_1" class="form-horizontal" autocomplete="off">
                                           <div class="form-body">
                                               <div class="form-group mb-2">
                                                   <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Patient Name')
                                                       <span class="required"> * </span>
                                                   </label>
                                                   <div class="col-md-12">
                                                       <input type="text" name="patient" id="patient" autocomplete="off" placeholder="@lang('Enter patient name')" class="form-control input-sm autocomplete patient" onClick="this.setSelectionRange(0, this.value.length)" />
                                                       <div class="error text-danger col-form-label-sm"></div>
                                                       <div id="myInputautocomplete-list" class="autocomplete-items patient" style="overflow-x: auto; max-height: 200px">
                                                       </div>
                                                   </div>
                                               </div>
                                               <div class="form-group mb-2">
                                                   <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Patient Phone')
                                                       <span class="required"> * </span>
                                                   </label>
                                                   <div class="col-md-12">
                                                       <input type="text" name="phone" id="phone" placeholder="@lang('Enter patient phone')" disabled class="form-control input-sm" />
                                                       <div class="error text-danger col-form-label-sm"></div>
                                                   </div>
                                               </div>
                                               <div class="form-group mb-2">
                                                   <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Patient Email')
                                                       <span class="required"> * </span>
                                                   </label>
                                                   <div class="col-md-12">
                                                       <input type="email" name="email" id="email" placeholder="@lang('Enter patient email')"  disabled class="form-control input-sm" />
                                                       <div class="error text-danger col-form-label-sm"></div>
                                                   </div>
                                               </div>
                                               <div class="form-group mb-2">
                                                    <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Application')
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-12">
                                                        <select name="applications" id="applications" class="form-control input-sm">
                                                            <option value="" disabled selected>Select....</option>
                                                        </select>
                                                        <div class="error text-danger col-form-label-sm"></div>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Brand')
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-12">
                                                        <input type="text" name="brand" id="brand" placeholder="@lang('Enter Brand')" disabled class="form-control input-sm" />
                                                        <div class="error text-danger col-form-label-sm"></div>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Service')
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-12">
                                                        <input type="text" name="service" id="service" placeholder="@lang('Enter Service')" disabled class="form-control input-sm" />
                                                        <div class="error text-danger col-form-label-sm"></div>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Precedure')
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-12">
                                                        <input type="text" name="procedure" id="procedure" placeholder="@lang('Enter Precedure')" disabled class="form-control input-sm" />
                                                        <div class="error text-danger col-form-label-sm"></div>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Package')
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-12">
                                                        <input type="text" name="package" id="package" placeholder="@lang('Enter Package')" disabled class="form-control input-sm" />
                                                        <div class="error text-danger col-form-label-sm"></div>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Price')
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-12">
                                                        <input type="text" name="price" id="price" placeholder="@lang('Enter Price')" disabled class="form-control input-sm" />
                                                        <div class="error text-danger col-form-label-sm"></div>
                                                    </div>
                                                </div>
                                           </div>
                                           <div class="form-actions">
                                               <div class="row">
                                                   <div class="offset-md-3 col-md-9">
                                                       {{-- @can('payment.create') --}}
                                                           <button type="button" data-toggle="modal" disabled data-target="#paymenModal" class="btn btn-info" id="paymentAdd">@lang('Add')</button>
                                                       {{-- @endcan --}}
                                                       <button type="button" class="btn btn-default" id="formCancel">@lang('Cancel')</button>
                                                       <button type="reset" id="formReset" class="d-none" id="formReset">@lang('Cancel')</button>
                                                   </div>
                                               </div>
                                           </div>
                                       </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="paymenModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Modal title</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" id="form_sample_1" class="form-horizontal" autocomplete="off" enctype="multipart/form-data">
                    <div class="form-body">
                        <div class="form-group mb-2">
                            <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Photographic evidence')
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-12">
                                <input type="file" name="evivicence" id="evidence" class="form-control input-sm dropify" accept="image/*" />
                                <div class="error text-danger col-form-label-sm"></div>
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Amount')
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-12">
                                <input type="text" name="amount" id="amount" placeholder="@lang('Enter amount')"  class="form-control input-sm" />
                                <div class="error text-danger col-form-label-sm"></div>
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Currency')
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-12">
                                <select name="currency" id="currency" class="form-control input-sm">
                                    <option value="" disabled selected>Select....</option>
                                    <option value="Dollar">Dollar (USD)</option>
                                    <option value="Peso">Peso (MXP)</option>
                                </select>
                                <div class="error text-danger col-form-label-sm"></div>
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Payment method')
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-12">
                                <select name="paymentMethod" id="paymentMethod" class="form-control input-sm">
                                    <option value="" disabled selected>Select....</option>
                                    @foreach($paymentMethod as $method)
                                        <option value="{{ $method->code }}">{{ $method->description }}</option>
                                    @endforeach
                                </select>
                                <div class="error text-danger col-form-label-sm"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="appPaymentModal" class="btn btn-primary">Save</button>
                        <button type="button"  class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="reset" id="formResetModal" class="d-none"></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('styles')
@endsection
@section('scripts')
    @if (\Session::has('sys-message'))
        <script>
            Toast.fire({
              icon: '{{\Session::get('icon')}}',
              title: '{{\Session::get('msg')}}',
            })
        </script>
    @endif
    <script>
        var globalSearchStaff = '{{ route('staff.autocomplete.AutocompleteStaff') }}'
        var globalSearchPatient = '{{ route('staff.autocomplete.AutocompletePatient') }}'
        var globalRouteobtenerApps = '{{ route('staff.payments.patientsApps') }}'
        var globalRoutelistar = '{{ route('staff.payments.getList') }}'
        var globalRoutecreate = '{{ route('staff.payments.create') }}'
        var globalRoutesearchPatientWithApps = '{{ route('staff.payments.searchPatientWithApps') }}'
    </script>
	<script>
        $(document).ready(function() {
            var codigo = 1;
            var paymentTable = $('#paymentTable').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax:{
                    url : globalRoutelistar,
                    type: "get",
                    data: {"estable": codigo},
                    error: function (xhr, error, thrown) {
                    },
                 },
                language: {
                    "url": dataTablesLangEs
                },
                "columns": [

                    { data: 'DT_RowIndex' },
                    { data: "image" },
                    { data: "patient" },
                    { data: "application" },
                    { data: "application_total" },
                    { data: "payment_amount" },
                    { data: "currency" },
                    { data: "payment_method" },
                    { data: "date", className: 'center' },
                    { data: "action", orderable: false, searchable: false, className: 'center' },

                ],
                createdRow: function (row, data, dataIndex) {
                    $(row).addClass('odd gradeX');
                },
            });

            function patientGetApps(id){
                var dataString = new FormData();
                dataString.append('id', id);
                $.ajax({
                    url: globalRouteobtenerApps,
                    type: "POST",
                    method:"POST",
                    data:dataString,
                    dataType:'JSON',
                    contentType: false,
                    cache: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    processData: false,
                    beforeSend: function(){
                        $("#applications option:not(:first)").remove();
                        $("#applications").prop("selectedIndex", 0);
                    },
                    success: function(data) {
                        for (let i = 0; i < data.data.length; i++) {
                            $('#applications').append('<option value="'+data.data[i].id+'">'+data.data[i].temp_code+'</option>')
                        }
                    }
                });
            }
            $('.autocomplete.patient').on('keyup click', function() {
                var key = $(this).val();
                $('#email').val('').removeAttr('disabled')
                $('#phone').val('').removeAttr('disabled')
                $('#paymentAdd').attr('disabled', true)
                $('#applications option:not(:first)').remove();
                $('#brand').val('')
                $('#service').val('')
                $('#procedure').val('')
                $('#package').val('')
                $('#price').val('')
                $("#paymentAdd").removeAttr("appId")
                // $("#appPaymentModal").removeAttr("idA");
                // $("#appPaymentModal").removeAttr("code");
                var dataString = new FormData();
                dataString.append('key', key);
                $.ajax({
                    type: "POST",
                    url: globalSearchPatient,
                    method:"POST",
                    data:dataString,
                    dataType:'JSON',
                    contentType: false,
                    cache: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    processData: false,
                    beforeSend: function(){
                        $('#myInputautocomplete-list.patient').html('');
                    },
                    success: function(data) {
                        var sugerencias = '';
                        if (data.length > 0) {
                            for (var i = 0; i < data.length; i++) {
                                var app = 0;
                                if (data[i].applications.length > 0) {
                                    app = 1;
                                }
                               sugerencias += '<div><a class="suggest-element" app="'+ app +'" lang="'+ data[i].lang+'" data="' + data[i].id + '" id="" email="' + data[i].email + '" phone="' + data[i].phone + '">' + data[i].name + '</a></div>';
                            }
                        } else {
                            sugerencias += '<div><a class="suggest-element no-show-patient" data="" id="">No se encontraron resultados</a></div>';
                        }
                        $('#myInputautocomplete-list.patient').fadeIn(1000).append(sugerencias);
                        $('.suggest-element').not('.no-show-patient').on('click', function(){
                            var id = $(this).attr('data');
                            var name = $(this).text();
                            var email = $(this).attr('email');
                            var phone = $(this).attr('phone');
                            var lang = $(this).attr('lang');
                            var app = $(this).attr('app');
                            patientGetApps(id)
                            $('.autocomplete.patient').val(name).attr('data-id', id);
                            $('#email').val(email);
                            $('#phone').val(phone);
                            $('#lang option[value='+lang+']').attr('selected','selected');
                            $('#lang').prop('disabled', true);
                            $('#myInputautocomplete-list.patient').fadeOut(1000).html('');

                            return false;
                        });
                    }
                });
            });

            $(document).on('change', '#applications', function () {
                var appId = $( "#applications option:selected" ).val();
                var code = $( "#applications option:selected" ).text();
                var e = document.getElementById("applications").value;
                //alert(e.value);
                var dataString = new FormData();
                dataString.append('id', appId);
                $.ajax({
                    url: globalRoutesearchPatientWithApps,
                    type: "POST",
                    method:"POST",
                    data:dataString,
                    dataType:'JSON',
                    contentType: false,
                    cache: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    processData: false,
                    beforeSend: function(){

                    },
                    success: function(data) {
                        console.log("data", data);
                        $('#paymentAdd').attr('disabled', false)
                        $('#brand').val(data.treatment.brand.brand)
                        $('#service').val(data.treatment.service.service)
                        $('#procedure').val(data.treatment.procedure.procedure)
                        $('#package').val(data.treatment.package.package)
                        $('#price').val(data.treatment.price)
                        $("#paymentAdd").attr("appId", data.treatment.id)
                        $("#appPaymentModal").attr({"idA": data.treatment.id, "code": code});
                    }
                });
            });
            $(document).on('click', '.no-show-patient', function(event) {
                event.preventDefault();
                $('#myInputautocomplete-list.patient').fadeOut(1000).html('');
                $('.autocomplete.patient').val('').focus().attr('data-id', '')
            });
           
            $(document).on('click', '#formCancel', function(event) {
                event.preventDefault();
                $('#formEdit').html('add').removeAttr('event').attr('id', 'formSubmit')
                $('input').removeAttr("disabled")
                $('#lang').removeAttr('disabled');
                $('#formReset').click();
                $('.error').html('')
                $('.eventApp').hide('fast');
                $("#is_app").prop('checked', false);
                $("#is_app").parent().removeClass('is-checked');
                $("#app").removeAttr("data-id")
            });

            $('#paymenModal').on('show.bs.modal', function (event) {
                var code = $( "#applications option:selected" ).text();
                var id = $('#paymentAdd').attr('appid')
                if (code != $("#appPaymentModal").attr('code') || id != $("#appPaymentModal").attr('idA')) {
                   location.reload();
                }
            })

            $(document).on('click', '.closeModal', function(event) {
                event.preventDefault();
                $('#formEdit').html('add').removeAttr('event').attr('id', 'formSubmit')
                $('input').removeAttr("disabled")
                $('#lang').removeAttr('disabled');
                $('#formReset').click();
                $('.error').html('')
            });

            $(document).on("click", "#appPaymentModal", function(e){
                var fd = new FormData();
                var files = $('#evidence')[0].files[0];
                var amount = $('#amount').val();
                var paymentMethod = $('#paymentMethod').val();
                fd.append('evidence', files)
                fd.append('amount', amount)
                fd.append('evidence', 1)
                fd.append('id', $("#appPaymentModal").attr('idA'))
                fd.append('code', $("#appPaymentModal").attr('code'))
                fd.append('paymentMethod', paymentMethod)
                fd.append('currency', $("#currency").val());
                fd.append('patId', $("#patient").attr('data-id'));
                $.ajax({
                    url: globalRoutecreate,
                    type: "POST",
                    method:"POST",
                    data:fd,
                    dataType:'JSON',
                    contentType: false,
                    cache: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    processData: false,
                    beforeSend: function(){

                    },
                    success: function(data) {
                        console.log("data", data);
                       Toast.fire({
                            icon: data.icon,
                            title: data.msg
                        })
                        if (data.reload) {
                            paymentTable.ajax.reload( null, false );
                            clearForm()
                        } else {
                            $.each( data.errors, function( key, value ) {
                                $('*[id^='+key+']').parent().find('.error').append('<p>'+value+'</p>')
                            });
                        }
                    }
                });
            })

            function clearForm(){
                $('#formReset').click();
                $('#formResetModal').click();
                $("#patient").removeAttr('data-id');
                $("#appPaymentModal").removeAttr('idA')
                $("#appPaymentModal").removeAttr('code')
                $('#paymenModal').modal('hide')
            }
        });
</script>
@endsection
