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
                                                    {{-- <th> @lang('Precio') </th>
                                                    <th> @lang('Statring Price') </th> --}}
                                                    <th> @lang('Status') </th>
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
<div class="modal fade" tabindex="-1" role="dialog" id="addPriceModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Agregar o editar precio</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Precio</label>
                    <input type="text" class="form-control currencyTextBox" name="price" id="appPrice" aria-describedby="emailHelp" placeholder="Set price">
                    <small id="emailHelp" class="form-text text-muted">Agregar precio en dolares USD</small>
                    <div class="error text-danger" id="error"></div>
                </div>
            </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-add-price">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
        var globalRouteGetAppPrice = "{{ route('staff.applications.getAppPrice') }}"
        var globalRouteSetAppPrice = "{{ route('staff.applications.setAppPrice') }}"

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
                    // { data: "precio" },
                    // { data: "precio_inicial" },
                    { data: "status" },
                    { data: "codigo" },
                    { data: "partner" },
		            { data: "acciones", orderable: false, searchable: false },

		        ],
		        createdRow: function (row, data, dataIndex) {
		            $(row).addClass('odd gradeX');
		        },
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
                            socket.emit('updateDataTablesToServer');
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
                            socket.emit('updateDataTablesToServer');
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
                            socket.emit('updateDataTablesToServer');
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

            $(document).on('click', '.btn-tbl-addPrice', function(event) {
                let id = $(this).attr('data-id');
                let tempCode = $(this).attr('data-tempcode');
                let code = $(this).attr('data-code');
                
                $('#addPriceModal').on('show.bs.modal', function (e) {
                    var form_data = new FormData();
                    form_data.append('id', id);
                    form_data.append('tempcode', tempCode);
                    form_data.append('code', code);
                    $.ajax({
                        url: globalRouteGetAppPrice,
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
                            $('#appPrice').val(data.price);
                            $('.btn-add-price').attr({
                                id: data.id,
                                tempcode: data.temp_code,
                                code: data.code
                            });

                        },
                        error: function (err)
                        {
                            console.log('err', err)
                        },
                        complete: function()
                        {
                        },
                    })
                }).modal('show')
            });
            $(document).on('click', '.btn-add-price', function(event) {
                event.preventDefault();
                let id = $(this).attr('id');
                let tempCode = $(this).attr('tempcode');
                let code = $(this).attr('code');
                let price = $('#appPrice').val();
                var form_data = new FormData();
                    form_data.append('id', id);
                    form_data.append('tempcode', tempCode);
                    form_data.append('code', code);
                    form_data.append('price', price);
                    $.ajax({
                        url: globalRouteSetAppPrice,
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

                                Toast.fire({
                                    icon: data.icon,
                                    title: data.mesg,
                                })
                                $('.btn-add-price').removeAttr('id')
                                $('.btn-add-price').removeAttr('tempcode')
                                $('.btn-add-price').removeAttr('code')
                                $('#appPrice').val('');
                                $('#addPriceModal').modal('hide')
                            } else {
                                $.each( data.errors, function( key, value ) {
                                    $('*[name^='+key+']').parent().find('.error').append('<p>'+value+'</p>')
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
                            socket.emit('updateDataTablesToServer');
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
            socket.on('updateDataTablesToClient', () =>  {
                applicationsTable.ajax.reload( null, false );
                console.log('entra?');
            });
		});

        
    </script>
@endsection
