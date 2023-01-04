@extends('staff.layouts.app')
@section('title')
    @lang('Dashboard')
@endsection
@section('content')
<div class="page-bar">
    <div class="page-title-breadcrumb">
        <div class=" pull-left">
            <div class="page-title">@lang('breadcrumb.Dashboard')</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index-2.html">@lang('breadcrumb.Home')</a>&nbsp;<i class="fa fa-angle-right"></i>
            </li>
            <li class="active">@lang('breadcrumb.Dashboard')</li>
        </ol>
    </div>
</div>
@can('dashboard.wiew')
    <!-- start widget -->
    <div class="state-overview">
        <div class="row">
            <div class="col-xl-3 col-md-6 col-12">
                <div class="info-box bg-white">
                    <span class="info-box-icon push-bottom bg-primary"><i class="material-icons">group</i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Appointments <small class="text-muted" style="font-size: .8rem;">  This month</small></span>
                        <span class="info-box-number countAnimation" id="countNewersEvents" data-counter="counterup" data-value="{{ $countNewersEvents }}">{{ $countNewersEvents }}</span>
                        <div class="progress">
                            <div class="progress-bar bg-primary" id="barEvents" style="width: {{ $incrementEvents }}%;"></div>
                        </div>
                        <span class="progress-description">
                            <span id="incrementEvents">{{ $incrementEvents }}</span>% Increase in the month
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                    <!-- /.info-box -->
            </div>
            <!-- /`.col -->
            <div class="col-xl-3 col-md-6 col-12">
                <div class="info-box bg-white">
                    <span class="info-box-icon push-bottom bg-warning"><i class="material-icons">person</i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">New Patients <small class="text-muted" style="font-size: .8rem;">  This month</small></span>
                        <span class="info-box-number countAnimation" id="countNewersPatients" data-counter="counterup" data-value="{{ $countNewersPatients }}">{{ $countNewersPatients }}</span>
                        <div class="progress">
                            <div class="progress-bar bg-warning" id="barPatients" style="width: {{ $incrementPatients }}%;"></div>
                        </div>
                        <span class="progress-description">
                            <span id="incrementPatients">{{ $incrementPatients }}</span>% Increase in the month
                        </span>
                    </div>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-xl-3 col-md-6 col-12">
                <div class="info-box bg-white">
                    <span class="info-box-icon push-bottom bg-success"><i class="material-icons">content_cut</i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Applications <small class="text-muted" style="font-size: .8rem;">  This month</small></span>
                        <span class="info-box-number countAnimation" id="countNewersApps" data-counter="counterup" data-value="{{ $countNewersApps }}">{{ $countNewersApps }}</span>
                        <div class="progress">
                            <div class="progress-bar bg-success" id="barApps" style="width: {{ $incrementPatients }}%;"></div>
                        </div>
                        <span class="progress-description">
                            <span id="incrementApps">{{ $incrementPatients }}</span>% Increase in the month
                        </span>
                    </div>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-xl-3 col-md-6 col-12">
                <div class="info-box bg-white">
                    <span class="info-box-icon push-bottom bg-info"><i class="material-icons">monetization_on</i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Hospital Earning <small class="text-muted" style="font-size: .8rem;">  This month</small></span>
                        <span>$</span><span id="countNewersPayments" class="info-box-number countAnimation" data-counter="counterup" data-value="{{ $countNewersPayments }}">{{ $countNewersPayments }}</span>
                        <div class="progress">
                            <div class="progress-bar bg-info" id="barPayments" style="width: {{ $incrementPayments }}%;"></div>
                        </div>
                        <span class="progress-description">
                            <span id="incrementPayments">{{ $incrementPayments }}</span>% Increase in the month
                        </span>
                    </div>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card card-box">
                    <div class="card-head">
                        <header>Social media</header>
                        <div class="tools">
                            <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                            <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                            <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                        </div>
                    </div>
                    <div class="card-body " id="chartjs_social_parent">
                        <div class="row">
                            <canvas id="chartjs_social" height="120"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-box">
                    <div class="card-head">
                        <header>DOUGHNUT CHART</header>
                        <div class="tools">
                            <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                            <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                            <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                        </div>
                    </div>
                    <div class="card-body " id="chartjs_doughnut_parentX">
                        <div class="row">
                            <canvas id="chartjs_doughnutX" height="120"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card card-box">
                    <div class="card-head">
                        <header>New Apps</header>
                        <div class="tools">
                            <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                            <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                            <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                        </div>
                    </div>
                    <div class="card-body " id="">
                        <div class="row">
                            <table style="font-size: .8rem;" cellspacing="0" class="table table-hover dt-responsive nowrap" id="applicationsTable">
                                <thead>
                                    <tr id="lastFiveApps d-none">
                                        <th> @lang('Paciente') </th>
                                        <th> @lang('Status') </th>
                                        <th> @lang('Coordinador') </th>
                                        <th> @lang('Fecha') </th>
                                        <th> @lang('Procedimiento') </th>
                                        <th> @lang('Servicio') </th>
                                        <th> @lang('Marca') </th>
                                        <th> @lang('Paquete') </th>
                                        <th> @lang('Código') </th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-box">
                    <div class="card-head">
                        <header>DOUGHNUT CHART</header>
                        <div class="tools">
                            <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                            <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                            <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                        </div>
                    </div>
                    <div class="card-body " id="chartjs_doughnut_parentX">
                        <div class="row">
                            <canvas id="chartjs_doughnutX" height="120"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@else
    <div class="row">
        <div class="col-md-12">
            <div class="card card-box">
                <div class="card-head">
                    <header>Welcome {{ auth()->guard('staff')->user()->name }}</header>
                    <div class="tools">
                        <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                        <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                        <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                    </div>
                </div>
                <div class="card-body no-padding height-9">

                </div>
            </div>
        </div>
    </div>
@endcan
@endsection
@section('scripts')
    <script src="{{ asset('staffFiles/assets/plugins/counterup/jquery.waypoints.min.js') }}" ></script>
    <script src="{{ asset('staffFiles/assets/plugins/counterup/jquery.counterup.min.js') }}" ></script>
    <!--Chart JS-->
    <script src="{{ asset('staffFiles/assets/plugins/chart-js/Chart.bundle.js') }}" ></script>
    <script src="{{ asset('staffFiles/assets/plugins/chart-js/utils.js') }}" ></script>
    {{-- <script src="{{ asset('staffFiles/assets/js/pages/chart/chartjs/chartjs-data.js') }}" ></script> --}}
    </script>
    <script>
        globalRouteLastFiveApps = "{{ route('staff.stats.lastFiveApps') }}";
        globalgetSocialMedia = "{{ route('staff.stats.socialMedia') }}"
    </script>
    <script src="{{ asset('staffFiles/assets/js/customjs/home.min.js') }}"></script>
@endsection
