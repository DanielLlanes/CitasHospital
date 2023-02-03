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
                                            <table class="table table-hover table-checkable order-column full-width" id="RoleTable">
                                                <thead>
                                                    <tr>
                                                        <th> ID </th>
                                                        <th> @lang('Name') </th>
                                                        <th> @lang('Name Es') </th>
                                                        <th> @lang('Name En') </th>
                                                        <th> @lang('guard') </th>
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
                                                    <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('General name')
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-12">
                                                        <input type="text" name="name" id="name" placeholder="@lang('General name')" class="form-control input-sm" />
                                                        <div class="error text-danger col-form-label-sm"></div>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Name Es')
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-12">
                                                        <input type="text" name="name_es" id="name_es" autocomplete="off" placeholder="@lang('Name Es')" class="form-control input-sm autocomplete patient" />
                                                        <div class="error text-danger col-form-label-sm"></div>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Name en')
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-12">
                                                        <input type="text" name="name_en" id="name_en" autocomplete="off" placeholder="@lang('Name en')" class="form-control input-sm autocomplete patient" />
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
<div class="row" id="permisionsRowScroll">
    <div class="col-12" id="permisionsRow" style="display: none;">
        <div class="card card card-box">
            <div class="card-head text-center">
                <header>Permisos</header>
                <div class="tools">
                    <div class="form-check">
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row" id="groups">
                    
                </div>
            </div>
            <div class="col-12 d-flex justify-content-end p-4">
                <button type="submit" class="btn btn-info mr-1" id="sendPer">@lang('Submit')</button>
                <button type="button" class="btn btn-default ml-1" id="cancelPer">@lang('Cancel')</button>
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
        var globalRouteobtenerLista = "{{ route('staff.roles.getRoles') }}";
        var globalRouteStore = "{{ route('staff.roles.storeRole') }}";
        var globalRouteActivar = "{{ route('staff.roles.activaterole') }}"
        var globalRouteEditar = "{{ route('staff.roles.editRole') }}"
        var globalRouteUpdate = "{{ route('staff.roles.updateRole') }}"
        var globalRouteDestroy = "{{ route('staff.treatments.configuration.destroyBrand') }}"
        var globalRoutePermissions = "{{ route('staff.roles.getRolesPermissions') }}";
        var globalRoutePermissionsSet = "{{ route('staff.roles.permissionsSet') }}";

        $(function () {
            var codigo = 1;
            var RoleTable = $('#RoleTable').DataTable({
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
                    { data: "name_es" },
                    { data: "name_en" },
                    { data: "guard" },
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
                            RoleTable.ajax.reload( null, false );
                        }
                    },
                    complete: function()
                    {
                    },
                })
            });
            $(document).on("click", "#formSubmit", function () {
                var form_data = new FormData();
                form_data.append('name', $('#name').val());
                form_data.append('name_en', $('#name_en').val());
                form_data.append('name_es', $('#name_es').val());
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
                        Toast.fire({
                        icon: data.icon,
                        title: data.msg
                        })
                        if (data.reload) {
                            RoleTable.ajax.reload( null, false );
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
                var RoleId = $(this).attr('data-id')
                var form_data = new FormData();
                form_data.append('id', RoleId);
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
                            $('#name_en').val(data.info.name_en);
                            $('#name_es').val(data.info.name_es);
                            
                            $('#formSubmit').html('edit').attr({
                                role: $.trim(RoleId),
                                id: 'formEdit'
                            });
                        } else {
                            Toast.fire({
                                icon: data.icon,
                                title: data.msg
                            })
                            RoleTable.ajax.reload( null, false );
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
                var RoleId = $(this).attr('role')
                var form_data = new FormData();
                form_data.append('name', $('#name').val());
                form_data.append('name_en', $('#name_en').val());
                form_data.append('name_es', $('#name_es').val());
                form_data.append('id', RoleId);
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
                            RoleTable.ajax.reload( null, false );
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
            $(document).on('click', '.changePermissions', function(event) {
                clearForm()
                event.preventDefault();
                var id = $(this).attr("data-id");
                var form_data = new FormData();
                form_data.append('id', id);
                $.ajax({
                    url: globalRoutePermissions,
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
                        $('#groups').html('')
                        $('#permisionsRow').show('fast').attr('user', '');
                    },
                    success:function(data)
                    {
                        console.log("data", data);
                        
                        var htmlPermissions = '';
                            $.each(data.groups, function(i, v) {
                                htmlPermissions += '<div class="col-md-6">'
                                    htmlPermissions += '<div class="card card-box">'
                                        htmlPermissions += '<div class="card-head">'
                                            htmlPermissions += '<header class="d-flex justify-content-center">'
                                                htmlPermissions += '<p><strong>'+ v.group +'</strong></p>'
                                                htmlPermissions += '<span>'
                                                    // htmlPermissions += '<input type="checkbox"  class="selectAllGroup" >'
                                                    // htmlPermissions += '<label for="selectAll" class="col-form-label-sm">'
                                                    //     htmlPermissions += 'Seleccionar todos los grupos'
                                                    // htmlPermissions += '</label>'
                                                htmlPermissions += '</span>'
                                            htmlPermissions += '</header>'
                                        htmlPermissions += '</div>'
                                        htmlPermissions += '<div class="card-body " id="bar-parent2">'
                                            htmlPermissions += '<div class="row">'
                                                $.each(data.permissions, function(ind, val) {
                                                    if (val.groupP == v.group) {
                                                        htmlPermissions += '<div class="col-md-6 col-sm-6">'
                                                            htmlPermissions += '<div class="form-check">'
                                                                htmlPermissions += '<input type="checkbox"'
                                                                htmlPermissions += 'id="permissions_' + val.id + ' " '
                                                                htmlPermissions += 'name="permissions" '
                                                                htmlPermissions += 'class="form-check-input check-group" '
                                                                htmlPermissions += 'value="'+val.id+'" '
                                                                    $.each(data.rolePermissions, function(index, value) {
                                                                        if (value.id === val.id) {
                                                                            htmlPermissions += ' checked'
                                                                        }
                                                                    });
                                                                htmlPermissions += '>'
                                                                htmlPermissions += '<label class="form-check-label" for="permissions_' + val.id + '">'
                                                                    htmlPermissions +=  val.description
                                                                htmlPermissions += '</label>'
                                                            htmlPermissions += '</div>'
                                                        htmlPermissions += '</div>'
                                                    }
                                                });
                                            htmlPermissions += '</div>'
                                        htmlPermissions += '</div>'
                                    htmlPermissions += '</div>'
                                htmlPermissions += '</div>'
                            });
                        $('#groups').append(htmlPermissions)

                        $('#permisionsRow').show('fast').attr('role', data.id);
                    },
                })
            });
            $(document).on('click', '#cancelPer', function(event) {
                clearForm()
                event.preventDefault();
                $('html, body').animate({
                    scrollTop: $("body").offset().top
                }, 2000);
                $('#permisionsRow').hide('fast').attr('user', '');
                $('#groups').html('')
            });
            $(document).on('click', '.changePermissions', function(event) {
                $('html, body').animate({
                    scrollTop: $("#permisionsRowScroll").offset().top
                }, 2000);
            });

            $(document).on('click', '#sendPer', function(event) {
                clearForm()
                var form_data = new FormData();
                var permissionsArray = [];
                var id = $('#permisionsRow').attr('role');
                $("input[name='permissions']").each(function() {
                    if (this.checked && !$(this).prop('disabled')) {
                        permissionsArray.push(this.value)
                    }
                    
                });
                
                form_data.append('id', id);
                form_data.append('permissionsList', JSON.stringify(permissionsArray));
                $.ajax({
                    url: globalRoutePermissionsSet,
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
                        $('#cancelPer').click()
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