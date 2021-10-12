@extends('staff.layouts.app')
@section('title')
	@lang('Procedures')
@endsection
@section('content')
<div class="page-bar">
    <div class="page-title-breadcrumb">
        <div class=" pull-left">
            <div class="page-title">@lang('Procedures Manager')</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index-2.html">@lang('breadcrumb.Home')</a>&nbsp;<i class="fa fa-angle-right"></i>
            </li>
            <li class="active">@lang('Configuration')&nbsp;<i class="fa fa-angle-right"></i></li>
            <li class="active">@lang('Procedures Manager')</li>
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
                                        <table class="table table-hover table-checkable order-column full-width" id="procedureTable">
                                            <thead>
                                                <tr>
                                                    <th> ID </th>
                                                    <th> @lang('Brand') </th>
                                                    <th> @lang('Service') </th>
                                                    <th> @lang('Procedure') </th>
                                                    <th> @lang('HasPackages') </th>
                                                    <th> @lang('Description') </th>
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
                            <div class="col-md-3">
                                <div class="card-box">
                                    <div class="card-head">
                                        <header>@lang('Services Manager')</header>
                                    </div>
                                    <div class="card-body" id="bar-parent">
                                       <form action="#" id="form_sample_1" class="form-horizontal" autocomplete="off">
                                            <div class="form-body">
                                                <div class="form-group mb-2" style="overflow: hidden">
                                                    <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Image')
                                                    <span class="required">  </span>
                                                    </label>
                                                    <div class="col-md-12">
                                                        <input type="file" name="image" id="image" placeholder="@lang('Procedure English')" class=""  style="overflow: hidden">
                                                        <div class="error text-danger col-form-label-sm"></div>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-2" style="display: none">
                                                    <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Image preview')
                                                    <span class="required">  </span>
                                                    </label>
                                                    <div class="col-md-12 imagePreview">

                                                    </div>
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Service')
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-12">
                                                        <input type="text" name="service" id="service" placeholder="@lang('Service')" class="form-control input-sm autocomplete service" onclick="this.setSelectionRange(0, this.value.length)"/>
                                                        <div class="error text-danger col-form-label-sm"></div>
                                                        <div id="" class="autocomplete-items myInputautocomplete-list service" style="overflow-x: auto; max-height: 200px">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Procedure English')
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-12">
                                                        <input type="text" name="procedure_en" id="procedure_en" placeholder="@lang('Procedure English')" class="form-control input-sm" />
                                                        <div class="error text-danger col-form-label-sm"></div>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Procedure Spanish')
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-12">
                                                        <input type="text" name="procedure_es" id="procedure_es" placeholder="@lang('Procedure Spanish')" class="form-control input-sm validanumericos" />
                                                        <div class="error text-danger col-form-label-sm"></div>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Haz packages')
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-12">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="has_package" id="has_package-no" value="0" checked>
                                                            <label class="form-check-label" for="has_package-no">No</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="has_package" id="has_package-yes" value="1">
                                                            <label class="form-check-label" for="has_package-yes">Yes</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Description English')
                                                    <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-12">
                                                        <textarea name="address" class="form-control-textarea" name="description_en" id="description_en" placeholder="@lang('Description English')" rows="5" style="font-size: 12px;resize: none"></textarea>
                                                        <div class="error text-danger col-form-label-sm"></div>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Description Spanish')
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-12">
                                                        <textarea name="address" class="form-control-textarea" name="description_es" id="description_es" placeholder="@lang('Description Spanish')" rows="5" style="font-size: 12px;resize: none"></textarea>
                                                        <div class="error text-danger col-form-label-sm"></div>
                                                    </div>
                                                </div>
                                           </div>
                                           <div class="form-group">
                                            <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">
                                                <span class="required">  </span>
                                            </label>
                                            <div class="col-md-12" style="align-content: center">
                                                <div class="row">
                                                    <div class="col-12 d-flex justify-content-end">
                                                        {{-- @can('brand.create') --}}
                                                    <button type="button" class="btn btn-info mr-1" id="formSubmit">@lang('Add')</button>
                                                    {{-- @endcan --}}
                                                    <button type="button" class="btn btn-default ml-1" id="formCancel">@lang('Cancel')</button>
                                                    <button type="reset" class="d-none" id="formReset">@lang('Cancel')</button>
                                                    </div>
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
<datalist id="valAutocomplete">
    @foreach ($packages as $package)
        <option data-package="{{ $package->id }}" value="{{ $package->name }}"></option>
    @endforeach
