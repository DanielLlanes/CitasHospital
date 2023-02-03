@extends('staff.layouts.app')
@section('title')
	@lang('Specialties')
@endsection
@section('content')
<div class="page-bar">
    <div class="page-title-breadcrumb">
        <div class=" pull-left">
            <div class="page-title">@lang('Specialty Manager')</div>
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
            <li class="active">@lang('Specialty Manager')</li>
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
                                        <header>Specialties</header>
                                        <div class="tools">
                                            <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                                            <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                            <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                                        </div>
                                    </div>
                                    <div class="card-body ">
                                        <div class="table-scrollable responsive" >
                                            <table class="table table-hover table-checkable order-column full-width" id="specialtyTable">
                                                <thead>
                                                    <tr>
                                                        <th> ID </th>
                                                        <th> @lang('Role') </th>
                                                        <th> @lang('Name Es') </th>
                                                        <th> @lang('Name En') </th>
                                                        <th> @lang('Assigable') </th>
                                                        <th> @lang('Many specialties') </th>
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
                                        <header>@lang('Specialty Manager')</header>
                                    </div>
                                    <div class="card-body" id="bar-parent">
                                       <form action="#" id="form_sample_1" class="form-horizontal" autocomplete="off">
                                           <div class="form-body">
                                            <div class="form-group mb-2">
                                                <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Role')
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-12">
                                                    <select name="role" id="role" class="form-control input-sm autocomplete patient" />
                                                        <option value="" selected disabled>Seleccionar .....</option>
                                                        @foreach ($roles as $role)
                                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                        @endforeach
                                                    </select>
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
                                                    <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Name En')
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-12">
                                                        <input type="text" name="name_en" id="name_en" autocomplete="off" placeholder="@lang('Name En')" class="form-control input-sm autocomplete patient" />
                                                        <div class="error text-danger col-form-label-sm"></div>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Asignable')
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-12">
                                                        <input type="text" name="assignable" id="assignable" value="0" autocomplete="off" placeholder="@lang('Asignable')" class="form-control input-sm autocomplete patient" />
                                                        <div class="error text-danger col-form-label-sm"></div>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Many specialties')
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-12">
                                                        <input type="text" name="many_specialties" id="many_specialties" value="0" autocomplete="off" placeholder="@lang('Many specialties')" class="form-control input-sm autocomplete patient" />
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
        var globalRouteobtenerLista = "{{ route('staff.specialty.getSpecialties') }}";
        var globalRouteStore = "{{ route('staff.specialty.storeSpecialties') }}";
        var globalRouteActivar = "{{ route('staff.specialty.activateSpecialties') }}"
        var globalRouteEditar = "{{ route('staff.specialty.editSpecialties') }}"
        var globalRouteUpdate = "{{ route('staff.specialty.updateSpecialties') }}"
        var globalRouteDestroy = "{{ route('staff.treatments.configuration.destroyBrand') }}"

        $(function () {
            var codigo = 1;
            var specialtyTable = $('#specialtyTable').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax:{
                    url : globalRouteobtenerLista,
                    type: "get",
                    data: {"estable": codigo},
                    error: function (xhr, error, thrown) {
                        console.log(xhr);
                        console.log(error);
                    },
                    // success: function(data) {
                    //     console.log(data);
                    // },
  
                },
                language: {
                    "url": dataTablesLangEs
                },
                "columns": [

                    { data: 'DT_RowIndex' },
                    { data: "rol" },
                    { data: "name_es" },
                    { data: "name_en" },
                    { data: "assignable" },
                    { data: "many_specialties" },
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
                            specialtyTable.ajax.reload( null, false );
                        }
                    },
                    complete: function()
                    {
                    },
                })
            });
            $(document).on("click", "#formSubmit", function () {
                var form_data = new FormData();
                form_data.append('name_es', $('#name_es').val())
                form_data.append('name_en', $('#name_en').val())
                form_data.append('assignable', $('#assignable').val())
                form_data.append('many_specialties', $('#many_specialties').val())
                form_data.append('role', $( "#role option:selected" ).val())
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
                            specialtyTable.ajax.reload( null, false );
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
                var specialtyId = $(this).attr('data-id')
                var form_data = new FormData();
                form_data.append('id', specialtyId);
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
                        console.log(data)
                        if (data.success) {
                            clearForm()
                            $('#name').val(data.info.name);
                            $('#name_en').val(data.info.name_en);
                            $('#name_es').val(data.info.name_es);
                            $('#assignable').val(data.info.assignable);
                            $('#many_specialties').val(data.info.many_specialties);
                            $('#role option[value='+data.info.role_id+']').prop('selected', 'selected').change();
                            $('#formSubmit').html('edit').attr({
                                specialty: $.trim(specialtyId),
                                id: 'formEdit'
                            });
                        } else {
                            Toast.fire({
                                icon: data.icon,
                                title: data.msg
                            })
                            specialtyTable.ajax.reload( null, false );
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
                var specialtyId = $(this).attr('specialty')
                var form_data = new FormData();
                var form_data = new FormData();
                form_data.append('name_es', $('#name_es').val())
                form_data.append('name_en', $('#name_en').val())
                form_data.append('assignable', $('#assignable').val())
                form_data.append('many_specialties', $('#many_specialties').val())
                form_data.append('role', $( "#role option:selected" ).val())
                form_data.append('id', specialtyId);
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
                            specialtyTable.ajax.reload( null, false );
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