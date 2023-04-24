@extends('staff.layouts.app')
@section('title')
	@lang('Approvals')
@endsection
@section('content')
<div class="page-bar">
    <div class="page-title-breadcrumb">
        <div class=" pull-left">
            <div class="page-title">@lang('staff Approval')</div>
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
                                        <table class="table table-hover table-checkable order-column full-width" id="assignedTable">
                                            <thead>
                                                <tr>
                                                    <th> ID </th>
                                                    <th> @lang('Staff') </th>
                                                    <th> @lang('Assigned to') </th>
                                                    <th> @lang('Can Approval') </th>
                                                    <th> @lang('Email') </th>
                                                    <th> @lang('Active') </th>
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
                            <div class="col-12 col-md-3">
                                <div class="card-box">
                                    <div class="card-head">
                                        <header>@lang('Assignamets Manager')</header>
                                    </div>
                                    <div class="card-body" id="bar-parent">
                                       <form action="#" id="form_sample_1" class="form-horizontal" autocomplete="off">
                                           <div class="form-body">
                                               <div class="form-group mb-2">
                                                   <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Staff')
                                                       <span class="required"> * </span>
                                                   </label>
                                                   <div class="col-md-12">
                                                       <select name="" class="staff_name w-100" id="staff_name"></select>
                                                       <div class="error text-danger col-form-label-sm"></div>
                                                   </div>
                                               </div>
                                               <div class="form-group mb-2">
                                                   <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Servicio')
                                                       <span class="required"> * </span>
                                                   </label>
                                                   <div class="col-md-12">
                                                       <select name="" class="service_name w-100" id="service_name"></select>
                                                       <div class="error text-danger col-form-label-sm"></div>
                                                   </div>
                                               </div>
                                               <div class="form-group mb-2">
                                                   <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Can Approval apps')
                                                       <span class="required">  </span>
                                                   </label>
                                                   <div class="col-md-12">
                                                       <input type="checkbox" id="approvalCkbx">
                                                       <div class="error text-danger col-form-label-sm"></div>
                                                   </div>
                                               </div>
                                               <div class="form-group mb-2">
                                                   <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Email')
                                                       <span class="required">  </span>
                                                   </label>
                                                   <div class="col-md-12 mb-2" id="emailsArea">
                                                   </div>
                                                   <div class="col-md-12" id="addEmailInputDiv">
                                                   </div>
                                               </div>
                                               <div class="form-group mb-2" id="">
                                                   <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">
                                                       <span class="required">  </span>
                                                   </label>
                                                   <div class="col-md-12 d-flex justify-content-end">
                                                       <button type="button" class="btn btn-success" id="addNewEmailInput">+ agregar correo</button>
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
                                                       <button type="reset" class="d-none" id="formCancel">@lang('Cancel')</button>
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
        
        var globalRouteobtenerLista = "{{ route('staff.approvals.getAssignableList') }}";
        var globalStoreAssignaments = '{{ route('staff.approvals.storeAssignaments') }}'
        var globalSearchStaff = '{{ route('staff.asignaciones.autocompleteStaff') }}';
        var globalSearchService = '{{ route('staff.asignaciones.autocompleteService') }}';
        var globalRouteEditar = "{{ route('staff.approvals.editAsignaciones') }}"
        var globalUpdateAssignaments = "{{ route('staff.approvals.updateAsignaciones') }}"
        var globalRouteActivar = "{{ route('staff.approvals.activarAsignaciones') }}"
        var globalApprovalAssignaments = "{{ route('staff.approvals.approvalAssignaments') }}"
        var globalGetEmailsApprovals = "{{ route('staff.approvals.getEmailsApprovals') }}"
    </script>

    <script>

        $(document).ready(function() {
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
                },
                language: {
                    "url": dataTablesLangEs
                },
                "columns": [

                    { data: 'DT_RowIndex' },
                    { data: "staff" },
                    { data: "servicio" },
                    { data: "can" },
                    { data: "email" },
                    { data: "active" },
                    { data: "acciones", orderable: false, searchable: false, className: 'center' },

                    ],
                createdRow: function (row, data, dataIndex) {
                    $(row).addClass('odd gradeX');
                },
                "drawCallback": function() {
                },
            }); 
            const $emailsArea = $('#addEmailInputDiv .flex-nowrap').length
            $('#staff_name').select2({
                placeholder: "Select click here",
                ajax: {
                    url: globalSearchStaff,
                    type: 'post',
                    dataType: 'json',
                    data: function (params) {
                        return {
                            search: params.term,
                        }
                    },
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(obj) {
                                return {
                                    id: obj.id,
                                    text: obj.name,
                                    data: obj,
                                    new: true,
                                };
                            })
                        };
                    },
                    cache: true,
                }
            });
            $('#service_name').select2({
                placeholder: "Select click here",
                ajax: {
                    url: globalSearchService,
                    type: 'post',
                    dataType: 'json',
                    data: function (params) {
                        return {
                            search: params.term,
                        }
                    },
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(obj) {
                                return {
                                    id: obj.id,
                                    text: obj.name,
                                };
                            })
                        };
                    },
                    cache: true,
                }
            });
            $('#staff_name').on('change', function() {
                var dataStaff = $('#staff_name').select2('data');
                $('#addEmailInputDiv').html('');
                if (dataStaff.length > 0) {
                    if (dataStaff[0].hasOwnProperty("new")) {
                        var staff_id = (dataStaff.length > 0) ? dataStaff[0].id : null;
                        var staff_data = (dataStaff.length > 0) ? dataStaff[0].data : null;
                        const obj = {
                            emailValue: staff_data.email,
                            isSelected: 'checked',
                            isDefaultPresent: 1,
                            generateUniqueString: generateUniqueString(),
                        };
                        addNewEmailInput(obj)
                    }
                }
                  
            });
            $(document).on('click', '#addNewEmailInput', function(event) {
                addNewEmailInput();
            });
            function resetForm() {
                $('#staff_name').val(null).trigger('change');
                $('#service_name').val(null).trigger('change');
                $('#approvalCkbx').prop('checked', false);
                 $('#emailsArea').html('');
                $('#addEmailInputDiv').html('');
                $('#staff_name').prop('disabled', false)
            }
            $(document).on('click', '#formCancel', function(event) {
                event.preventDefault();
                $('#formEdit').removeAttr('assing')
                $('#formEdit').attr('id', 'formSubmit').html('add');
                $('#emailsArea').html('');
                $('#addEmailInputDiv').html('');
                $('#staff_name').prop('disabled', false)
                resetForm()
            });
            $(document).on('click', '#formSubmit', function(event) {
                var dataStaff = $('#staff_name').select2('data');
                var dataService = $('#service_name').select2('data');
                var staff_id = (dataStaff.length > 0) ? dataStaff[0].id : null;
                var service_id = (dataService.length > 0) ? dataService[0].id : null;;
                var approval = 0

                if ($('#approvalCkbx').is(":checked")) {approval = 1}

                var emails = [];

                $('.emailRadio').each(function(index) {
                    $attr = 'emails-'+index+'-email'
                    $(this).parents('.input-group').find('.emailInput').attr('id', $attr);
                    emails.push({
                        'email': $(this).parents('.input-group').find('.emailInput').val(),
                        'is_default': $(this).attr('isdefault'),
                        'is_checked': $(this).is(':checked') ? 1:0,
                    });
                });

                // Crear el objeto de datos a enviar por Ajax
                var dataString = {
                    'staff_id': staff_id,
                    'service_id': service_id,
                    'emails': emails,
                    'approval':approval
                };                
                $.ajax({
                    type: "POST",
                    url: globalStoreAssignaments,
                    method:"POST",
                    data:dataString,
                    dataType:'JSON',
                    cache: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: function(){

                    },
                    success: function(data) {
                        console.log("data", data)
                        Toast.fire({
                            icon: data.icon,
                            title: data.msg
                        })
                        if (data.reload) {
                            assignedTable.ajax.reload(null, false);
                            resetForm()
                        } else {
                            $.each( data.errors, function( key, value ) {
                                $('*[id^='+key+']').parent().find('.error').append('<p>'+value+'</p>')
                            });
                        }
                    }
                });
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
                            assignedTable.ajax.reload( null, false );
                        }
                    },
                    complete: function()
                    {
                    },
                })
                
            });
            $(document).on('click', '.tbl-edit, .seleccionar', function (event) {
                var assingId = $(this).attr('data-id')
                var form_data = new FormData();
                form_data.append('id', assingId);
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
                            resetForm()
                            $('#staff_name').select2("trigger", "select", {
                                data: { id: data.data.staff_id, text: data.data.staff.name }
                            });
                            $('#service_name').select2("trigger", "select", {
                                data: { id: data.data.service_id, text: data.service }
                            });
                            $('#formSubmit').html('edit').attr({
                                assing: $.trim(assingId),
                                id: 'formEdit'
                            });
                            $('#formEdit').attr('assing', $.trim(assingId))
                            if (data.data.approvals == 1) {$('#approvalCkbx').prop('checked', true)}
                            $edit = true;
                            addEmailCheckbox(data.data, $edit)
                        } else {
                            Toast.fire({
                                icon: data.icon,
                                title: data.msg
                            })
                            //clearForm()
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
            $(document).on('click', '#formEdit', function(event) {
                event.preventDefault();
                var dataStaff = $('#staff_name').select2('data');
                var dataService = $('#service_name').select2('data');
                var staff_id = (dataStaff.length > 0) ? dataStaff[0].id : null;
                var service_id = (dataService.length > 0) ? dataService[0].id : null;;
                var id = $(this).attr('assing');
                var approval = 0

                if ($('#approvalCkbx').is(":checked")) {approval = 1}

                var emails = [];

                $('.emailRadio').each(function(index) {
                    $attr = 'emails-'+index+'-email'
                    $(this).parents('.input-group').find('.emailInput').attr('id', $attr);
                    emails.push({
                        'email': $(this).parents('.input-group').find('.emailInput').val(),
                        'is_default': $(this).attr('isdefault'),
                        'is_checked': $(this).is(':checked') ? 1:0,
                    });
                });
                // Crear el objeto de datos a enviar por Ajax
                var dataString = {
                    'staff_id': staff_id,
                    'service_id': service_id,
                    'emails': emails,
                    'approval':approval,
                    'id': id,
                };                
                $.ajax({
                    type: "POST",
                    url: globalUpdateAssignaments,
                    method:"POST",
                    data:dataString,
                    dataType:'JSON',
                    cache: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: function(){

                    },
                    success: function(data) {
                        console.log("data", data);
                        Toast.fire({
                            icon: data.icon,
                            title: data.msg
                        })
                        if (data.reload) {
                            assignedTable.ajax.reload(null, false);
                            $('#formEdit').removeAttr('assing')
                            $('#formEdit').attr('id', 'formSubmit').html('add')
                            resetForm()
                        } else {
                            $.each( data.errors, function( key, value ) {
                                $('*[id^='+key+']').parent().find('.error').append('<p>'+value+'</p>')
                            });
                        }
                    }
                });
            });
            $(document).on('change', '.canApproval', function(event) {
                event.preventDefault();
                var id = $(this).attr('data-id');
                var approval = ($(this).is(':checked')) ? 1:0;
                var dataString = new FormData()
                dataString.append('id', id);
                dataString.append('approval', approval);
                $.ajax({
                    type: "POST",
                    url: globalApprovalAssignaments,
                    method:"POST",
                    data:dataString,
                    dataType:'JSON',
                    contentType: false,
                    cache: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    processData: false,
                    beforeSend: function(){

                    },
                    success: function(data) {
                        Toast.fire({
                            icon: data.icon,
                            title: data.msg
                        })
                        if (data.reload) {
                            assignedTable.ajax.reload(null, false);
                            $('#formEdit').removeAttr('assing')
                            $('#formEdit').attr('id', 'formSubmit').html('add')
                            resetForm()
                        } else {
                            $.each( data.errors, function( key, value ) {
                                $('*[id^='+key+']').parent().find('.error').append('<p>'+value+'</p>')
                            });
                        }
                    }
                });
            });
            const addEmailCheckbox = (data, edit = false) => {
                const code = data.id;
                $('#addEmailInputDiv').html('');
                if (data) {
                    data.additional_emails.forEach(email => {
                        const { email: emailValue, selected, default: isDefault } = email;
                        const isSelected = selected ? 'checked' : '';
                        const isDefaultPresent = isDefault !== undefined ? 1 : 0;
                        $generateUniqueString = generateUniqueString();

                        const obj = {
                            emailValue: email.email,
                            isSelected: email.selected ? 'checked' : '',
                            isDefaultPresent: email.default !== undefined ? 1 : 0,
                            generateUniqueString: generateUniqueString(),
                        };
                        //if (isDefaultPresent == 1) {addNewEmailInput(obj)}
                        if (edit) {addNewEmailInput(obj)} else {if (isDefaultPresent == 1) {addNewEmailInput(obj)}}
                        
                    });
                } 
            }
            const addNewEmailInput = (data = null) => {
                const emailData = data ? data : {
                    emailValue: '',
                    isSelected: '',
                    isDefaultPresent: 0,
                    generateUniqueString: ''
                };
                if (emailData.isDefaultPresent == 1) {}
                disabled = (emailData.isDefaultPresent == 1) ? 'disabled readonly': '';
                $addEmailInputDiv = `
                    <div class="d-flex flex-nowrap">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend mr-2">
                                <input ${emailData.isSelected} isDefault="${emailData.isDefaultPresent}" class="form-check-input emailRadio" type="radio" name="emailRadio-${emailData.code}" value="" id="thisRadio-${emailData.generateUniqueString}"aria-label="Radio button for following text input">
                            </div>
                            <div class="custom-file">
                                <input class="form-control form-control-sm emailInput" ${disabled} type="email" value="${emailData.emailValue}" placeholder="">
                                ${(emailData.isDefaultPresent == 1) ? 
                                '' : 
                                '<button type="button" class="btn btn-danger deleteEmailInput btn-sm" id=""><i class="fa fa-trash"></i></button>'}
                                
                            </div>
                        </div>
                   </div>
                   <div class="error text-danger col-form-label-sm"></div>
                `
                $('#addEmailInputDiv').append($addEmailInputDiv);
                
            }
            let lastTimestamp = 0;
            function generateUniqueString() {
                const now = new Date();
                const timestamp = now.getTime();
                if (timestamp === lastTimestamp) {
                    const randomSuffix = Math.floor(Math.random() * 1000).toString().padStart(3, "0");
                    lastTimestamp = timestamp;
                    return `${timestamp}${randomSuffix}`;
                }
                lastTimestamp = timestamp;
                const year = now.getFullYear().toString();
                const month = (now.getMonth() + 1).toString().padStart(2, "0");
                const day = now.getDate().toString().padStart(2, "0");
                const hours = now.getHours().toString().padStart(2, "0");
                const minutes = now.getMinutes().toString().padStart(2, "0");
                const seconds = now.getSeconds().toString().padStart(2, "0");
                const milliseconds = now.getMilliseconds().toString().padStart(3, "0");
                const uniqueString = `${year}${month}${day}${hours}${minutes}${seconds}${milliseconds}`;
                return uniqueString;
            }
            if ($emailsArea == 0) { addNewEmailInput()}
        });
        
    </script>
@endsection