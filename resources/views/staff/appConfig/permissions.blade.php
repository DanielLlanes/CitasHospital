@extends('staff.layouts.app')
@section('title')
	@lang('Roles')
@endsection
@section('content')
<div class="page-bar">
    <div class="page-title-breadcrumb">
        <div class=" pull-left">
            <div class="page-title">@lang('Rol Manager')</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li>
                <i class="fa fa-home"></i>&nbsp;
                <a class="parent-item" href="index-2.html">@lang('breadcrumb.Home')</a>&nbsp;
                <i class="fa fa-angle-right">

                </i>
            </li>
            <li class="active">@lang('App Config')&nbsp;
                <i class="fa fa-angle-right"></i>
            </li>
            <li class="active">@lang('Rol Manager')</li>
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
                            <div class="col-md-9">
                                <div class="card  card-box">
                                    <div class="card-head">
                                        <header>Roles</header>
                                        <div class="tools">
                                            <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                                            <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                            <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                                        </div>
                                    </div>
                                    <div class="card-body ">
                                        <div class="table-scrollable responsive" >
                                            <table class="table table-hover table-checkable order-column full-width" id="Permissionstable">
                                                <thead>
                                                    <tr>
                                                        <th> ID </th>
                                                        <th> @lang('Slug') </th>
                                                        <th> @lang('guard') </th>
                                                        <th> @lang('group Es') </th>
                                                        <th> @lang('group En') </th>
                                                        <th> @lang('Description Es') </th>
                                                        <th> @lang('Description En') </th>
                                                        <th> @lang('active') </th>
                                                        <th> @lang('Action') </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card-box">
                                    <div class="card-head">
                                        <header>@lang('Role Manager')</header>
                                    </div>
                                    <div class="card-body" id="bar-parent">
                                       <form action="#" id="form_sample_1" class="form-horizontal" autocomplete="off">
                                           <div class="form-body">
                                                <div class="form-group mb-2">
                                                    <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('slug')
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-12">
                                                        <input type="text" name="name" id="name" placeholder="@lang('slug')" class="form-control input-sm" />
                                                        <div class="error text-danger col-form-label-sm"></div>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Group Es')
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-12">
                                                        <input type="text" name="group_es" id="group_es" autocomplete="off" placeholder="@lang('Group Es')" class="form-control input-sm autocomplete patient" />
                                                        <div class="error text-danger col-form-label-sm"></div>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Group En')
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-12">
                                                        <input type="text" name="group_en" id="group_en" autocomplete="off" placeholder="@lang('Group En')" class="form-control input-sm autocomplete patient" />
                                                        <div class="error text-danger col-form-label-sm"></div>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Descripción Es')
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-12">
                                                        <input type="text" name="description_es" id="description_es" autocomplete="off" placeholder="@lang('Descripción Es')" class="form-control input-sm autocomplete patient" />
                                                        <div class="error text-danger col-form-label-sm"></div>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Descripción En')
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-12">
                                                        <input type="text" name="description_en" id="description_en" autocomplete="off" placeholder="@lang('Descripción En')" class="form-control input-sm autocomplete patient" />
                                                        <div class="error text-danger col-form-label-sm"></div>
                                                    </div>
                                                </div>
                                           </div>
                                           <div class="form-actions">
                                               <div class="row">
                                                   <div class="offset-md-3 col-md-9">
                                                       {{-- @can('brand.create') --}}
                                                           <button type="button" class="btn btn-info" id="formSubmit">@lang('Add')</button>
                                                       {{-- @endcan --}}
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
        var globalRouteobtenerLista = "{{ route('staff.permissions.getPermissions') }}";
        var globalRouteStore = "{{ route('staff.permissions.storePermissions') }}";
        var globalRouteActivar = "{{ route('staff.permissions.activatePermissions') }}"
        var globalRouteEditar = "{{ route('staff.permissions.editPermissions') }}"
        var globalRouteUpdate = "{{ route('staff.permissions.updatePermissions') }}"
        var globalRouteDestroy = "{{ route('staff.treatments.configuration.destroyBrand') }}"

        $(function () {
            var codigo = 1;
            var Permissionstable = $('#Permissionstable').DataTable({
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

                    { data: 'DT_RowIndex' },
                    { data: "name" },
                    { data: "guard" },
                    { data: "group_es" },
                    { data: "group_en" },
                    { data: "description_es" },
                    { data: "description_en" },
                    { data: "active" },
                    { data: "action", orderable: false, searchable: false, className: 'center' },

                ],
                createdRow: function (row, data, dataIndex) {
                    $(row).addClass('odd gradeX');
                },
            });

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
                        console.log(data);
                        Toast.fire({
                            icon: data.icon,
                            title: data.msg
                        })
                        if (data.reload) {
                            Permissionstable.ajax.reload( null, false );
                        }
                    },
                    complete: function()
                    {
                    },
                })
            });
            $(document).on("click", "#formSubmit", function () {
                var form_data = new FormData();
                form_data.append('name', $('#name').val())
                form_data.append('group_es', $('#group_es').val())
                form_data.append('group_en', $('#group_en').val())
                form_data.append('description_es', $('#description_es').val())
                form_data.append('description_en', $('#description_en').val())
                $.ajax({
                    url: globalRouteStore,
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
                        console.log(data);
                        Toast.fire({
                        icon: data.icon,
                        title: data.msg
                        })
                        if (data.reload) {
                            Permissionstable.ajax.reload( null, false );
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
            $(document).on('click', '.tbl-edit', function (event) {
                var PermissionId = $(this).attr('data-id')
                var form_data = new FormData();
                form_data.append('id', PermissionId);
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
                        clearForm()
                    },
                    success:function(data)
                    {
                    
                        if (data.success) {
                            clearForm()
                            $('#name').val(data.info.name);
                            $('#group_en').val(data.info.group_en);
                            $('#group_es').val(data.info.group_es);
                            $('#description_en').val(data.info.description_en);
                            $('#description_es').val(data.info.description_es);
                            
                            $('#formSubmit').html('edit').attr({
                                permission: $.trim(PermissionId),
                                id: 'formEdit'
                            });
                        } else {
                            Toast.fire({
                                icon: data.icon,
                                title: data.msg
                            })
                            Permissionstable.ajax.reload( null, false );
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
                var PermissionId = $(this).attr('permission')
                var form_data = new FormData();
                form_data.append('name', $('#name').val())
                form_data.append('group_es', $('#group_es').val())
                form_data.append('group_en', $('#group_en').val())
                form_data.append('description_es', $('#description_es').val())
                form_data.append('description_en', $('#description_en').val())
                form_data.append('id', PermissionId);
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
                    console.log(data);
                        Toast.fire({
                            icon: data.icon,
                            title: data.msg
                        })
                        if (data.reload) {
                            Permissionstable.ajax.reload( null, false );
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
           

            function clearForm(){
                $('#formReset').click();
                $('#formEdit')
                .removeAttr('role')
                .html('Add')
                .attr('id', 'formSubmit')
            }
        });

    </script>
@endsection