@extends('staff.layouts.app')
@section('title')
	@lang('Applications')
@endsection
@section('content')
<div class="page-bar">
    <div class="page-title-breadcrumb">
        <div class=" pull-left">
            <div class="page-title">@lang('Applications Manager')</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index-2.html">@lang('breadcrumb.Home')</a>&nbsp;<i class="fa fa-angle-right"></i>
            </li>
            <li class="active">@lang('Configuration')&nbsp;<i class="fa fa-angle-right"></i></li>
            <li class="active">@lang('Applications Manager')</li>
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
                                        <table style="width:100%; min-width:100% height:20px;" class="table table-hover dt-responsive nowrap" id="applicationsTable">
                                            <thead>
                                                <tr>
                                                    <th> ID </th>
                                                    <th> @lang('Paciente') </th>
                                                    <th> @lang('Marca') </th>
                                                    <th> @lang('Servicio') </th>
                                                    <th> @lang('Procedimiento') </th>
                                                    <th> @lang('Paquete') </th>
                                                    <th> @lang('Coordinador') </th>
                                                    <th> @lang('Fecha') </th>
                                                    <th> @lang('Precio') </th>
                                                    <th> @lang('Status') </th>
                                                    <th> @lang('Código') </th>
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
@endsection
@section('styles')
<style>
    .btn-tbl-view{
        background-color: rgb(56, 175, 248);
        border-radius: 50% !important;
        padding: 5px !important;
        color: #fff;
        box-shadow: 0px 5px 25px 0px rgba(0, 0, 0, 0.2);
    }
    a .btn-tbl-view:hover,
    .btn-tbl-editPrice:hover,
    .btn-tbl-payment:hover{
        color: #fff;
    }
    .btn-tbl-editPrice{
        background-color: rgb(250, 152, 73);
        border-radius: 50% !important;
        padding: 5px !important;
        color: #fff;
        box-shadow: 0px 5px 25px 0px rgba(0, 0, 0, 0.2);
    }
    .btn-tbl-payment{
        background-color: rgb(218, 110, 218);
        border-radius: 50% !important;
        padding: 5px !important;
        color: #fff;
        box-shadow: 0px 5px 25px 0px rgba(0, 0, 0, 0.2);
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

	<script>
        var globalRouteobtenerLista = "{{ route('staff.applications.getList') }}";
        var globalRouteStore = "{{ route('staff.treatments.configuration.storePackage') }}";
        var globalRouteActivar = "{{ route('staff.treatments.configuration.activatePackage') }}"
        var globalRouteEditar = "{{ route('staff.treatments.configuration.editPackage') }}"
        var globalRouteUpdate = "{{ route('staff.treatments.configuration.updatePackage') }}"
        var globalRouteDestroy = "{{ route('staff.treatments.configuration.destroyPackage') }}"

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
                    { data: "precio" },
                    { data: "status" },
                    { data: "codigo" },
		            { data: "acciones", orderable: false, searchable: false },

		        ],
		        createdRow: function (row, data, dataIndex) {
		            $(row).addClass('odd gradeX');
		        },
		    });


                var form_data = new FormData();
                form_data.append('package_en', 1);
                // $.ajax({
                //     url: globalRouteobtenerLista,
                //     method:"get",
                //     data:form_data,
                //     dataType:'JSON',
                //     contentType: false,
                //     cache: false,
                //     headers: {
                //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                //     },
                //     processData: false,
                //     beforeSend: function()
                //     {
                //     },
                //     success:function(data)
                //     {

                //     },
                //     error: function (err)
                //     {
                //         console.log('err', err)
                //     },
                //     complete: function()
                //     {
                //     },
                // })

                $.getJSON(globalRouteobtenerLista, function(resp) {
                    console.log(resp);
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
