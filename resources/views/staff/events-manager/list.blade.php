@extends('staff.layouts.app')
@section('title')
	@lang('staff.Staff')
@endsection
@section('content')

<div class="page-bar">
    <div class="page-title-breadcrumb">
        <div class=" pull-left">
            <div class="page-title">Doctor Schedule</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index-2.html">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
            </li>
            <li><a class="parent-item" href="#">Appointment</a>&nbsp;<i class="fa fa-angle-right"></i>
            </li>
            <li class="active">Doctor Schedule</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-md-9 col-sm-12">
         <div class="card-box">
             <div class="card-head">
                 <header>Calendar</header>
             </div>
             <div class="card-body ">
                <div class="panel-body">
                        <div id="calendar" class="has-toolbar"> </div>
                    </div>
             </div>
         </div>
     </div>
     <div class="col-md-3 col-sm-12">
         <div class="card-box">
             <div class="card-head">
                 <header>Book Appointment</header>
             </div>
             <div class="card-body" id="bar-parent">
                <form action="#" id="form_sample_1" class="form-horizontal" autocomplete="off">
                    <div class="form-body">
                        <div class="form-group mb-2">
                            <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">Title
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-12">
                                <input type="text" name="title" id="title" placeholder="enter title" class="form-control input-sm" />
                                <div class="error text-danger col-form-label-sm"></div>
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">Patient Name
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-12">
                                <input type="text" name="patient" id="patient" autocomplete="off" placeholder="enter patient name" class="form-control input-sm autocomplete patient" onClick="this.setSelectionRange(0, this.value.length)" />
                                <div class="error text-danger col-form-label-sm"></div>
                                <div id="myInputautocomplete-list" class="autocomplete-items patient" style="overflow-x: auto; max-height: 200px">
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">Phone
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-12">
                                <input type="text" name="phone" id="phone" placeholder="enter phone" class="form-control input-sm" />
                                <div class="error text-danger col-form-label-sm"></div>
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">Email
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-12">
                                <input type="email" name="email" id="email" placeholder="enter email" class="form-control input-sm" />
                                <div class="error text-danger col-form-label-sm"></div>
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">Date Of Appointment
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-12">
                                <div class="input-group date form_date"  data-date="" data-date-format="dd MM yyyy" onkeyup="if (/[^\d/]/g.test(this.value)) this.value = this.value.replace(/[^\d/]/g,'')" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                            <input class="form-control input-sm" size="16" name="start" id="start" placeholder="date of appointment" type="text" value="">
                            <div class="error text-danger col-form-label-sm"></div>
                        </div>
                        <input type="hidden" id="dtp_input2" value="" />
                            </div>
                        </div>
                        <div class="form-group has-success mb-2">
                            {{-- <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">Time</label> --}}
                            <div class="col-md-12">
                                <div class="row">
                                    <label class="control-label col-form-label-sm small-label col-md-2">From</label>
                                    <span class="required" aria-required="true"> * </span>
                                    <div class="col-md-12">
                                        <input class="form-control  input-sm" id="timeStart" name="timeStart" type="time" value="{{ Date('H:m:s') }}" aria-invalid="false" aria-describedby="example-time-input-error">
                                        <div class="error text-danger col-form-label-sm"></div>
                                    </div>
                                     <label class="control-label col-form-label-sm small-label col-md-2">To</label>
                                     <span class="required" aria-required="true"> * </span>
                                    <div class="col-md-12">
                                        <input class="form-control input-sm" id="timeEnd" name="timeEnd" type="time" value="{{ Date('H:m:s') }}">
                                        <div class="error text-danger col-form-label-sm"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">Staff
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-12 aqui">
                                <input type="text" name="staff" id="staff" placeholder="enter staff name" class="form-control input-sm autocomplete staff" onClick="this.setSelectionRange(0, this.value.length)" />
                                <div class="error text-danger col-form-label-sm"></div>
                                <div id="myInputautocomplete-list" class="autocomplete-items staff" style="overflow-x: auto; max-height: 200px">
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">Note
                            </label>
                            <div class="col-md-12">
                                <textarea name="address" class="form-control-textarea mb-5" name="notes" id="notes" placeholder="note" rows="5" style="font-size: 12px;resize: none"></textarea>
                                <div class="error text-danger col-form-label-sm"></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="offset-md-3 col-md-9">
                                <button type="button" class="btn btn-info" id="formSubmit">Add</button>
                                <button type="button" class="btn btn-default" id="formCancel">Cancel</button>
                                <button type="reset" class="d-none" id="formReset">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>
             </div>
         </div>
     </div>

</div>
<div class="modal fade" id="viewEvantModal" tabindex="-1" role="dialog" aria-labelledby="viewEvantModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="viewEvantModalLabel">view event details</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                Modal body text goes here.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary closeModal" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary eventEdit">Edit</button>
                <button type="button" class="btn btn-danger eventDelete">Delete</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('styles')
	<link rel="stylesheet" href="{{ asset('staffFiles/assets/plugins/fullcalendar/lib/main.min.css') }}">
    <link rel="stylesheet" href="{{ asset('staffFiles/assets/plugins/material-datetimepicker/bootstrap-material-datetimepicker.css') }}" />
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
    {{-- <script src="{{ asset('staffFiles/assets/plugins/material-datetimepicker/datetimepicker.js') }}"></script> --}}
    <script>
        var globalValidateBusquedaStaff = '{{ route('staff.events.busquedaStaff') }}'
        var globalValidateBusquedaPatient = '{{ route('staff.events.busquedaPatient') }}'
        var globalSetEvent = '{{ route('staff.events.store') }}'
        var globaleventSources = '{{ route('staff.events.eventSources') }}'
        var globalEventDrop = '{{ route('staff.events.eventDrop') }}'
        var globalEditEvent = '{{ route('staff.events.editEvent') }}'
    </script>
	<script>
        var calendar;
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var initialLocaleCode = 'es';
                calendar = new FullCalendar.Calendar(calendarEl, {
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
                },
                initialView: 'dayGridMonth',
                locale: initialLocaleCode,
                navLinks: true,
                dayMaxEvents: true,
                editable: true, //allow resize events
                eventDisplay: 'block',
                eventDrop: function(info) {
                    var check = moment(info.event.start).format('YYYY-MM-DD');
                    var today = moment(new Date()).format('YYYY-MM-DD');
                    if(check >= today){
                        eventDrop(info)
                    } else {
                        info.revert();
                    }
                },
                eventClick: function(arg) {
                    eventClick(arg)
                },
                eventSources:
                [
                    {
                        url: globaleventSources,
                        method: 'get',
                        success: function(data) {
                        },
                        failure: function() {
                            alert('there was an error while fetching events!');
                        },
                    }
                ],
            });
            calendar.render();
        })
        $('.autocomplete.staff').on('keyup', function() {
            var key = $(this).val();
            var dataString = new FormData();
            dataString.append('key', key);
            $.ajax({
                type: "POST",
                url: globalValidateBusquedaStaff,
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
                    $('#myInputautocomplete-list.staff').html('');
                    //$('#myInputautocomplete-list.staff').remove();
                },
                success: function(data) {
                    //console.log("data", data);
                    var sugerencias = '';
                    if (data.length > 0) {
                        for (var i = 0; i < data.length; i++) {
                           sugerencias += '<div><a class="suggest-element" data="' + data[i].id + '" id="">' + data[i].name + '</a></div>';
                        }
                    } else {
                        sugerencias += '<div><a class="suggest-element no-show-staff" data="" id="">No se encontraron resultados</a></div>';
                        return false;
                    }
                    $('#myInputautocomplete-list.staff').fadeIn(1000).append(sugerencias);
                    $('.suggest-element').not('.no-show-staff').on('click', function(){
                            var id = $(this).attr('data');
                            var name = $(this).text();
                            var objIndex = data.findIndex((obj => obj.id == id));
                            console.log("objIndex", objIndex);
                            $('.autocomplete.staff').val(name).attr('data-id', id);
                            $('#phone').val()
                            $('#myInputautocomplete-list.staff').fadeOut(1000).html('');
                    });
                }
            });
        });
        $('.autocomplete.patient').on('keyup', function() {
            var key = $(this).val();
            $('#email').val('').prop('disabled', false);
            $('#phone').val('');
            var dataString = new FormData();
            dataString.append('key', key);
            $.ajax({
                type: "POST",
                url: globalValidateBusquedaPatient,
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
                    //console.log("data", data);
                    var sugerencias = '';
                    if (data.length > 0) {
                        for (var i = 0; i < data.length; i++) {
                           sugerencias += '<div><a class="suggest-element" data="' + data[i].id + '" id="" email="' + data[i].email + '" phone="' + data[i].phone + '">' + data[i].name + '</a></div>';
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
                            $('.autocomplete.patient').val(name).attr('data-id', id);
                            $('#email').val(email).prop('disabled', true);
                            $('#phone').val(phone);
                            $('#myInputautocomplete-list.patient').fadeOut(1000).html('');
                            return false;
                    });
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
                    calendar.refetchEvents()
                    if (data.reload) {
                        Toast.fire({
                            icon: data.icon,
                            title: data.msg
                        })
                        $('#formReset').click();
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
        $(document).on('click', '#formCancel', function(event) {
            event.preventDefault();
            $('#formEdit').html('add').removeAttr('event').attr('id', 'formSubmit')
            $('input').removeAttr("disabled")
            $('#formReset').click();
        });
        $(document).on('click', '.eventEdit', function(event) {
            event.preventDefault();
            $('#formSubmit').html('edit').attr({
                event: $(this).attr('data-id'),
                id: 'formEdit'
            });
            var event = calendar.getEventById($(this).attr('data-id'))
            $(this).removeAttr('data-id')
            $('#title').val(event.title);
            $('#patient').val(event.extendedProps.patient).attr({
                disabled: true,
                'data-id': event.extendedProps.patient_id,
            });

            $('#phone').val(event.extendedProps.phone).attr('disabled', true);
            $('#email').val(event.extendedProps.email).attr('disabled', true);
            $('#start').val(event.extendedProps.startDate.split("-").reverse().join("/"));
            $('#timeStart').val(event.extendedProps.startTime.slice(0, 5));
            $('#timeEnd').val(event.extendedProps.endTime.slice(0, 5));
            $('#staff').val(event.extendedProps.staff).attr('data-id', event.extendedProps.staff_id);
            $('#notes').val(event.extendedProps.notas);
            $('#viewEvantModal').modal('hide')
        });
        function eventClick(arg) {
            $('#viewEvantModal').on('show.bs.modal', function (e) {
                $('#formEdit').html('add').removeAttr('event').attr('id', 'formSubmit');
                $('.eventEdit').attr('data-id', arg.event.id)
                $('#formReset').click();
            }).modal('show')
        }
        $(document).on('click', '.closeModal', function(event) {
            event.preventDefault();
            $('#formEdit').html('add').removeAttr('event').attr('id', 'formSubmit')
            $('input').removeAttr("disabled")
            $('#formReset').click();
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
                    $('input').removeAttr("disabled")
                    calendar.refetchEvents()
                    if (data.reload) {
                        Toast.fire({
                            icon: data.icon,
                            title: data.msg
                        })
                        $('#formReset').click();
                    } else {
                        $.each( data.errors, function( key, value ) {
                            $('*[id^='+key+']').parent().find('.error').append('<p>'+value+'</p>')
                        });
                    }
                }
            });
        });
</script>
@endsection