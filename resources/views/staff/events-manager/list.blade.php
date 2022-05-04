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
            calendar.render();
        })
    </script>
    <script src="{{ asset('staffFiles/assets/js/customjs/event.min.js') }}"></script>
@endsection
