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
                            <div class="card  card-box">
                                <div class="card-head">
                                    <header></header>
                                    <div class="tools">
                                        {{ app()->getLocale() }}
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
        
        var globalRouteobtenerLista = "{{ route('staff.staff.getStaffList') }}";
		var globalRouteActivar = "{{ route('staff.staff.activate') }}";
        var globalRouteEliminar = "{{ route('staff.staff.destroy') }}"
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
		            "url": dataTablesLangEs
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
