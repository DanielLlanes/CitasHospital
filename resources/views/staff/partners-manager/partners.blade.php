@extends('staff.layouts.app')
@section('title')
	@lang('Partners')
@endsection
@section('content')
<div class="page-bar">
    <div class="page-title-breadcrumb">
        <div class=" pull-left">
            <div class="page-title">@lang('Partners Manager')</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li>
                <i class="fa fa-home"></i>&nbsp;
                <a class="parent-item" href="index-2.html">@lang('breadcrumb.Home')</a>&nbsp;
                <i class="fa fa-angle-right">

                </i>
            </li>
            <li class="active">@lang('Configuration')&nbsp;
                <i class="fa fa-angle-right"></i>
            </li>
            <li class="active">@lang('Partners Manager')</li>
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
                                        <header></header>
                                        <div class="tools">
                                            <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                                            <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                            <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                                        </div>
                                    </div>
                                    <div class="card-body ">
                                      <div class="table-scrollable responsive" >
                                        <table class="table table-hover table-checkable order-column full-width" id="partnerTable">
                                            <thead>
                                                <tr>
                                                    <th> ID </th>
                                                    <th> @lang('Image') </th>
                                                    <th> @lang('Name') </th>
                                                    <th> @lang('Company') </th>
                                                    <th> @lang('Website') </th>
                                                    <th> @lang('Email') </th>
                                                    <th> @lang('Phone') </th>
                                                    <th> @lang('Active') </th>
                                                    <th> @lang('Actions') </th>
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
                                        <header>@lang('Partners Manager')</header>
                                    </div>
                                    <div class="card-body" id="bar-parent">
                                       <form action="#" id="form_sample_1" class="form-horizontal" autocomplete="off">
                                           <div class="form-body">
                                                <div class="form-group mb-2">
                                                    <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Image brand')
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-12">
                                                        <input type="file" name="image" id="image" class="dropify" />
                                                        <div class="error text-danger col-form-label-sm"></div>
                                                    </div>
                                                </div>
                                               <div class="form-group mb-2">
                                                   <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Partner')
                                                       <span class="required"> * </span>
                                                   </label>
                                                   <div class="col-md-12">
                                                       <input type="text" name="name" id="name" placeholder="@lang('Partner')" class="form-control input-sm" />
                                                       <div class="error text-danger col-form-label-sm"></div>
                                                   </div>
                                               </div>
                                               <div class="form-group mb-2">
                                                   <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Comapny')
                                                       <span class="required"> * </span>
                                                   </label>
                                                   <div class="col-md-12">
                                                       <input type="text" name="company" id="company" autocomplete="off" placeholder="@lang('Enter Comapny')" class="form-control input-sm autocomplete patient" onClick="this.setSelectionRange(0, this.value.length)" />
                                                       <div class="error text-danger col-form-label-sm"></div>
                                                   </div>
                                               </div>
                                               <div class="form-group mb-2">
                                                   <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('website')
                                                       <span class="required"> * </span>
                                                   </label>
                                                   <div class="col-md-12">
                                                       <input type="text" name="website" id="website" autocomplete="off" placeholder="@lang('Enter website')" class="form-control input-sm autocomplete patient" onClick="this.setSelectionRange(0, this.value.length)" />
                                                       <div class="error text-danger col-form-label-sm"></div>
                                                   </div>
                                               </div>
                                               <div class="form-group mb-2">
                                                   <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Phone')
                                                       <span class="required"> * </span>
                                                   </label>
                                                   <div class="col-md-12">
                                                       <input type="phone" name="phone" id="phone" placeholder="@lang('Enter phone')" class="form-control input-sm" />
                                                       <div class="error text-danger col-form-label-sm"></div>
                                                   </div>
                                               </div>
                                               <div class="form-group mb-2">
                                                   <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Email')
                                                       <span class="required"> * </span>
                                                   </label>
                                                   <div class="col-md-12">
                                                       <input type="email" name="email" id="email" placeholder="@lang('Enter email')" class="form-control input-sm" />
                                                       <div class="error text-danger col-form-label-sm"></div>
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
@section('styles')
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
        var globalRouteStore = "{{ route('staff.partners.storePartners') }}";
        var globalRouteobtenerLista = "{{ route('staff.partners.getPartnersList') }}";
        var globalRouteActivar = "{{ route('staff.partners.activatePartners') }}"
        var globalRouteEditar = "{{ route('staff.partners.editPartners') }}"
        var globalRouteUpdate = "{{ route('staff.partners.updatePartners') }}"
        var globalRouteresetPassword = "{{ route('staff.partners.resetPassword') }}"
    </script>

    <script type="text/javascript">
        $(function() {
            var codigo = 1;
            var partnerTable = $('#partnerTable').DataTable({
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
                    { data: "image" },
                    { data: "name" },
                    { data: "company" },
                    { data: "website" },
                    { data: "email" },
                    { data: "phone" },
                    { data: "active", searchable: false, className: 'center' },
                    { data: "action", orderable: false, searchable: false, className: 'center' },

                ],
                createdRow: function (row, data, dataIndex) {
                    $(row).addClass('odd gradeX');
                },
            });
        
            $(document).on("click", "#formSubmit", function () {
                var form_data = new FormData();
                form_data.append('name', $('#name').val());
                form_data.append('company', $('#company').val());
                form_data.append('phone', $('#phone').val());
                form_data.append('email', $('#email').val());
                form_data.append('website', $('#website').val());
                form_data.append('image', $('#image').prop('files')[0])
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
                    console.log("data", data);
                        Toast.fire({
                          icon: data.icon,
                          title: data.msg
                        })
                        if (data.reload) {
                            partnerTable.ajax.reload( null, false );
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
                            partnerTable.ajax.reload( null, false );
                        }
                    },
                    complete: function()
                    {
                    },
                })
            });
            $(document).on('click', '#formCancel', function () {
                clearForm()
            });
            $(document).on('click', '.tbl-edit', function (event) {
                var id = $(this).attr('data-id')
                var form_data = new FormData();
                form_data.append('id', id);
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

                        clearDropify()

                    },
                    success:function(data)
                    {
                    
                        if (data.success) {
                            var image_url;
                            if (data.info.image_one) {
                                image_url = window.location.origin+"/"+data.info.image_one.image
                            } else {
                                image_url = '';
                            }
                            clearForm()
                            $('#brand').val(data.info.brand);
                            $('#name').val(data.info.name);
                            $('#company').val(data.info.company);
                            $('#website').val(data.info.website);
                            $('#phone').val(data.info.phone);
                            $('#email').val(data.info.email);
                            drEvents.settings.defaultFile = image_url;
                            drEvents.destroy();
                            drEvents.init();
                            
                            $('#formSubmit').html('edit').attr({
                                partner: $.trim(id),
                                id: 'formEdit'
                            });
                        } else {
                            Toast.fire({
                                icon: data.icon,
                                title: data.msg
                            })
                            partnerTable.ajax.reload( null, false );
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
                var id = $(this).attr('partner')
                var form_data = new FormData();
                form_data.append('partner', $('#partner').val());
                form_data.append('company', $('#company').val());
                form_data.append('website', $('#website').val());
                form_data.append('phone', $('#phone').val());
                form_data.append('email', $('#email').val());
                form_data.append('image', $('#image').prop('files')[0])
                form_data.append('id', id);
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
                            partnerTable.ajax.reload( null, false );
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

            $(document).on('click', '.reset_pass', function(event) {
                event.preventDefault();
                resetPassword($(this).attr('data-id'))
            });
            function clearForm(){
                $('#name').val('');
                $('#company').val('');
                $('#website').val('');
                $('#phone').val('');
                $('#email').val('');
                $('#formReset').click();
                $('#formEdit')
                .removeAttr('partner')
                .html('Add')
                .attr('id', 'formSubmit')
                clearDropify()
                clearDropify();
            }
            function clearDropify(){
                drEvents = drEvent.data('dropify');
                drEvents.resetPreview();
                drEvents.clearElement();
            }
            function resetPassword(id){
                var form_data = new FormData();
                form_data.append('id', id);
                $.ajax({
                    url: globalRouteresetPassword,
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
                    console.log("data", data);
                        Toast.fire({
                          icon: data.icon,
                          title: data.msg
                        })
                        if (data.reload) {
                            partnerTable.ajax.reload( null, false );
                                                        clearForm()
                        }
                    },
                })
            }
        });
    </script>
@endsection
