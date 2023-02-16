@extends('staff.layouts.app')
@section('title')
	@lang('Doctor Schedule')
@endsection
@section('content')

<div class="page-bar">
    <div class="page-title-breadcrumb">
        <div class=" pull-left">
            <div class="page-title">@lang('Doctor Schedule')</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index-2.html">@lang('Home')</a>&nbsp;<i class="fa fa-angle-right"></i>
            </li>
            <li><a class="parent-item" href="#">@lang('Appointment')</a>&nbsp;<i class="fa fa-angle-right"></i>
            </li>
            <li class="active">@lang('Doctor Schedule')</li>
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
                 <header>@lang('Book Appointment')</header>
             </div>
             <div class="card-body" id="bar-parent">
                <form action="#" id="form_sample_1" class="form-horizontal" autocomplete="off">
                    <div class="form-body">
                        <div class="form-group mb-2">
                            <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Title')
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-12">
                                <input type="text" name="title" id="title" placeholder="@lang('Title')" class="form-control input-sm" />
                                <div class="error text-danger col-form-label-sm"></div>
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Patient Name')
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-12">
                                {{-- <input type="text" name="patient" id="patient" autocomplete="off" placeholder="@lang('Enter patient name')" class="form-control input-sm autocomplete patient" onClick="this.setSelectionRange(0, this.value.length)" /> --}}
                                <select class="form-control input-height " id="patient-search-select">
                                </select>
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
                                <input type="text" name="phone" id="phone" placeholder="@lang('Enter patient phone')" class="form-control input-sm" />
                                <div class="error text-danger col-form-label-sm"></div>
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Patient Email')
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-12">
                                <input type="email" name="email" id="email" placeholder="@lang('Enter patient email')" class="form-control input-sm" />
                                <div class="error text-danger col-form-label-sm"></div>
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Patient Lang')
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-12">
                                <select class="form-control input-sm" id="lang" name="lang">
                                    <option value="">@lang('Select...')</option>
                                    <option {{ old('language') == 'es' ? 'selected' : '' }} value="es">@lang('Spanish')</option>
                                    <option {{ old('language') == 'en' ? 'selected' : '' }} value="en">@lang('English')</option>
                                </select>
                            <div class="error text-danger col-form-label-sm"></div>
                            </div>
                        </div>
                        <div class="form-group mb-2 is_app_div" style="display: none">
                            <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Is Application')
                                <span class="required">  </span>
                            </label>
                            <div class="col-md-12">
                                <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="is_app">
                                    <input type="checkbox" id="is_app" name="is_app" value="1" class="mdl-checkbox__input">
                                    <span class="mdl-checkbox__label"></span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group mb-2 eventApp" style="display: none">
                            <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Application')
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-12">
                                <input type="text" name="app" id="app" placeholder="@lang('Select application')" class="form-control input-sm" />
                                <div class="error text-danger col-form-label-sm"></div>
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">Date Of Appointment
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-12">
                                <div class="input-group date form_date"  data-date="" data-date-format="dd MM yyyy" onkeyup="if (/[^\d/]/g.test(this.value)) this.value = this.value.replace(/[^\d/]/g,'')" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                                    <input class="form-control input-sm" size="16" name="start" id="start" placeholder="" type="text">
                                    <div class="error text-danger col-form-label-sm"></div>
                                </div>
                                <small id="emailHelp" class="form-text text-muted">Format mm/dd/yyyy</small>
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">From
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-12">
                                <div class="input-group date form_date"  data-date="" data-date-format="hh:ii" data-link-field="dtp_input3" data-link-format="hh:ii">
                                    <input class="form-control input-sm" size="16" name="timeStart" id="timeStart" placeholder="Date Of Appointment" type="time">
                                    <div class="error text-danger col-form-label-sm"></div>
                                </div>
                                <inpit type="hidden" id="dtp_input3">
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">To
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-12">
                                <div class="input-group date form_date"  data-date="" data-date-format="hh:ii" data-link-field="dtp_input4" data-link-format="hh:ii">
                                    <input class="form-control input-sm" size="16" name="timeEnd" id="timeEnd" placeholder="" type="time">
                                    <div class="error text-danger col-form-label-sm"></div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-2">
                            <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Staff')
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-12 aqui">
                                {{-- <input type="text" name="staff" id="staff" placeholder="@lang('Enter staff name')" class="form-control input-sm autocomplete staff" onClick="this.setSelectionRange(0, this.value.length)" /> --}}
                                <select class="form-control input-height " id="staff-search-select">
                                </select>
                                <div class="error text-danger col-form-label-sm"></div>
                                <div id="myInputautocomplete-list" class="autocomplete-items staff" style="overflow-x: auto; max-height: 200px">
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Note')
                            </label>
                            <div class="col-md-12">
                                <textarea name="address" class="form-control-textarea mb-5" name="notes" id="notes" placeholder="@lang('Note')" rows="5" style="font-size: 12px;resize: none"></textarea>
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

    <div class="modal fade" id="viewEvantModal" tabindex="-1" role="dialog" aria-labelledby="viewEvantModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="viewEvantModalLabel">@lang('Event details')</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" id="eventModalBody">
                    <div class="col-12">
                        <div class="title text-center font-weight-bold text-capitalize"></div>
                    </div>
                    <div class="col-12">
                        <div class="row">
                            <div class="col-5">
                                <div class="staffName"></div>
                                <div class="patient"></div>
                                <div class="fechaInicio"></div>
                            </div>
                            <div class="col-7">

                            </div>
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        <div class="notas text"></div>
                    </div>
                </div>
                <div class="modal-footer flex-nowrap">
                    <div class="col-6 d-flex flex-row">
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="status0" name="status" class="custom-control-input" value="0">
                            <label class="custom-control-label badge text-dark" style="background-color: transparent;" for="status0">Active</label>
                        </div>
                        @foreach ($status as $k => $st)
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="status{{ $k+1 }}" name="status" class="custom-control-input" value="{{ $st->id }}">
                                <label class="custom-control-label badge" style="background-color: {{ $st->color }}" for="status{{ $k+1 }}">{{ $st->name }}</label>
                            </div>
                        @endforeach
                    </div>
                    <div class="col-6 d-flex flex-wrap justify-content-end">
                        <span>
                            <button type="button" class="btn btn-secondary closeModal" data-dismiss="modal">@lang('Close')</button>
                            @can('calendar.edit')
                                <button type="button" class="btn btn-primary eventEdit">@lang('Edit')</button>
                            @endcan
                            @can('calendar.destroyx')
                                <button type="button" class="btn btn-danger eventDelete">@lang('Delete')</button>
                            @endcan
                    </div>
                </div>
                {{-- <div class="modal-footer">

                </div> --}}
            </div>
        </div>
    </div>
    <div class="modal fade" id="appsModal" tabindex="-1" role="dialog" aria-labelledby="appsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" style="max-width: 1200px" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Modal title</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body position-relative" id="appsModalBody">
                    <div class="table-responsive p-3">
                        <table class="table nowrap table-hover" style="width: 100%; overflow-x:auto" id="appsTable">
                            <thead>
                                <tr style="font-size: .8">
                                    <th> ID </th>
                                    <th> @lang('Action') </th>
                                    <th> @lang('Code') </th>
                                    <th> @lang('Treatment') </th>
                                    <th> @lang('Date') </th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="btnAppsModal" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('staffFiles/assets/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}" />
	<link rel="stylesheet" type="text/css" href="{{ asset('staffFiles/assets/plugins/fullcalendar/lib/main.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('staffFiles/assets/plugins/material-datetimepicker/bootstrap-material-datetimepicker.css') }}" />
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

    <script src="{{ asset('staffFiles/assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js') }}"></script>
    <script>
        var globalSearchStaff = '{{ route('staff.autocomplete.AutocompleteStaff') }}'
        var globalSearchPatient = '{{ route('staff.autocomplete.AutocompletePatient') }}'
        var globalSetEvent = '{{ route('staff.events.store') }}'
        var globaleventSources = '{{ route('staff.events.eventSources') }}'
        var globalEventDrop = '{{ route('staff.events.eventDrop') }}'
        var globalEditEvent = '{{ route('staff.events.editEvent') }}'
        var globalDestroyEvent = '{{ route('staff.events.destroy') }}'
        var globalRouteobtenerLista = '{{ route('staff.events.getApps') }}'
        var globalStatusEvent = '{{ route('staff.events.status') }}'
        var canEdit = "{{ Auth::guard('staff')->user()->hasPermissionTo('calendar.edit') }}";
        var canDestroy = "{{ Auth::guard('staff')->user()->hasPermissionTo('calendar.destroy') }}";
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
                editable: false,
                eventDisplay: 'block',
                @can('calendar.edit')
                    editable: true,
                    eventDrop: function(info) {
                        var check = moment(info.event.start).format('YYYY-MM-DD');
                        var today = moment(new Date()).format('YYYY-MM-DD');
                        if(check >= today){
                            eventDrop(info)
                        } else {
                            info.revert();
                        }
                    },
                @endcan
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
                eventDidMount: function (info) {
                    info.el.style.background = info.event.backgroundColor;
                }
            });
            window.onload = function () {
                $('.fc-toolbar.fc-header-toolbar').addClass('row col-lg-12');
            };

            // add the responsive classes when navigating with calendar buttons
            $(document).on('click', '.fc-button', function(e) {
                $('.fc-toolbar.fc-header-toolbar').addClass('row col-lg-12');
            });
            calendar.render();
        })
    </script>
    {{-- <script src="{{ asset('staffFiles/assets/js/customjs/event.min.js') }}"></script> --}}

    <script>
        $('#patient-search-select').empty().attr('placeholder', "Select click here").trigger('change')
        $('#patient-search-select').select2({
            placeholder: "Select click here",
            ajax: {
                url: globalSearchPatient,
                type: 'post',
                dataType: 'json',
                data: function (params) {
                    return {
                        search: params.term,
                    }
                },
                processResults: function(data) {
                    return {
                        results: $.map(data, function(obj) {
                            return {
                                id: obj.id,
                                text: obj.name,
                                phone: obj.phone,
                                email: obj.email,
                                lang: obj.lang,
                                app: obj.applications,
                            };
                        })
                    };
                },
                cache: true,
            }
        });
        $('#patient-search-select').on('select2:select', function (e) {
            var data = e.params.data;
            if (data) {
                $('#email').val('').removeAttr('disabled')
                $('#phone').val('').removeAttr('disabled')
                $('#lang').val('').removeAttr('disabled')
                $('#applications option:not(:first)').remove();
                $('#email').val(data.email).prop('disabled', true)
                $('#phone').val(data.phone).prop('disabled', true)
                $('#lang').val(data.lang).prop('disabled', true)
                if (data.app.length == 0) { $('#is_app').parents('.form-group').hide('fast') } else { $('#is_app').parents('.form-group').show('fast') }
            }
        });
        $('#staff-search-select').empty().attr('placeholder', "Select click here").trigger('change')
        $('#staff-search-select').select2({
            placeholder: "Select click here",
            ajax: {
                url: globalSearchStaff,
                type: 'post',
                dataType: 'json',
                data: function (params) {
                    isApp = false;
                    if ($('#is_app').is(":checked")) {
                        isApp = true;
                        var app = $("#app").attr("data-id")
                    } else {
                        isApp = false;
                        var app = $("#app").attr("data-id")
                    }

                    return {
                        search: params.term,
                        isApp: isApp,
                        app: app,
                    }
                },
                processResults: function(data) {
                    return {
                        results: $.map(data, function(obj) {
                            return {
                                id: obj.id,
                                text: obj.name,
                            };
                        })
                    };
                },
                cache: true,
            }
        });
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
        $(document).on('click', ".btn-add", function () {
            $("#app").val($(this).attr("name"))
            $("#app").attr("data-id", $(this).attr("data-id"))
            //$("#title").val($(this).attr("data-clave"))
            $('#appsModal').modal("hide")
        });
        $(document).on("click", "#btnAppsModal",function () {
            $('.eventApp').hide('fast');
            $("#app").removeAttr("data-id")
            $("#app").val("")
            $("#is_app").prop('checked', false);
            $("#is_app").parent().removeClass('is-checked');
        });
        $('#appsModal').on('hide.bs.modal', function (e) {
            $('#appsTable').empty();
        })
        $(document).on('click', '#formSubmit', function(event) {
            event.preventDefault();
            $('.error').html('')
            var data = $('#patient-search-select').select2('data');
            var datax = $('#staff-search-select').select2('data');
            var patient_id = data[0].id;
            var staff_id =  datax[0].id
            var staff =  datax[0].id
            var date = $('#start').val();
            var formatdate = date.split("/").reverse().join("/");
            var dataString = new FormData()
            dataString.append('patient_id', patient_id)
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
            dataString.append('staff_id', staff)
            dataString.append('staff', staff)
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
                    refetchCalendarEvents()
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
                        resetForm()
                        socket.emit('eventCalendarRefetchToServer');
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
            resetForm()
        });
        $(document).on('click', '.closeModal', function(event) {
            event.preventDefault();
            $('#formEdit').html('add').removeAttr('event').attr('id', 'formSubmit')
            $('input').removeAttr("disabled")
            $('#lang').removeAttr('disabled');
            $('#formReset').click();
            $('.error').html('')
        });
        if(canEdit){
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
                        resetForm()
                    },
                    success:function(data)
                    {
                        Toast.fire({
                            icon: data.icon,
                            title: data.msg
                        })

                        if (data.reload) {
                            socket.emit('eventCalendarRefetchToServer');
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

                $(this).removeAttr('data-id')
                $('#title').val(event.title);

                $('#patient').val(event.extendedProps.patient).attr({
                    disabled: true,
                    'data-id': event.extendedProps.patient_id,
                });
                $('#phone').val(event.extendedProps.phone).attr('disabled', true);
                $('#email').val(event.extendedProps.email).attr('disabled', true);
                $('#start').val(moment(event.start).format('DD/MM/YYYY'))

                $('#lang').val(event.extendedProps.lang);
                $('#timeStart').val(event.extendedProps.startTime.slice(0, 5));
                $('#timeEnd').val(event.extendedProps.endTime.slice(0, 5));
                $('#staff').val(event.extendedProps.staff).attr('data-id', event.extendedProps.staff_id);
                $('#notes').val(event.extendedProps.notas);

                var staff = {
                    id: event.extendedProps.staff_id,
                    text: event.extendedProps.staff
                };

                var patient = {
                    id: event.extendedProps.patient_id,
                    text: event.extendedProps.patient
                };

                var newStaff = new Option(staff.text, staff.id, false, false);
                $('#staff-search-select').append(newStaff).trigger('change');
                var newPatient = new Option(patient.text, patient.id, false, false);
                $('#patient-search-select').append(newPatient).trigger('change');



                if (event.extendedProps.isapp == "si") {
                    $('#is_app').parents('.form-group').show('fast')
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
                var data = $('#patient-search-select').select2('data');
                var datax = $('#staff-search-select').select2('data');
                var patient_id = data[0].id;
                var patient = data[0].name;
                var staff_id =  datax[0].id
                var staff =  datax[0].name

                var dataString = new FormData()
                dataString.append('patient_id', patient_id)
                dataString.append('phone', $('#phone').val())
                dataString.append('title', $('#title').val())
                dataString.append('email', $('#email').val())
                dataString.append('isApp', $('#is_app').is(":checked")? '1':"0")
                dataString.append('app', $('#app').attr("data-id"))
                dataString.append('lang', $("#lang option:selected" ).val())
                dataString.append('lang', $("#lang option:selected" ).val())
                dataString.append('patient', patient)
                dataString.append('start', formatdate)
                dataString.append('timeStart', $('#timeStart').val())
                dataString.append('timeEnd', $('#timeEnd').val())
                dataString.append('staff_id', staff_id)
                dataString.append('staff', staff)
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
                        refetchCalendarEvents()
                        if (data.reload) {
                            Toast.fire({
                                icon: data.icon,
                                title: data.msg
                            })
                            resetForm()
                            socket.emit('eventCalendarRefetchToServer');
                        } else {
                            $.each( data.errors, function( key, value ) {
                                $('*[id^='+key+']').parent().find('.error').append('<p>'+value+'</p>')
                            });
                        }
                    }
                });
            });
            $(document).on('change', '[name=status]', function(event) {
                event.preventDefault();
                var dataString = new FormData();
                dataString.append('key', $(this).val());
                dataString.append('event', $('.eventEdit').attr('data-id'));
                $.ajax({
                    type: "POST",
                    url: globalStatusEvent,
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
                       refetchCalendarEvents()
                       socket.emit('eventCalendarRefetchToServer');
                    }
                });
            });
        }
        if(canDestroy){
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
                        socket.emit('eventCalendarRefetchToServer');

                        }
                    }
                });
            }
        }
        $('#start').datetimepicker({
            weekStart: 1,
            todayBtn:  1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            minView: 2,
            forceParse: 0,
            format: 'dd/mm/yyyy',
            startDate: new Date(),
        }).on('changeDate', function (ev) {
            var chengeDate = new Date(ev.date);
            var now = new Date();
            var test = moment(now)
            var testDos = new Date(test);
            var diff = chengeDate.setHours(0,0,0,0) > now.setHours(0,0,0,0);
            if (diff) {
                $('#timeStart').datetimepicker('remove');
                $('#timeStart').datetimepicker({
                    pickDate: false,
                    minuteStep: 10,
                    format: 'HH:ii',
                    autoclose: true,
                    startView: 1,
                    maxView: 1,
                    startDate: chengeDate,
                    minDate: chengeDate,
                }).on('changeDate', function(event) {
                });
                $('#timeEnd').datetimepicker('remove');
                newDate = setTime = moment(new Date(chengeDate)).add(10, 'minutes')
                valTime = moment(new Date(chengeDate)).add(10, 'minutes').format('hh:mm')
                $('#timeEnd').datetimepicker('remove');
                $('#timeEnd').val(valTime)
                $('#timeEnd').datetimepicker({
                    pickDate: false,
                    minuteStep: 10,
                    format: 'HH:ii',
                    autoclose: true,
                    startView: 1,
                    maxView: 1,
                    startDate: new Date(newDate),
                    minDate: new Date(newDate),
                });
            } else {
                $('#timeStart').datetimepicker('remove');
                valDate = moment(new Date()).format('hh:mm')
                valTime = moment(new Date()).add(10, 'minutes').format('hh:mm')
                newTime = moment(new Date()).add(10, 'minutes');
                $('#timeStart').val(valDate)
                $('#timeEnd').val(valTime)
                $('#timeStart').datetimepicker({
                    pickDate: false,
                    minuteStep: 10,
                    format: 'HH:ii',
                    autoclose: true,
                    startView: 1,
                    maxView: 1,
                    startDate: new Date(),
                    minDate: new Date(),
                });
                $('#timeStart').datetimepicker('remove');
                $('#timeStart').datetimepicker({
                    pickDate: false,
                    minuteStep: 10,
                    format: 'HH:ii',
                    autoclose: true,
                    startView: 1,
                    maxView: 1,
                    startDate: new Date(newTime),
                    minDate: new Date(newTime),
                });
            }
        });
        function eventClick(arg) {
            $('#viewEvantModal').on('show.bs.modal', function (e) {
                $('#formEdit').html('add').removeAttr('event').attr('id', 'formSubmit');
                $('.eventEdit').attr('data-id', arg.event.id)
                $('.eventDelete').attr('data-id', arg.event.id)
                $('#formReset').click();
                $('.error').html('')
                $('#myInputautocomplete-list.patient').fadeOut(1000).html('');



                var eventModalBody =' <div class="col-12">\
                                    <div class="title text-center font-weight-bold text-capitalize">' + arg.event.title + '</div>\
                                    </div>\
                                    <div class="col-12">\
                                    <div class="row">\
                                    <div class="col-6">\
                                    <div class="staffName">Staff: ' + arg.event.extendedProps.staff + '</div>\
                                    <div class="patient">Patient: ' + arg.event.extendedProps.patient + '</div>\
                                    <div class="fechaInicio">Date: ' + moment(arg.event.start).format('MMM Do YYYY') + '</div>\
                                    </div>\
                                    <div class="col-6">';
                                if (arg.event.extendedProps.isapp == 'si') {
                                    eventModalBody += '<div class="staffName">Brand: ' + arg.event.extendedProps.application_brand + '</div>';
                                    eventModalBody += '<div class="staffName">Service: ' + arg.event.extendedProps.application_service + '</div>';
                                    eventModalBody += '<div class="staffName">Procedure: ' + arg.event.extendedProps.application_procedure + '</div>';
                                    eventModalBody += '<div class="staffName">Package: ' + arg.event.extendedProps.application_package + '</div>';
                                }
                eventModalBody += '</div>\
                        </div>\
                    </div>\
                    <div class="col-12 text-center">\
                        <div class="notas text">Notes: ' + arg.event.extendedProps.notas + '</div>\
                    </div>\
                ';
                $('')
                $("input[name=status][value=" + arg.event.extendedProps.status + "]").prop('checked', true);
                $('#eventModalBody').html('')
                $('#eventModalBody').html(eventModalBody);
            }).modal('show')
        }
        function refetchCalendarEvents(){
            calendar.refetchEvents()
        }
        function resetForm(){
            $('#formEdit').html('add').removeAttr('event').attr('id', 'formSubmit')
            $('input').removeAttr("disabled")
            $('#lang').removeAttr('disabled');
            $('#formReset').click();
            $('.error').html('')
            $('.eventApp').hide('fast');
            $("#is_app").prop('checked', false);
            $("#is_app").parent().removeClass('is-checked');
            $("#app").removeAttr("data-id")
            $('#is_app').parents('.form-group').hide('fast')
            $('#patient-search-select').val(null).trigger('change');
            $('#staff-search-select').val(null).trigger('change');
        }
        socket.on('eventCalendarRefetchToClient', () => {
            refetchCalendarEvents()
        });
        function getApps(){
            $('#appsModal').on('shown.bs.modal', function (e) {
                var data = $('#patient-search-select').select2('data');
                var id = data[0].id;

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
                    },
                    language: {
                        "url": dataTablesLangEs
                    },
                    "columns": [

                        { data: 'DT_RowIndex' },
                        { data: "action", orderable: false, searchable: false },
                        { data: "code" },
                        { data: "treatment" },
                        { data: "date" },

                    ],
                    createdRow: function (row, data, dataIndex) {
                        $(row).addClass('odd gradeX letras');
                    },
                    initComplete: function() {
                        this.api().responsive.recalc()
                    },
                })
            }).modal(
                {
                        backdrop: 'static',
                        keyboard: true,
                        show: true
                }
            )
        }

    </script>
@endsection
