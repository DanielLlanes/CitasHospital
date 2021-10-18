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
                                        <table class="table table-hover table-checkable order-column full-width" id="PackageTable">
                                            <thead>
                                                <tr>
                                                    <th> ID </th>
                                                    <th> @lang('Image') </th>
                                                    <th> @lang('Patient') </th>
                                                    <th> @lang('Application') </th>
                                                    <th> @lang('Application Total') </th>
                                                    <th> @lang('Payment Amount') </th>
                                                    <th> @lang('Number of payments') </th>
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
                                                       @can('calendar.create')
                                                           <button type="button" class="btn btn-info" id="formSubmit">@lang('Add')</button>
                                                       @endcan
                                                       <button type="button" class="btn btn-default" id="formCancel">@lang('Cancel')</button>
                                                       <button type="reset" class="d-none" id="formReset">@lang('Cancel')</button>
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
@endsection
@section('styles')
	<link rel="stylesheet" href="{{ asset('staffFiles/assets/plugins/fullcalendar/lib/main.min.css') }}">
    <link rel="stylesheet" href="{{ asset('staffFiles/assets/plugins/material-datetimepicker/bootstrap-material-datetimepicker.css') }}" />
    <link rel="stylesheet" href="{{ asset('staffFiles/assets/plugins/datatables/datatables.min.css') }}">
    <style>
        .autocomplete {
          /*the container must be positioned relative:*/
          position: relative;
          display: inline-block;
        }
        .autocomplete-items {
          position:absolute;
          border: 1px solid #d4d4d4;
          border-bottom: none;
          border-top: none;
          z-index: 16777271;
          /*position the autocomplete items to be the same width as the container:*/
          top: 100%;
          left: 0;
          right: 0;
         /* width: 100%*/
         margin-left: 15px;
         margin-right: 15px;
        }
        .autocomplete-items div {
          cursor: pointer;
          background-color: #fff;
          border-bottom: 1px solid #d4d4d4;
          height: 30px;
          padding: 5px 10px;
          font-size: 12px;
          line-height: 1.5;
        }
        .autocomplete-items div:hover {
          /*when hovering an item:*/
          background-color: #e9e9e9;
        }

        .autocomplete-active {
          /*when navigating through the items using the arrow keys:*/
          background-color: DodgerBlue !important;
          color: #ffffff;
        }
        .dataTableLayout {
            table-layout:fixed;
            width:100%;
        }
        .letras{
            font-size: .8em;
        }
        table.dataTable.dtr-inline.collapsed>tbody>tr>td.dtr-control:before,
        table.dataTable.dtr-inline.collapsed>tbody>tr>th.dtr-control:before {
            font-family: "Courier New",Courier,monospace;
            line-height: 1.2em;
            content: "+";
            background-color: #0275d8;
        }
        .fc-event {
            border-width: .1px;
        }
    </style>
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
    <script src="{{ asset('staffFiles/assets/plugins/fullcalendar/lib/main.min.js') }}"></script>
    <script src="{{ asset('staffFiles/assets/plugins/moment/moment.min.js') }}" ></script>
    <!-- Material -->
    <script src="{{ asset('staffFiles/assets/plugins/material/material.min.js') }}"></script>
    <script src="{{ asset('staffFiles/assets/plugins/material-datetimepicker/moment-with-locales.min.js') }}"></script>
    <script src="{{ asset('staffFiles/assets/plugins/material-datetimepicker/bootstrap-material-datetimepicker.js') }}"></script>
    <script src="{{ asset('staffFiles/assets/plugins/datatables/datatables.min.js') }}"></script>
    <script>
        var globalSearchStaff = '{{ route('staff.autocomplete.AutocompleteStaff') }}'
        var globalSearchPatient = '{{ route('staff.autocomplete.AutocompletePatient') }}'
        var globalDestroyEvent = '{{ route('staff.events.destroy') }}'
        var globalRouteobtenerApps = '{{ route('staff.payments.patientsApps') }}'
        var globalRoutesearchPatientWithApps = '{{ route('staff.payments.searchPatientWithApps') }}'
    </script>
	<script>


        $('.autocomplete.patient').on('keyup click', function() {
            var key = $(this).val();
            $('#email').val('').removeAttr('disabled')
            $('#phone').val('').removeAttr('disabled')
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
                            console.log();
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
                        var app = $(this).attr('app')
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

        $(document).on('click', '#applications', function () {
            var appId = $( "#applications option:selected" ).val();
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
                    console.log(data);
                    $('#brand').val(data.treatment.brand.brand)
                    $('#service').val(data.treatment.service.service)
                    $('#procedure').val(data.treatment.procedure.procedure)
                    $('#package').val(data.treatment.package.package)
                    $('#price').val(data.treatment.price)
                }
            });
        });
        $(document).on('click', '.no-show-patient', function(event) {
            event.preventDefault();
            $('#myInputautocomplete-list.patient').fadeOut(1000).html('');
            $('.autocomplete.patient').val('').focus().attr('data-id', '')
        });
        $(document).on('click', '.no-show-staff', function(event) {
            event.preventDefault();
            $('#myInputautocomplete-list.staff').fadeOut(1000).html('');
            $('.autocomplete.staff').val('').focus().attr('data-id', '')
        });
        $(document).on('click', '#formSubmit', function(event) {

            event.preventDefault();
            $('.error').html('')
            var date = $('#start').val();
            var formatdate = date.split("/").reverse().join("/");
            var dataString = new FormData()
            dataString.append('patient_id', $('#patient').attr('data-id'))
            dataString.append('phone', $('#phone').val())
            dataString.append('title', $('#title').val())
            dataString.append('email', $('#email').val())
            dataString.append('isApp', $('#is_app').is(":checked")? '1':"0")
            dataString.append('app', $('#app').attr("data-id"))
            dataString.append('lang', $("#lang option:selected" ).val())
            dataString.append('patient', $('#patient').val())
            dataString.append('start', formatdate)
            dataString.append('timeStart', $('#timeStart').val())
            dataString.append('timeEnd', $('#timeEnd').val())
            dataString.append('staff_id', $('#staff').attr('data-id'))
            dataString.append('staff', $('#staff').attr('data-id'))
            dataString.append('notes', $('#notes').val())
            $.ajax({
                type: "POST",
                url: globalSetEvent,
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
                    calendar.refetchEvents()
                    if (data.reload) {
                        Toast.fire({
                            icon: data.icon,
                            title: data.msg
                        })
                        $('#formReset').click();
                         $('#email').prop('disabled', false);
                        $('#phone').prop('disabled', false);
                        $('.error').html('')
                        $('.eventApp').hide('fast');
                        $("#is_app").prop('checked', false);
                        $("#is_app").parent().removeClass('is-checked');
                        $("#app").removeAttr("data-id")
                    } else {
                        $.each( data.errors, function( key, value ) {
                            $('*[id^='+key+']').parent().find('.error').append('<p>'+value+'</p>')
                        });
                    }
                }
            });
        });
        $('#start').bootstrapMaterialDatePicker({
            time: false,
            clearButton: true,
            format : 'DD/MM/YYYY',
            minDate : moment()
        });
        function dateCheck(sss){
            if (/[^\d/]/g.test(sss.value)) sss.value = sss.value.replace(/[^\d/]/g,'')
        }

        function eventDrop(event){
            var form_data = new FormData();
            form_data.append('id', event.event.id);
            form_data.append('start', event.event.startStr);
            $.ajax({
                url: globalEventDrop,
                method:"POST",
                data:form_data,
                dataType:'JSON',
                contentType: false,
                cache: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                processData: false,
                beforeSend: function()
                {
                },
                success:function(data)
                {
                    Toast.fire({
                        icon: data.icon,
                        title: data.msg
                    })
                    if (data.reload) {
                        calendar.refetchEvents()
                    }
                    $('.error').html('')
                },
                error: function (err)
                {
                    console.log('err', err)
                },
                complete: function()
                {
                },
            })
        }
        $(document).on('click', '.eventEdit', function(event) {
            event.preventDefault();
            $('#formSubmit').html('edit').attr({
                event: $(this).attr('data-id'),
                id: 'formEdit'
            });
            var event = calendar.getEventById($(this).attr('data-id'))
            console.log(event)
            $(this).removeAttr('data-id')
            $('#title').val(event.title);

            $('#patient').val(event.extendedProps.patient).attr({
                disabled: true,
                'data-id': event.extendedProps.patient_id,
            });
            $('#phone').val(event.extendedProps.phone).attr('disabled', true);
            $('#email').val(event.extendedProps.email).attr('disabled', true);
            $('#start').val(event.extendedProps.startDate.split("-").reverse().join("/"));
            $('#lang').val(event.extendedProps.lang);
            $('#timeStart').val(event.extendedProps.startTime.slice(0, 5));
            $('#timeEnd').val(event.extendedProps.endTime.slice(0, 5));
            $('#staff').val(event.extendedProps.staff).attr('data-id', event.extendedProps.staff_id);
            $('#notes').val(event.extendedProps.notas);

            $('#is_app').parents('.form-group').show('fast')

            if (event.extendedProps.isapp == "si") {

                $("#is_app").prop('checked', true);
                $("#is_app").parent().addClass('is-checked');
                var brand = event.extendedProps.application_brand;
                var service = event.extendedProps.application_service;
                var procedure = event.extendedProps.application_procedure;
                var package = '';
                if (event.extendedProps.application_package != "no") {
                    var package = event.extendedProps.application_package;
                }
                $('.eventApp').show('fast');
                $("#app").val(brand + ', ' +service + ', ' +procedure + ', ' +package)
                $("#app").attr("data-id", event.extendedProps.application_id)
            }

            $('#lang option[value="'+event.extendedProps.lang+'"]')


            $('#viewEvantModal').modal('hide')
        });
        $(document).on('click', '#formEdit', function(event) {
            event.preventDefault();
            $('.error').html('')
            var date = $('#start').val();
            var formatdate = date.split("/").reverse().join("/");
            var dataString = new FormData()
            dataString.append('patient_id', $('#patient').attr('data-id'))
            dataString.append('phone', $('#phone').val())
            dataString.append('title', $('#title').val())
            dataString.append('email', $('#email').val())
            dataString.append('isApp', $('#is_app').is(":checked")? '1':"0")
            dataString.append('app', $('#app').attr("data-id"))
            dataString.append('lang', $("#lang option:selected" ).val())
            dataString.append('lang', $("#lang option:selected" ).val())
            dataString.append('patient', $('#patient').val())
            dataString.append('start', formatdate)
            dataString.append('timeStart', $('#timeStart').val())
            dataString.append('timeEnd', $('#timeEnd').val())
            dataString.append('staff_id', $('#staff').attr('data-id'))
            dataString.append('staff', $('#staff').val())
            dataString.append('notes', $('#notes').val())
            dataString.append('event', $('#formEdit').attr('event'))
            $.ajax({
                type: "POST",
                url: globalEditEvent,
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
                    console.log(data);
                    $('input').removeAttr("disabled")
                    calendar.refetchEvents()
                    if (data.reload) {
                        Toast.fire({
                            icon: data.icon,
                            title: data.msg
                        })
                        $('#formReset').click();
                        $('.eventApp').hide('fast');
                        $("#is_app").prop('checked', false);
                        $("#is_app").parent().removeClass('is-checked');
                        $("#app").removeAttr("data-id")

                    } else {
                        $.each( data.errors, function( key, value ) {
                            $('*[id^='+key+']').parent().find('.error').append('<p>'+value+'</p>')
                        });
                    }
                }
            });
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

        function eventClick(arg) {
            console.log(arg.event)
            $('#viewEvantModal').on('show.bs.modal', function (e) {
                $('#formEdit').html('add').removeAttr('event').attr('id', 'formSubmit');
                $('.eventEdit').attr('data-id', arg.event.id)
                $('.eventDelete').attr('data-id', arg.event.id)
                $('#formReset').click();
                $('.error').html('')
                //$('#viewEvantModal').find('.modal-body').html('')
                $(".title").html(arg.event.title)
                $(".staffName").html(arg.event.extendedProps.staff)
                $(".patient").html(arg.event.extendedProps.patient)
                $(".fechaInicio").html(arg.event.extendedProps.formatedDate)
                $(".notas").html(arg.event.extendedProps.notas)
                $('#myInputautocomplete-list.patient').fadeOut(1000).html('');
            }).modal('show')
        }
        $(document).on('change', '#is_app',function () {
            if ($('#is_app').is(":checked")) {
                $('.eventApp').show('fast');
                getApps()
            } else {
                $('.eventApp').hide('fast');
                $("#app").removeAttr("data-id")
                $("#app").val("")
            }
        });

        $(document).on("click", "#btnAppsModal",function () {
            $('.eventApp').hide('fast');
            $("#app").removeAttr("data-id")
            $("#app").val("")
            $("#is_app").prop('checked', false);
            $("#is_app").parent().removeClass('is-checked');
        });

        function getApps(){
            $('#appsModal').on('shown.bs.modal', function (e) {
                var id = $('.autocomplete.patient').attr('data-id');

                $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust()
                .responsive.recalc();

                var appsTable = $('#appsTable').DataTable({
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    "autoWidth": false,
                    "scrollX": true,
                    "bDestroy": true,

                    ajax:{
                        url : globalRouteobtenerLista,
                        type: "get",
                        data: {"id": id},
                        error: function (xhr, error, thrown) {
                        },
                    },
                    language: {
                        "url": dataTablesLangEs
                    },
                    "columns": [

                        { data: 'DT_RowIndex' },
                        { data: "action", orderable: false, searchable: false },
                        { data: "treatment" },
                        { data: "date" },
                        { data: "price" }

                    ],
                    createdRow: function (row, data, dataIndex) {
                        $(row).addClass('odd gradeX letras');
                    },
                    initComplete: function() {
                        this.api().responsive.recalc()
                    },
                })

                $("#appsTable").DataTable()
                .columns.adjust()
                .responsive.recalc();

            }).modal(
                {
                        backdrop: 'static',
                        keyboard: true,
                        show: true
                }
            )
        }

        $('#appsModal').on('hide.bs.modal', function (e) {
            $('#appsTable').empty();
        })

        $(document).on('click', ".btn-add", function () {
            $("#app").val($(this).attr("name"))
            $("#app").attr("data-id", $(this).attr("data-id"))
            $('#appsModal').modal("hide")
        });

        $(document).on('click', '.closeModal', function(event) {
            event.preventDefault();
            $('#formEdit').html('add').removeAttr('event').attr('id', 'formSubmit')
            $('input').removeAttr("disabled")
            $('#lang').removeAttr('disabled');
            $('#formReset').click();
            $('.error').html('')
        });

        $(document).on('click', '.eventDelete', function(event) {
            event.preventDefault();

            $('#viewEvantModal').modal('hide')
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        eventDelete($(this).attr('data-id'))
                    }
                })
        });
        function eventDelete(id) {
            var dataString = new FormData()
            dataString.append('id', id)
            $.ajax({
                type: "POST",
                url: globalDestroyEvent,
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
                    Toast.fire({
                        icon: data.icon,
                        title: data.msg
                    })
                    $('#formReset').click();
                    $('.error').html('')
                    if (data.reload) {
                    calendar.refetchEvents()

                    }
                }
            });
        }

</script>
@endsection
