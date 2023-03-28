@extends('staff.layouts.app')
@section('title')
	@lang('Mail')
@endsection
@section('content')
<div class="page-bar">
    <div class="page-title-breadcrumb">
        <div class=" pull-left">
            <div class="page-title">@lang('staff assignment')</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index-2.html">@lang('breadcrumb.Home')</a>&nbsp;<i class="fa fa-angle-right"></i>
            </li>
            <li class="active">@lang('Configuration')&nbsp;<i class="fa fa-angle-right"></i></li>
            <li class="active">@lang('Mail Manager')</li>
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
                            <div class="col-md-12">
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
                                        <table class="table table-hover table-checkable order-column full-width" id="assignedTable">
                                            <thead>
                                                <tr>
                                                    <th> ID </th>
                                                    <th> @lang('Staff') </th>
                                                    <th> @lang('Assigned to') </th>
                                                    <th> @lang('Action') </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th scope="row">2</th>
                                                    <td>Jacob</td>
                                                    <td>Thornton</td>
                                                    <td>Thornton</td>
                                                </tr>
                                            </tbody>
                                        </table>
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
</div>
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
        
        var globalRouteobtenerLista = "{{ route('staff.asignaciones.getAssignableList') }}";
        // var globalRouteStore = "{{ route('staff.treatments.configuration.storePackage') }}";
        // var globalRouteActivar = "{{ route('staff.treatments.configuration.activatePackage') }}"
        // var globalRouteEditar = "{{ route('staff.treatments.configuration.editPackage') }}"
        // var globalRouteUpdate = "{{ route('staff.treatments.configuration.updatePackage') }}"
        // var globalRouteDestroy = "{{ route('staff.treatments.configuration.destroyPackage') }}"
    </script>

    <script>
        var codigo = 'holis'
        var assignedTable = $('#assignedTable').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ajax:{
                url : globalRouteobtenerLista,
                type: "get",
                data: {"service": codigo},
                error: function (xhr, error, thrown) {
                },
                success: function(data) {
                    console.log("data", data);

                },
             },
            language: {
                "url": dataTablesLangEs
            },
            "columns": [

                { data: 'DT_RowIndex' },
                { data: "image" },
                { data: "brand" },
                { data: "action", orderable: false, searchable: false, className: 'center' },

            ],
            createdRow: function (row, data, dataIndex) {
                $(row).addClass('odd gradeX');
            },
        });
    </script>
@endsection