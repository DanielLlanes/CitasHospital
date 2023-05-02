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
                    <span class="info-box-text">Appointments <small class="text-muted" style="font-size: .8rem;">  This month</small></span>
                    <span class="info-box-number countAnimation" id="countNewersEvents" data-counter="counterup" data-value=""></span>
                    <div class="progress">
                        <div class="progress-bar bg-primary" id="barEvents" style="width: 20%;"></div>
                    </div>
                    <span class="progress-description">
                    <span id="incrementEvents"></span>% Increase in the month
                    </span>
                </div>
            </div>
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
                                            <header>Partners Info</header>
                                            <div class="tools">
                                                <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                                                <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                                <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                                            </div>
                                        </div>
                                        <div class="card-body text-dark">
                                            {{ Auth()->guard('partners')->user()->name }} <br>  
                                            {{ Auth()->guard('partners')->user()->company }} <br>
                                            {{ Auth()->guard('partners')->user()->website }} <br>
                                            {{ Auth()->guard('partners')->user()->email }} <br>
                                            {{ url('/partners/es/'.Auth()->guard('partners')->user()->code) }} <br>
                                            {{ url('/partners/en/'.Auth()->guard('partners')->user()->code) }} <br>
                                            @php
                                                $randomString = substr(uniqid(), 0, 15);
                                                $randomString = bin2hex(random_bytes(5));
                                            @endphp
                                            {{ $randomString }}
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
                                                <table style="width:100%; min-width:100% height:20px;" class="table table-hover dt-responsive nowrap" id="applicationsTable">
                                                    <thead>
                                                        <tr>
                                                            <th> ID </th>
                                                            <th> @lang('Status') </th>
                                                            <th> @lang('Paciente') </th>
                                                            <th> @lang('Marca') </th>
                                                            <th> @lang('Servicio') </th>
                                                            <th> @lang('Procedimiento') </th>
                                                            <th> @lang('Paquete') </th>
                                                            <th> @lang('Coordinador') </th>
                                                            <th> @lang('Fecha') </th>
                                                            {{-- 
                                                            <th> @lang('Precio') </th>
                                                            <th> @lang('Statring Price') </th>
                                                            --}}
                                                            <th> @lang('Código') </th>
                                                            <th> @lang('Promotor') </th>
                                                            <th> @lang('Acciones') </th>
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
        var globalRouteobtenerLista = "{{ route('partners.applications.getList') }}";

        $(document).ready(function() {
            var codigo = 1;
            var applicationsTable = $('#applicationsTable').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax:{
                    url : globalRouteobtenerLista,
                    type: "get",
                    data: {"estable": codigo},
                    error: function (xhr, error, thrown) {
                    },
                 },
                language: {
                    "url": dataTablesLangEs
                },
                "columns": [

                    { data: 'id' },
                    { data: "paciente" },
                    { data: "marca" },
                    { data: "servicio" },
                    { data: "procedimiento" },
                    { data: "paquete" },
                    { data: "coordinador" },
                    { data: "fecha" },
                    { data: "status" },
                    { data: "codigo" },
                    { data: "complete"},

                ],
                createdRow: function (row, data, dataIndex) {
                    $(row).addClass('odd gradeX');
                },
            });

            socket.on('updateDataTablesToClient', () =>  {
                applicationsTable.ajax.reload( null, false );
            });

            $(document).on('click', '#formCancel', function () {
                clearForm()
            });
            function clearForm(){
                $('#formReset').click();
                $('#formEdit')
                .removeAttr('package')
                .html('Add')
                .attr('id', 'formSubmit')
            }

            $(document).on('click', '.table-active', function(event) {
                event.preventDefault();
                var form_data = new FormData();
                form_data.append('id', $(this).attr('attr-id'));
                $.ajax({
                    url: globalRouteActivar,
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
                            applicationsTable.ajax.reload( null, false );
                        }
                    },
                    complete: function()
                    {
                    },
                })
            });

            $(document).on('click', '.btn-tbl-edit', function (event) {
                var packageId = $(this).attr('data-id')
                var form_data = new FormData();
                form_data.append('id', packageId);
                $.ajax({
                    url: globalRouteEditar,
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
                        if (data.success) {
                            clearForm()
                            $('#package_en').val(data.info.package_en);
                            $('#package_es').val(data.info.package_es);
                            $('#formSubmit').html('edit').attr({
                                package: $.trim(packageId),
                                id: 'formEdit'
                            });
                        } else {
                            Toast.fire({
                                icon: data.icon,
                                title: data.msg
                            })
                            applicationsTable.ajax.reload( null, false );
                            clearForm()
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
            });

            $(document).on('click', '#formEdit', function (event) {
                var packageId = $(this).attr('package')
                var form_data = new FormData();
                form_data.append('package_en', $('#package_en').val());
                form_data.append('package_es', $('#package_es').val());
                form_data.append('id', packageId);
                $.ajax({
                    url: globalRouteUpdate,
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
                            applicationsTable.ajax.reload( null, false );
                            clearForm()
                        } else {
                            $.each( data.errors, function( key, value ) {
                                $('*[id^='+key+']').parent().find('.error').append('<p>'+value+'</p>')
                            });
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
            });

            $(document).on('click', '.eliminar', function(e) {
                e.preventDefault();
                var id = $(this).attr('data-id');
                Swal.fire({
                    title: '¿Esta seguro?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, borrarlo!'
                }).then((result) => {
                    if (result.value) {
                        deleteRecord(id)
                    } else if (result.dismiss) {
                        Swal.fire(
                            'Cancelado!',
                            'Ningun registro fue eliminado.',
                            'error'
                        )
                        e.preventDefault()
                        e.stopPropagation();
                    }
                })
            });

            function deleteRecord(id)
            {
                var form_data = new FormData();
                form_data.append('id', id);
                $.ajax({
                    url: globalRouteDestroy,
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
                            applicationsTable.ajax.reload( null, false );
                            //adminTable.search('').draw();
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
        });
    </script>
@endsection