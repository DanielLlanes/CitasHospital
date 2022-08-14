@extends('partners.layouts.app')
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
            <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="{{ route('partners.dashboard') }}">@lang('breadcrumb.Home')</a>&nbsp;<i class="fa fa-angle-right"></i>
            </li>
            <li class="active">@lang('breadcrumb.Dashboard')</li>
        </ol>
    </div>
</div>
<div class="state-overview">
    <div class="row">
        <div class="col-xl-3 col-md-6 col-12">
            <div class="info-box bg-white">
                <span class="info-box-icon push-bottom bg-primary"><i class="material-icons">group</i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Aplicaciones <small class="text-muted" style="font-size: .8rem;">  This month</small></span>
                    <span class="info-box-number countAnimation" id="countNewersEvents" data-counter="counterup" data-value="20">20</span>
                    <div class="progress">
                        <div class="progress-bar bg-primary" id="barEvents" style="width: 20%;"></div>
                    </div>
                    <span class="progress-description">
                        <span id="incrementEvents">2</span>% Increase in the month
                    </span>
                </div>
            </div>
        </div>
        <div class="col-xl-9 col-md-12">
            <div class="info-box bg-white" style="height: 156.03px;">
                <div class="info-box-content">
                    
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-box">
                <div class="card-head">
                    <header>Aplicaciones</header>
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
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection