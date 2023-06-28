@extends('staff.layouts.app')
@section('title')
	@lang('Doctor Schedule')
@endsection
@section('content')

<div class="page-bar">
    <style>
        #calendar {
            height: calc(100vh - 12.4rem) !important
        }

        .fc .fc-button .fc-icon {
            line-height: 1rem;
            font-size: 1.2em
        }

        .fc .fc-scrollgrid {
            border-color: var(--SysOnCloud-200)
        }

        .fc.fc-theme-standard a:not([href]) {
            color: inherit
        }

        .fc.fc-theme-standard .fc-list,
        .fc.fc-theme-standard td,
        .fc.fc-theme-standard th {
            border-color: var(--SysOnCloud-200)
        }

        .fc .fc-col-header {
            background-color: var(--SysOnCloud-100)
        }

        .fc .fc-col-header th {
            border-bottom-width: 1px
        }

        .fc .fc-col-header-cell-cushion {
            text-decoration: none !important
        }

        .fc .fc-daygrid-day-frame {
            border: 2px solid transparent;
            padding: 2px !important;
            -webkit-transition: all .2s ease-in-out;
            -o-transition: all .2s ease-in-out;
            transition: all .2s ease-in-out
        }

        .fc .fc-daygrid-day-frame:active {
            background-color: rgba(44, 123, 229, .1) !important
        }

        .fc .fc-daygrid-day-top {
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            margin-bottom: .25rem
        }

        .fc .fc-daygrid-day-number {
            width: 1.875rem;
            height: 1.875rem;
            background-color: var(--SysOnCloud-100);
            text-align: center;
            text-decoration: none !important;
            border-radius: 50%;
            line-height: 1.875rem;
            padding: 0 !important;
            font-size: .8333333333rem;
            -webkit-transition: all .2s ease-in-out;
            -o-transition: all .2s ease-in-out;
            transition: all .2s ease-in-out
        }

        .fc .fc-daygrid-day-number:hover,
        .fc .fc-daygrid-day-number:focus {
            background-color: var(--SysOnCloud-200)
        }

        .fc .fc-daygrid-bg-harness {
            top: -2px
        }

        .fc .fc-daygrid-event {
            border-radius: .25rem !important;
            margin-top: 0;
            margin-bottom: .25rem !important;
            padding: .25rem .5rem !important;
            border: 0 !important;
            font-size: .6944444444rem
        }

        .fc .fc-h-event {
            background-color: #e6effc
        }

        .fc .fc-h-event .fc-event-main {
            color: #fff
        }

        .fc .fc-h-event .fc-event-time,
        .fc .fc-h-event .fc-event-title {
            font-weight: 600 !important
        }

        .fc .fc-event-title {
            font-weight: normal !important
        }

        .fc .fc-daygrid-event-dot {
            border-color: var(--SysOnCloud-300) !important
        }

        .fc .fc-day-today:not(.fc-popover) {
            background-color: transparent !important
        }

        .fc .fc-day-today:not(.fc-popover) .fc-daygrid-day-frame {
            border: 2px solid rgba(44, 123, 229, .5)
        }

        .fc .fc-day-today:not(.fc-popover) .fc-daygrid-day-number {
            background-color: #2c7be5 !important;
            color: #fff
        }

        .fc .fc-day-today:not(.fc-popover) .fc-daygrid-day-number:hover,
        .fc .fc-day-today:not(.fc-popover) .fc-daygrid-day-number:focus {
            background-color: #1862c6 !important
        }

        .fc.fc-direction-rtl .fc-daygrid-event.fc-event-start,
        .fc.fc-direction-rtl .fc-daygrid-event.fc-event-end,
        .fc.fc-direction-ltr .fc-daygrid-event.fc-event-start,
        .fc.fc-direction-ltr .fc-daygrid-event.fc-event-end {
            margin-left: 0;
            margin-right: 0
        }

        .fc .fc-popover {
            border-color: var(--SysOnCloud-border-color);
            -webkit-box-shadow: var(--SysOnCloud-box-shadow);
            box-shadow: var(--SysOnCloud-box-shadow)
        }

        .fc .fc-popover .fc-popover-title {
            font-family: "Poppins", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol"
        }

        .fc .fc-popover .fc-daygrid-event {
            margin-left: 0 !important;
            margin-right: 0 !important;
            margin-bottom: 2px !important
        }

        .fc .fc-popover-header {
            padding-left: .625rem;
            padding-right: .625rem;
            font-size: .875rem;
            font-weight: 600;
            border-top-left-radius: .375rem;
            border-top-right-radius: .375rem;
            background: var(--SysOnCloud-popover-header-bg)
        }

        .fc .fc-daygrid-more-link {
            display: block;
            text-align: center;
            color: var(--SysOnCloud-500) !important;
            font-size: .6944444444rem
        }

        .fc .fc-daygrid-more-link:hover,
        .fc .fc-daygrid-more-link:focus {
            text-decoration: none;
            color: var(--SysOnCloud-600) !important
        }

        .fc .fc-daygrid-dot-event {
            color: var(--SysOnCloud-500) !important
        }

        .fc .fc-daygrid-dot-event:hover,
        .fc .fc-daygrid-dot-event:focus {
            background-color: var(--SysOnCloud-200) !important
        }

        .fc .fc-day:not(.fc-popover) .fc-daygrid-dot-event {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center
        }

        .fc .fc-day:not(.fc-popover) .fc-daygrid-dot-event .fc-event-time,
        .fc .fc-day:not(.fc-popover) .fc-daygrid-dot-event .fc-event-title {
            display: none
        }

        .fc .fc-list-event:hover td {
            background-color: unset
        }

        .fc .fc-dayGridMonth-view .fc-event-time {
            display: none
        }

        .fc .fc-timeGridDay-view .fc-scrollgrid-sync-inner {
            text-align: left
        }

        .fc .fc-timeGridDay-view .fc-daygrid-day-events,
        .fc .fc-timeGridWeek-view .fc-daygrid-day-events {
            margin-bottom: 0
        }

        .fc .fc-timeGridDay-view .fc-v-event .fc-event-main,
        .fc .fc-timeGridWeek-view .fc-v-event .fc-event-main {
            padding-left: 1rem;
            color: var(--SysOnCloud-500)
        }

        .fc .fc-timeGridDay-view .fc-v-event .fc-event-main:after,
        .fc .fc-timeGridWeek-view .fc-v-event .fc-event-main:after {
            content: "";
            position: absolute;
            height: .625rem;
            width: .625rem;
            border-radius: 50%;
            background-color: var(--SysOnCloud-400);
            top: .3125rem;
            left: 0
        }

        .fc .fc-timeGridDay-view .fc-timegrid-event,
        .fc .fc-timeGridWeek-view .fc-timegrid-event {
            padding: .5rem;
            background-color: transparent;
            border: 0;
            border-radius: .375rem
        }

        .fc .fc-timeGridDay-view .fc-timegrid-event:hover,
        .fc .fc-timeGridDay-view .fc-timegrid-event:focus,
        .fc .fc-timeGridWeek-view .fc-timegrid-event:hover,
        .fc .fc-timeGridWeek-view .fc-timegrid-event:focus {
            background-color: var(--SysOnCloud-200)
        }

        .fc .fc-timeGridDay-view .fc-timegrid-slot,
        .fc .fc-timeGridWeek-view .fc-timegrid-slot {
            height: 2rem
        }

        .fc .fc-timeGridDay-view .fc-timegrid-slot-lane,
        .fc .fc-timeGridWeek-view .fc-timegrid-slot-lane {
            cursor: pointer
        }

        .fc .fc-timeGridDay-view .fc-timegrid-slot-lane:active,
        .fc .fc-timeGridWeek-view .fc-timegrid-slot-lane:active {
            background-color: var(--SysOnCloud-100)
        }

        .fc .fc-timeGridDay-view .fc-timegrid-col,
        .fc .fc-timeGridWeek-view .fc-timegrid-col {
            padding: .375rem !important
        }

        .fc .fc-list .fc-list-day-cushion {
            padding: .5rem 1.25rem;
            background-color: var(--fc-button-list-day-cushion)
        }

        .fc .fc-list .fc-list-day:not(:first-child) .fc-list-day-cushion {
            margin-top: 1.8rem
        }

        .fc .fc-list .fc-list-event-time {
            padding-left: 1.25rem
        }

        .fc .fc-list .fc-list-event-title {
            padding-right: 1.25rem
        }

        .fc .fc-list-empty {
            background-color: var(--SysOnCloud-100)
        }

        .fc .fc-list-event-dot {
            border-color: var(--SysOnCloud-300)
        }

        .fc-timegrid .event-bg-soft-primary {
            border: 0 !important
        }

        .fc-timegrid .event-bg-soft-primary .fc-event-main:after {
            background-color: #2c7be5 !important
        }

        .bg-soft-primary .fc-event-main,
        .fc-timegrid .event-bg-soft-primary .fc-event-main {
            color: #1862c6 !important
        }

        .bg-soft-primary .fc-event-main:after,
        .fc-timegrid .event-bg-soft-primary .fc-event-main:after {
            background-color: #1862c6 !important
        }

        .bg-soft-primary .fc-list-event-time,
        .fc-timegrid .event-bg-soft-primary .fc-list-event-time,
        .bg-soft-primary .fc-list-event-title,
        .fc-timegrid .event-bg-soft-primary .fc-list-event-title {
            color: #1862c6 !important;
            font-weight: 600 !important
        }

        .bg-soft-primary .fc-list-event-dot,
        .fc-timegrid .event-bg-soft-primary .fc-list-event-dot {
            border-color: #1862c6
        }

        .fc-timegrid .event-bg-soft-secondary {
            border: 0 !important
        }

        .fc-timegrid .event-bg-soft-secondary .fc-event-main:after {
            background-color: #748194 !important
        }

        .bg-soft-secondary .fc-event-main,
        .fc-timegrid .event-bg-soft-secondary .fc-event-main {
            color: #5d6878 !important
        }

        .bg-soft-secondary .fc-event-main:after,
        .fc-timegrid .event-bg-soft-secondary .fc-event-main:after {
            background-color: #5d6878 !important
        }

        .bg-soft-secondary .fc-list-event-time,
        .fc-timegrid .event-bg-soft-secondary .fc-list-event-time,
        .bg-soft-secondary .fc-list-event-title,
        .fc-timegrid .event-bg-soft-secondary .fc-list-event-title {
            color: #5d6878 !important;
            font-weight: 600 !important
        }

        .bg-soft-secondary .fc-list-event-dot,
        .fc-timegrid .event-bg-soft-secondary .fc-list-event-dot {
            border-color: #5d6878
        }

        .fc-timegrid .event-bg-soft-success {
            border: 0 !important
        }

        .fc-timegrid .event-bg-soft-success .fc-event-main:after {
            background-color: #00d27a !important
        }

        .bg-soft-success .fc-event-main,
        .fc-timegrid .event-bg-soft-success .fc-event-main {
            color: #009f5c !important
        }

        .bg-soft-success .fc-event-main:after,
        .fc-timegrid .event-bg-soft-success .fc-event-main:after {
            background-color: #009f5c !important
        }

        .bg-soft-success .fc-list-event-time,
        .fc-timegrid .event-bg-soft-success .fc-list-event-time,
        .bg-soft-success .fc-list-event-title,
        .fc-timegrid .event-bg-soft-success .fc-list-event-title {
            color: #009f5c !important;
            font-weight: 600 !important
        }

        .bg-soft-success .fc-list-event-dot,
        .fc-timegrid .event-bg-soft-success .fc-list-event-dot {
            border-color: #009f5c
        }

        .fc-timegrid .event-bg-soft-info {
            border: 0 !important
        }

        .fc-timegrid .event-bg-soft-info .fc-event-main:after {
            background-color: #27bcfd !important
        }

        .bg-soft-info .fc-event-main,
        .fc-timegrid .event-bg-soft-info .fc-event-main {
            color: #02a7ef !important
        }

        .bg-soft-info .fc-event-main:after,
        .fc-timegrid .event-bg-soft-info .fc-event-main:after {
            background-color: #02a7ef !important
        }

        .bg-soft-info .fc-list-event-time,
        .fc-timegrid .event-bg-soft-info .fc-list-event-time,
        .bg-soft-info .fc-list-event-title,
        .fc-timegrid .event-bg-soft-info .fc-list-event-title {
            color: #02a7ef !important;
            font-weight: 600 !important
        }

        .bg-soft-info .fc-list-event-dot,
        .fc-timegrid .event-bg-soft-info .fc-list-event-dot {
            border-color: #02a7ef
        }

        .fc-timegrid .event-bg-soft-warning {
            border: 0 !important
        }

        .fc-timegrid .event-bg-soft-warning .fc-event-main:after {
            background-color: #f5803e !important
        }

        .bg-soft-warning .fc-event-main,
        .fc-timegrid .event-bg-soft-warning .fc-event-main {
            color: #f2600e !important
        }

        .bg-soft-warning .fc-event-main:after,
        .fc-timegrid .event-bg-soft-warning .fc-event-main:after {
            background-color: #f2600e !important
        }

        .bg-soft-warning .fc-list-event-time,
        .fc-timegrid .event-bg-soft-warning .fc-list-event-time,
        .bg-soft-warning .fc-list-event-title,
        .fc-timegrid .event-bg-soft-warning .fc-list-event-title {
            color: #f2600e !important;
            font-weight: 600 !important
        }

        .bg-soft-warning .fc-list-event-dot,
        .fc-timegrid .event-bg-soft-warning .fc-list-event-dot {
            border-color: #f2600e
        }

        .fc-timegrid .event-bg-soft-danger {
            border: 0 !important
        }

        .fc-timegrid .event-bg-soft-danger .fc-event-main:after {
            background-color: #e63757 !important
        }

        .bg-soft-danger .fc-event-main,
        .fc-timegrid .event-bg-soft-danger .fc-event-main {
            color: #d01a3b !important
        }

        .bg-soft-danger .fc-event-main:after,
        .fc-timegrid .event-bg-soft-danger .fc-event-main:after {
            background-color: #d01a3b !important
        }

        .bg-soft-danger .fc-list-event-time,
        .fc-timegrid .event-bg-soft-danger .fc-list-event-time,
        .bg-soft-danger .fc-list-event-title,
        .fc-timegrid .event-bg-soft-danger .fc-list-event-title {
            color: #d01a3b !important;
            font-weight: 600 !important
        }

        .bg-soft-danger .fc-list-event-dot,
        .fc-timegrid .event-bg-soft-danger .fc-list-event-dot {
            border-color: #d01a3b
        }

        .fc-timegrid .event-bg-soft-light {
            border: 0 !important
        }

        .fc-timegrid .event-bg-soft-light .fc-event-main:after {
            background-color: #f9fafd !important
        }

        .bg-soft-light .fc-event-main,
        .fc-timegrid .event-bg-soft-light .fc-event-main {
            color: #d3daf0 !important
        }

        .bg-soft-light .fc-event-main:after,
        .fc-timegrid .event-bg-soft-light .fc-event-main:after {
            background-color: #d3daf0 !important
        }

        .bg-soft-light .fc-list-event-time,
        .fc-timegrid .event-bg-soft-light .fc-list-event-time,
        .bg-soft-light .fc-list-event-title,
        .fc-timegrid .event-bg-soft-light .fc-list-event-title {
            color: #d3daf0 !important;
            font-weight: 600 !important
        }

        .bg-soft-light .fc-list-event-dot,
        .fc-timegrid .event-bg-soft-light .fc-list-event-dot {
            border-color: #d3daf0
        }

        .fc-timegrid .event-bg-soft-dark {
            border: 0 !important
        }

        .fc-timegrid .event-bg-soft-dark .fc-event-main:after {
            background-color: #0b1727 !important
        }

        .bg-soft-dark .fc-event-main,
        .fc-timegrid .event-bg-soft-dark .fc-event-main {
            color: #000 !important
        }

        .bg-soft-dark .fc-event-main:after,
        .fc-timegrid .event-bg-soft-dark .fc-event-main:after {
            background-color: #000 !important
        }

        .bg-soft-dark .fc-list-event-time,
        .fc-timegrid .event-bg-soft-dark .fc-list-event-time,
        .bg-soft-dark .fc-list-event-title,
        .fc-timegrid .event-bg-soft-dark .fc-list-event-title {
            color: #000 !important;
            font-weight: 600 !important
        }

        .bg-soft-dark .fc-list-event-dot,
        .fc-timegrid .event-bg-soft-dark .fc-list-event-dot {
            border-color: #000
        }

        [data-fc-view]:not(.active) .icon-check {
            opacity: 0
        }

        .timeline li {
            position: relative;
            padding-left: 1.5rem
        }

        .timeline li:after {
            position: absolute;
            content: "";
            height: .625rem;
            width: .625rem;
            border-radius: 50%;
            background: var(--SysOnCloud-200);
            left: 0;
            top: 50%;
            -webkit-transform: translateY(-50%);
            -ms-transform: translateY(-50%);
            transform: translateY(-50%)
        }

        .timeline li:not(:last-child):before {
            position: absolute;
            content: "";
            height: 100%;
            width: 1px;
            background-color: var(--SysOnCloud-200);
            top: 50%;
            left: .3125rem
        }

        .windows.chrome .fc-scroller {
            overflow: hidden auto !important;
            overflow: auto
        }

        .windows.chrome .fc-scroller::-webkit-scrollbar {
            visibility: hidden;
            -webkit-appearance: none;
            width: 6px;
            height: 6px;
            background-color: transparent
        }

        .windows.chrome .fc-scroller::-webkit-scrollbar-thumb {
            visibility: hidden;
            border-radius: 3px;
            background-color: var(--SysOnCloud-scrollbar-bg)
        }

        .windows.chrome .fc-scroller:hover::-webkit-scrollbar,
        .windows.chrome .fc-scroller:hover::-webkit-scrollbar-thumb,
        .windows.chrome .fc-scroller:focus::-webkit-scrollbar,
        .windows.chrome .fc-scroller:focus::-webkit-scrollbar-thumb {
            visibility: visible
        }

        .windows.firefox .fc-scroller {
            overflow: hidden auto !important;
            overflow: auto !important;
            scrollbar-color: var(--SysOnCloud-scrollbar-bg) transparent;
            scrollbar-width: thin
        }

        @media(min-width: 768px) {
            .fc .fc-daygrid-day-frame {
                padding: .375rem !important
            }
            .fc .fc-day:not(.fc-popover) .fc-daygrid-dot-event .fc-event-time,
            .fc .fc-day:not(.fc-popover) .fc-daygrid-dot-event .fc-event-title {
                display: block
            }
            .fc .fc-daygrid-more-link {
                margin-left: .625rem;
                text-align: left;
                font-size: .8333333333rem
            }
            .fc .fc-daygrid-event {
                font-size: .8333333333rem
            }
            #calendar {
                height: calc(100%) !important
            }
        }

        .ie .fc-daygrid-event {
            overflow: hidden
        }

        .safari .fc-dayGridMonth-view .fc-daygrid-day {
            position: relative
        }

        .safari .fc-dayGridMonth-view .fc-daygrid-day .fc-daygrid-day-frame {
            position: absolute;
            left: 0;
            top: 0;
            right: 0;
            bottom: 0
        }

        .fc .fc-timegrid-axis-frame,
        .fc-list-event-time {
            text-transform: capitalize
        }

    </style>
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
    <div class="col-12 col-xl-9">
         <div class="card-box">
             <div class="card-head">
                 <header>Calendar</header>
             </div>
             <div class="card-body">
                <div class="panel-body p-0">
                        <div id="calendar" class="has-toolbar"> </div>
                    </div>
             </div>
         </div>
     </div>
     <div class="col-12 col-xl-3">
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
                        {{-- Nedds PreOps --}}
                        <div class="form-group mb-2 needPreOps" style="display: none">
                            <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Need PreOps date?')
                                <span class="required">  </span>
                            </label>
                            <div class="col-md-12">
                                <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="needPreOps">
                                    <input type="checkbox" id="needPreOps" name="needPreOps" value="1" class="mdl-checkbox__input">
                                    <span class="mdl-checkbox__label"></span>
                                </label>
                            </div>
                        </div>
                        <div class="datePreOps" style="display: none">
                            <div class="form-group mb-2">
                                <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Title')
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-12">
                                    <input type="text" name="title-PreOps" id="titlePreOps" placeholder="@lang('Title')" class="form-control input-sm" />
                                    <div class="error text-danger col-form-label-sm"></div>
                                </div>
                            </div>
                            <div class="form-group mb-2 ">
                                <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">Date Of PreOps
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-12">
                                    <div class="input-group date form_date"  data-date="" data-date-format="dd MM yyyy" onkeyup="if (/[^\d/]/g.test(this.value)) this.value = this.value.replace(/[^\d/]/g,'')" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                                        <input class="form-control input-sm" size="16" name="datePreOps" id="datePreOps" placeholder="" type="text">
                                        <div class="error text-danger col-form-label-sm"></div>
                                    </div>
                                    <small id="emailHelp" class="form-text text-muted">Format mm/dd/yyyy</small>
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Note')
                                </label>
                                <div class="col-md-12">
                                    <textarea name="address" class="form-control-textarea mb-5" name="notesPreOps" id="notesPreOps" placeholder="@lang('Note')" rows="5" style="font-size: 12px;resize: none"></textarea>
                                    <div class="error text-danger col-form-label-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">Date Of Surgery
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-12">
                                <div class="input-group date form_date"  data-date="" data-date-format="MM dd yyyy" onkeyup="if (/[^\d/]/g.test(this.value)) this.value = this.value.replace(/[^\d/]/g,'')" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
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
                                <input type="hidden" id="dtp_input3">
                            </div>
                        </div>
                        {{-- <div class="form-group mb-2">
                            <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">To
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-12">
                                <div class="input-group date form_date"  data-date="" data-date-format="hh:ii" data-link-field="dtp_input4" data-link-format="hh:ii">
                                    <input class="form-control input-sm" size="16" name="timeEnd" id="timeEnd" placeholder="" type="time">
                                    <div class="error text-danger col-form-label-sm"></div>
                                </div>
                            </div>
                        </div> --}}

                        <div class="form-group mb-2" id="idStaffArea" style="display: none">
                            <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Staff')
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-12 aqui" id="staffArea">
                                
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
                <div class="col-12 d-flex">
                    <div class="col-12 d-flex flex-row justify-content-center">
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
                </div>
                <div class="modal-footer flex-nowrap">
                    
                    <div class="col-12 d-flex flex-wrap justify-content-center">
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
    <script src="{{ asset('staffFiles/assets/plugins/fullcalendar-6.1.4/dist/index.global.min.js') }}"></script>
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
        var globalGetAppsStaff = "{{ route('staff.events.getAppsStaff') }}"
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
                longPressDelay: 0,
                initialView: 'listWeek',
                dayMaxEvents: 2,
                locale: initialLocaleCode,
                navLinks: true,
                editable: false,
                eventDisplay: 'block',
                dayMaxEventRows: 1, // for all non-TimeGrid views
                views: {
                    timeGrid: {
                        dayMaxEventRows: 6 // adjust to 6 only for timeGridWeek/timeGridDay
                    }
                },
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

        $('#notes').summernote({
            placeholder: 'Notes',
            height: 350,
            toolbar: false,
            disableResizeEditor: true,
        })
        $('#notesPreOps').summernote({
            placeholder: 'Notes',
            height: 350,
            toolbar: false,
            disableResizeEditor: true,
        })
        
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
                var appData = data.app;
                var $isAppFormGroup = $('#is_app').parents('.form-group');

                $('#staffArea').html('');
                
                $("#is_app").prop('checked', false);
                $("#is_app").parent().removeClass('is-checked');
                $('#needPreOps').prop('checked', false);
                $("#needPreOps").parent().removeClass('is-checked');

                $('#staffArea').html('');
                $('#idStaffArea').hide('fast')
                $('.needPreOps').hide('fast');

                if (appData.length === 0) {
                    $isAppFormGroup.hide('fast');
                } else {
                    $isAppFormGroup.show('fast');
                }
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
                    console.log("data", data);
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
            $('#staffArea').html('');
            $('#idStaffArea').hide('fast')
            if ($('#is_app').is(":checked")) {
                $('.eventApp').show('fast');
                $('.needPreOps').show('fast');
                getApps()
            } else {
                $('.eventApp').hide('fast');
                $('.needPreOps').hide('fast');
                $("#app").removeAttr("data-id")
                $("#app").val("")
            }
        });
        $(document).on('click', "#needPreOps", function() {
            if ($('#needPreOps').is(":checked")) {
                $('.datePreOps').show('fast');
            } else {
                $('.datePreOps').hide('fast');
                $('#titlePreOps').val('')
                $('#datePreOps').val('')
                $('#notesPreOps').val('')
            }
        });
        $(document).on('click', ".btn-add", function () {
            $("#app").val($(this).attr("name"))
            $("#app").attr("data-id", $(this).attr("data-id"))
            getStaffApps($(this).attr("data-id"))
            $('#appsModal').modal("hide")
        });
        $(document).on("click", "#btnAppsModal",function () {
            $('.eventApp').hide('fast');
            $('.needPreOps').hide('fast');
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
            var staff_id =  $('input[name="staffcustomRadio"]:checked').attr('data-id');
            var staff =  $('input[name="staffcustomRadio"]:checked').attr('data-name');
            var date = $('#start').val();
            var formatdate = date.split("/").reverse().join("/");
            var needPreOps = $('#needPreOps').is(":checked")? '1':"0"

            var dataString = new FormData()

            if (needPreOps == "1") {
                var datePreops = $('#datePreOps').val();
                var needPreOpsDate = datePreops.split("/").reverse().join("/");

                dataString.append('needPreOpsDate', needPreOpsDate)
            }
            
            dataString.append('patient_id', patient_id)
            dataString.append('phone', $('#phone').val())
            dataString.append('title', $('#title').val())
            dataString.append('email', $('#email').val())
            dataString.append('isApp', $('#is_app').is(":checked")? '1':"0")
            dataString.append('needPreOps', needPreOps)
            dataString.append('app', $('#app').attr("data-id"))
            dataString.append('lang', $("#lang option:selected" ).val())
            dataString.append('patient', $('#patient').val())
            dataString.append('start', formatdate)
            dataString.append('timeStart', $('#timeStart').val())
            dataString.append('timeEnd', $('#timeEnd').val())
            dataString.append('staff_id', staff_id)
            dataString.append('staff', staff)
            dataString.append("titlePreOps", $('#titlePreOps').val());
            dataString.append("notesPreOps", $('#notesPreOps').val());
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

                console.log(event)
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
                $('#notes').summernote('code', event.extendedProps.notas);

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
                $('#patient-search-select').empty().attr('placeholder', "Select click here").trigger('change')
                var newPatient = new Option(patient.text, patient.id, false, false);
                console.log(newPatient);
                $('#patient-search-select').append(newPatient).trigger('change');


                if (event.extendedProps.application_id != 0) {
                    getStaffApps(event.extendedProps.application_id);
                }

                if (event.extendedProps.isapp == "si") {
                    $('#is_app').parents('.form-group').show('fast')
                    $("#is_app").prop('checked', true);
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
                console.log(data);
                var datax = $('#staff-search-select').select2('data');
                var patient_id = data[0].id;
                var patient = data[0].name;
                var staff_id =  $('input[name="staffcustomRadio"]:checked').attr('data-id');
                var staff =  $('input[name="staffcustomRadio"]:checked').attr('data-name');

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
                        console.log(data);
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
        $('#start, #datePreOps').datetimepicker({
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
                    pickSeconds: false,
                    pick12HourFormat: false, 
                    minuteStep: 60,
                    format: 'HH:ii',
                    autoclose: true,
                    startView: 1,
                    maxView: 1,
                    startDate: chengeDate,
                    minDate: chengeDate,
                }).on('changeDate', function(event) {
                });
                $('#timeEnd').datetimepicker('remove');
                newDate = setTime = moment(new Date(chengeDate)).add(60, 'minutes')
                valTime = moment(new Date(chengeDate)).add(10, 'minutes').format('hh:mm')
                $('#timeEnd').datetimepicker('remove');
                $('#timeEnd').val(valTime)
                $('#timeEnd').datetimepicker({
                    pickDate: false,
                    pickSeconds: false,
                    pick12HourFormat: false, 
                    minuteStep: 60,
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
                valTime = moment(new Date()).add(60, 'minutes').format('hh:mm')
                newTime = moment(new Date()).add(60, 'minutes');
                $('#timeStart').val(valDate)
                $('#timeEnd').val(valTime)
                $('#timeStart').datetimepicker({
                    pickDate: false,
                    pickSeconds: false,
                    pick12HourFormat: false, 
                    minuteStep: 60,
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
                    pickSeconds: false,
                    pick12HourFormat: false,            
                    minuteStep: 60,
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
            $('.needPreOps').hide('fast');
            $("#needPreOps").prop('checked', false);
            $("#needPreOps").parent().removeClass('is-checked');
            $('#titlePreOps').val('')
            $('#datePreOps').val('')
            $('#notesPreOps').val('')
            $('#notes').summernote('code', '');
            $('#notesPreOps').summernote('code', '');
            $('#patient-search-select').empty().attr('placeholder', "Select click here").trigger('change')
            $('#staffArea').html('');
            $('#idStaffArea').hide('fast')
            $("#is_app").prop('checked', false);
            $("#is_app").parent().removeClass('is-checked');
            $('#needPreOps').prop('checked', false);
            $("#needPreOps").parent().removeClass('is-checked');
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
        function getStaffApps(id){
            var dataString = new FormData()
            dataString.append('app', id)
            $.ajax({
                type: "POST",
                url: globalGetAppsStaff,
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
                    if (data.staff.length > 0) {
                        let radios = '';
                        data.staff.forEach(element => {
                            radios += `
                                <div class="custom-control custom-radio">
                                    <input type="radio" data-name="${element.name}" data-id="${element.id}" id="customRadio${element.id}" data-ass="${data.ass_ass}" data-old="${element.id == data.asignado ? 'checked' : ''}" name="staffcustomRadio" class="custom-control-input" ${element.id == data.asignado ? 'checked' : ''}>
                                    <label class="custom-control-label" for="customRadio${element.id}">${element.name}</label>
                                </div>`;
                        });
                        $('#idStaffArea').show('fast')
                        $('#staffArea').append(radios);
                    }
                }
            });
        }
    </script>
@endsection