</datalist>
@endsection
@section('styles')
    <link href="{{ asset('staffFiles/assets/plugins/datatables/datatables.min.css') }}"  rel="stylesheet">
    <link href="{{ asset('staffFiles/assets/plugins/magnific-popup-master/dist/magnific-popup.css') }}" rel="stylesheet">
    <style>
        .autocomplete {
          /*the container must be positioned relative:*/
          position: relative;
          display: inline-block;
        }
        .autocomplete-items {
          position:absolute;
          border: 1px solid #d4d4d4;
          border-bottom: none;
          border-top: none;
          z-index: 16777271;
          /*position the autocomplete items to be the same width as the container:*/
          top: 100%;
          left: 0;
          right: 0;
         /* width: 100%*/
         margin-left: 15px;
         margin-right: 15px;
        }
        .autocomplete-items div {
          cursor: pointer;
          background-color: #fff;
          border-bottom: 1px solid #d4d4d4;
          height: 30px;
          padding: 5px 10px;
          font-size: 12px;
          line-height: 1.5;
        }
        .autocomplete-items div:hover {
          /*when hovering an item:*/
          background-color: #e9e9e9;
        }

        .autocomplete-active {
          /*when navigating through the items using the arrow keys:*/
          background-color: DodgerBlue !important;
          color: #ffffff;
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
    <script src="{{ asset('staffFiles/assets/plugins/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('staffFiles/assets/plugins/magnific-popup-master/dist/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('staffFiles/assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>

	<script>
        $('.table').magnificPopup({
              delegate: 'a.a',
              type: 'image',
              removalDelay: 500, //delay removal by X to allow out-animation
              callbacks: {
                beforeOpen: function() {
                  // just a hack that adds mfp-anim class to markup
                   this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
                   this.st.mainClass = this.st.el.attr('data-effect');
                }
              },
              closeOnContentClick: true,
              midClick: true // allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source.
        });
        var globalRouteobtenerLista = "{{ route('staff.treatments.configuration.getProcedureList') }}";
        var globalRouteStore = "{{ route('staff.treatments.configuration.storeProcedure') }}";
        var globalRouteActivar = "{{ route('staff.treatments.configuration.activateProcedure') }}"
        var globalRouteEditar = "{{ route('staff.treatments.configuration.editProcedure') }}"
        var globalRouteUpdate = "{{ route('staff.treatments.configuration.updateProcedure') }}"
        var globalRouteDestroy = "{{ route('staff.treatments.configuration.destroyProcedure') }}"
        var globalRouteSearchService = "{{ route('staff.autocomplete.AutocompleteService') }}";



        $(document).ready(function () {
            var codigo = 1;
		    var procedureTable = $('#procedureTable').DataTable({
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
                    { data: "brand" },
                    { data: "service" },
		            { data: "procedure" },
		            { data: "haspackage", className: 'center' },
		            { data: "description" },
		            { data: "active", className: 'center' },
		            { data: "action", orderable: false, searchable: false, className: 'center' },

		        ],
		        createdRow: function (row, data, dataIndex) {
		            $(row).addClass('odd gradeX');
		        },
		    });

            $(document).on("click", "#formSubmit", function () {

                $('.error').html('')

                var form_data = new FormData();
                form_data.append('service', $('#service').attr('data-id'))
                form_data.append('procedure_en', $('#procedure_en').val())
                form_data.append('procedure_es', $('#procedure_es').val())
                form_data.append('has_package', $("input[name='has_package']:checked").val());
                form_data.append('description_en', $('#description_en').val());
                form_data.append('description_es', $('#description_es').val());
                var files = $('#image')[0].files;
                if(files.length > 0 ){
                    form_data.append('image',files[0]);
                }
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
                            procedureTable.ajax.reload( null, false );
                            clearForm()
                        } else {

                            $.each( data.errors, function( key, value ) {
                                kFormat = key.replace('.', "_");
                                fFormat = kFormat.replace('.', "_");

                                $('*[id^='+fFormat+']').parent().find('.error').append('<p>'+value+'</p>')
                                $('*[id^='+fFormat+']').parents('.cloned').find('.error').append('<p>'+value+'</p>')
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

            $('.autocomplete.service').on('keyup', function() {
                var key = $(this).val();
                var dataString = new FormData();
                dataString.append('key', key);
                $.ajax({
                    type: "POST",
                    url: globalRouteSearchService,
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
                        $('.myInputautocomplete-list.service').html('');
                    },
                    success: function(data) {
                        console.log(data);
                        var sugerencias = '';
                        if (data.length > 0) {
                            for (var i = 0; i < data.length; i++) {
                                sugerencias += '<div><a class="suggest-element" data="' + data[i].id + '">' + data[i].service + '</a></div>';
                            }
                        } else {
                            sugerencias += '<div><a class="suggest-element no-show-patient" data="" id="">No se encontraron resultados</a></div>';
                        }
                        $('.myInputautocomplete-list.service').fadeIn(1000).append(sugerencias);
                        $('.suggest-element').not('.no-show-patient').on('click', function(){
                            var id = $(this).attr('data');
                            var service = $(this).text();
                            $('.autocomplete.service').val(service).attr('data-id', id);
                            $('.myInputautocomplete-list.service').fadeOut(1000).html('');
                            return false;
                        });
                    }
                });
            });

            function clearForm(){
                $('#brand').val('')
                $('#brand').removeAttr('data-id')
                $('#service_en').val('')
                $('#service_es').val('')
                $('#qty_images').val('')
                $('#description_en').val('')
                $('#description_es').val('')
                $(".clone-area").html('')
                $("#formReset").click()
                $('#formEdit')
                .removeAttr('procedure')
                .html('Add')
                .attr('id', 'formSubmit')
                $('.holi').remove()
                $('imagePreview').parents('.form-group').hide('fast')
                $('#image').val('');
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
                            procedureTable.ajax.reload( null, false );
                        }
                    },
                    complete: function()
                    {
                    },
                })
            });

            $(document).on('click', '.btn-tbl-edit', function (event) {
                var procedureId = $(this).attr('data-id')
                var form_data = new FormData();
                form_data.append('id', procedureId);
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
                            $('#formSubmit').html('edit').attr({
                                procedure: $.trim(procedureId),
                                id: 'formEdit'
                            });

                            $('#service').attr('data-id', data.info.service.id)
                            $('#service').val(data.info.service.service)
                            $('#procedure_en').val(data.info.procedure_en)
                            $('#procedure_es').val(data.info.procedure_es)
                            $("input[type='radio'][name='has_package'][value='"+data.info.has_package+"']").attr('checked',true);
                            $('#description_en').val(data.info.description_en);
                            $('#description_es').val(data.info.description_es);
                        } else {
                                Toast.fire({
                                icon: data.icon,
                                title: data.msg
                            })
                            procedureTable.ajax.reload( null, false );
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
                $('.error').html('')
                var form_data = new FormData();
                form_data.append('id', $(this).attr('procedure'))
                form_data.append('service', $('#service').attr('data-id'))
                form_data.append('procedure_en', $('#procedure_en').val())
                form_data.append('procedure_es', $('#procedure_es').val())
                form_data.append('has_package', $("input[name='has_package']:checked").val());
                form_data.append('description_en', $('#description_en').val());
                form_data.append('description_es', $('#description_es').val());
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
                            procedureTable.ajax.reload( null, false );
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

            $(document).on('change', '#image', function(event) {
            readURL(this);
            });
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        //$('.foto-pac').attr('src', );
                        $('.imagePreview').parents('.form-group').show('fast');

                        var img = '<img class="rounded-3 holis img-fluid" src=" ' + e.target.result + ' " alt="" style="height: 169px;">';

                        $('.holis').resizable({ aspectRatio:true, maxHeight:300 })

                        $('.imagePreview').html(img);

                    }

                    reader.readAsDataURL(input.files[0]);
                } else {

                    //$('.foto-pac').attr('src',  document.location.origin+'/images/user-xs.png');
                }
            }

            $(document).on('click', '#formCancel', function () {
                clearForm()
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
                    console.log("data", data);
                        Toast.fire({
                          icon: data.icon,
                          title: data.msg
                        })
                        if (data.reload) {
                            procedureTable.ajax.reload( null, false );
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

        function numbers(){
            $(this).val($(this).val().replace(/[^0-9]/g, ''));
        }
        $(document).ready(function(){

            $("#but_upload").click(function(){

                var fd = new FormData();
                var files = $('#file')[0].files;

                // Check file selected or not
                if(files.length > 0 ){
                    fd.append('file',files[0]);

                    $.ajax({
                        url: 'upload.php',
                        type: 'post',
                        data: fd,
                        contentType: false,
                        processData: false,
                        success: function(response){
                            if(response != 0){
                                $("#img").attr("src",response);
                                $(".preview img").show(); // Display image element
                            }else{
                                alert('file not uploaded');
                            }
                        },
                    });
                }else{
                    alert("Please select a file.");
                }
            });
        });
    </script>
@endsection
