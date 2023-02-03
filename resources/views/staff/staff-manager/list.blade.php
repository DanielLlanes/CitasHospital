@extends('staff.layouts.app')
@section('title')
	@lang('staff.Staff')
@endsection
@section('content')

<div class="page-bar">
    <div class="page-title-breadcrumb">
        <div class=" pull-left">
            <div class="page-title">@lang('breadcrumb.Staff List')</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index-2.html">@lang('breadcrumb.Home')</a>&nbsp;<i class="fa fa-angle-right"></i>
            </li>
            <li><a class="parent-item" href="#">@lang('breadcrumb.Staff')</a>&nbsp;<i class="fa fa-angle-right"></i>
            </li>
            <li class="active">@lang('breadcrumb.Staff List')</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="tabbable-line">
            <div class="tab-content">
                <div class="tab-pane active fontawesome-demo" id="tab1">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-box">
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
                                    <table class="table table-hover table-checkable order-column full-width" id="staffTable">
                                        <thead>
                                            <tr>
                                            	<th> ID </th>
                                            	<th> @lang('Picture') </th>
                                                <th> @lang('Name') </th>
                                                <th> @lang('Department') </th>
                                                <th> @lang('Specialization') </th>
                                                <th> @lang('Color') </th>
                                                <th> @lang('Mobile') </th>
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
        var checkboxs = $(".specialtyCheckbox");
        console.log("checkboxs", checkboxs);

        var todos = checkboxs.length === checkboxs.filter(":checked").length; 
        todos ? $('.selectAllGroup').prop('checked', true) : ''
        todos ? $('#selectAll').prop('checked', true) : $('#selectAll').prop('checked', false)

        $("#selectAll").click(function() {
            if (!$("input[type=checkbox]").prop('disabled')) {
                $("input[type=checkbox]").prop("checked", $(this).prop("checked"));
            }
        });

        $("input[type=checkbox]").click(function() {
            if (!$(this).prop("checked")) {
                $("#selectAll").prop("checked", false);
                $(this).parents('.card-body').siblings().find('.selectAllGroup').prop("checked", false);
            }
        });

        $(".selectAllGroup").click(function() {
            var input = $(this).parents('.card-head').siblings().find('.check-group')
            
            var checked = $(this).is(":checked")
            
            if (checked) {
                if (!input.prop('disabled')) {input.prop('checked', true)}
            } else {
                if (!input.prop('disabled')) {input.prop('checked', false)}
            }
        });
        
        $(document).ready(function() {
            $('#exampleModal').modal('show')
        });

        var globalRouteobtenerLista = "{{ route('staff.staff.getStaffList') }}";
		var globalRouteActivar = "{{ route('staff.staff.activate') }}";
        var globalRouteEliminar = "{{ route('staff.staff.destroy') }}";
        var globalRouteresetPassword = "{{ route('staff.staff.resetPassword') }}"
        var globalRoutePermissions = "{{ route('staff.staff.permissions') }}"
        var globalRoutePermissionsSet = "{{ route('staff.staff.permissionsSet') }}"
		$(document).ready(function() {
			var codigo = 1;
		    var staffTable = $('#staffTable').DataTable({
				responsive: true,
		        processing: true,
		        serverSide: true,
		    	ajax:{
		            url : '{{ route('staff.staff.getStaffList') }}',
		            type: "get",
		            data: {"estable": codigo},
		            error: function (xhr, error, thrown) {
		            },
		         },
		        language: {
		            "url": dataTablesLangEs,
		        },
		        "columns": [

					{ data: 'DT_RowIndex' },
		            { data: "picture", className:'patient-img' },
		            { data: "name" },
		            { data: "department" },
		            { data: "specialization" },
		            { data: "color", className: 'center' },
		            { data: "mobile" },
		            { data: "email" },
		            { data: "active", className: 'center' },
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
                        Toast.fire({
                            icon: data.icon,
                            title: data.msg
                        })
                        if (data.reload) {
                            staffTable.ajax.reload( null, false );
                            socket.emit('updateDataTablesToServer');
                        }
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
                    //text: "You won't be able to revert this!",
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
            $(document).on('click', '.ressetPass', function(e) {
                e.preventDefault();
                var id = $(this).attr('data-id');
                Swal.fire({
                    title: '¿Esta seguro?',
                    //text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, cambiala!'
                }).then((result) => {
                    if (result.value) {
                        resetPasswordstaff(id)
                    } else if (result.dismiss) {
                        Swal.fire(
                            'Cancelado!',
                            'Ninguna contrseña fue cambiada.',
                            'error'
                        )
                        e.preventDefault()
                        e.stopPropagation();
                    }
                })
            });
            $(document).on('click', '.changePermissions', function(event) {
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
                                                                    $.each(data.staff, function(index, value) {
                                                                        if (value.id === val.id) {
                                                                            htmlPermissions += ' checked disabled'
                                                                        }
                                                                    });
                                                                    $.each(data.directPermissions, function(index, valuex) {
                                                                        if (valuex.id === val.id) {
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

                        $('#permisionsRow').show('fast').attr('user', data.id);
                    },
                })
            });
            $(document).on('click', '#cancelPer', function(event) {
                event.preventDefault();
                $('html, body').animate({
                    scrollTop: $("body").offset().top
                }, 2000);
                $('#permisionsRow').hide('fast').attr('user', '');
                $('#groups').html('')
            });
            $(document).on('click', '#sendPer', function(event) {
                var form_data = new FormData();
                var permissionsArray = [];
                var id = $('#permisionsRow').attr('user');
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
                        Toast.fire({
                          icon: data.icon,
                          title: data.msg
                        })
                        $('#cancelPer').click()
                    },
                })
            });

            socket.on('updateDataTablesToClient', () =>  {
                staffTable.ajax.reload( null, false );
            });

            function deleteRecord(id)
            {
                var form_data = new FormData();
                form_data.append('id', id);
                $.ajax({
                    url: globalRouteEliminar,
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
                            staffTable.ajax.reload( null, false );
                            socket.emit('updateDataTablesToServer');
                            //adminTable.search('').draw();
                        }
                    },
                })
            }
            function resetPasswordstaff(id)
            {
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
                            staffTable.ajax.reload( null, false );
                            socket.emit('updateDataTablesToServer');
                            //adminTable.search('').draw();
                        }
                    },
                })
            }
		});

        $(document).on('click', '.changePermissions', function(event) {
            $('html, body').animate({
                scrollTop: $("#permisionsRowScroll").offset().top
            }, 2000);
        });
	</script>
@endsection
