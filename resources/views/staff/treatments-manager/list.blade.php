@extends('staff.layouts.app')
@section('title')
	@lang('Treatment')
@endsection
@section('content')
<div class="page-bar">
    <div class="page-title-breadcrumb">
        <div class=" pull-left">
            <div class="page-title">@lang('Treatment Manager')</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li>
                <i class="fa fa-home"></i>&nbsp;
                <a class="parent-item" href="index-2.html">@lang('breadcrumb.Home')</a>
                &nbsp;<i class="fa fa-angle-right">

                </i>
            </li>
            <li class="active">@lang('Configuration')&nbsp;
                <i class="fa fa-angle-right"></i>
            </li>
            <li class="active">@lang('Treatment Manager')</li>
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
                                        <table class="table table-hover table-checkable order-column full-width" id="treatmentsTable">
                                            <thead>
                                                <tr>
                                                    <th> ID </th>
                                                    <th> @lang('Image') </th>
                                                    <th> @lang('Brand') </th>
                                                    <th> @lang('Service') </th>
                                                    <th> @lang('Procedure') </th>
                                                    <th> @lang('Package') </th>
                                                    <th> @lang('Price') </th>
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
                                        <header>@lang('Treatment Manager')</header>
                                    </div>
                                    <div class="card-body" id="bar-parent">
                                       <form action="#" id="form_sample_1" class="form-horizontal" autocomplete="off">
                                            <div class="form-body">
                                                <div class="form-group mb-2">
                                                    <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Image Treatment')
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-12">
                                                        <input type="file" name="image" id="image" class="dropify" />
                                                        <div class="error text-danger col-form-label-sm"></div>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Service')
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-12">
                                                        <input type="text" name="service" id="service" placeholder="@lang('Enter service name')" class="form-control input-sm autocomplete service" onclick="this.setSelectionRange(0, this.value.length)"/>
                                                        <div class="error text-danger col-form-label-sm"></div>
                                                        <div id="" class="autocomplete-items myInputautocomplete-list service" style="overflow-x: auto; max-height: 200px">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Procedure')
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-12">
                                                        <input type="text" name="procedure" id="procedure" placeholder="@lang('Enter procedure name')" class="form-control input-sm autocomplete procedure" onclick="this.setSelectionRange(0, this.value.length)"/>
                                                        <div class="error text-danger col-form-label-sm"></div>
                                                        <div id="" class="autocomplete-items myInputautocomplete-list procedure" style="overflow-x: auto; max-height: 200px">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-2 pack_div" style="display: none">
                                                    <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Package')
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-12">
                                                        <input type="text" name="package" id="package" placeholder="@lang('Enter package name')" class="form-control input-sm autocomplete package" onclick="this.setSelectionRange(0, this.value.length)"/>
                                                        <div class="error text-danger col-form-label-sm"></div>
                                                        <div id="" class="autocomplete-items myInputautocomplete-list package" style="overflow-x: auto; max-height: 200px">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Clave')
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-12">
                                                        <input type="text" name="clave" id="clave"  class="form-control input-sm " placeholder="@lang('Enter clave')"/>
                                                        <div class="error text-danger col-form-label-sm"></div>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Price')
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-12">
                                                        <input type="text" name="price" id="price"  class="form-control input-sm floatTextBox" placeholder="@lang('Enter price')"/>
                                                        <div class="error text-danger col-form-label-sm"></div>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Includes')
                                                        <span class="required">  </span>
                                                    </label>
                                                    <div class="col-md-12 includes" id="includes">
                                                        {{-- <input type="text" name="price" id="price"  class="form-control input-sm" placeholder="@lang('Enter Include En')"/>
                                                        <div class="error text-danger col-form-label-sm"></div>
                                                        <input type="text" name="price" id="price"  class="form-control input-sm" placeholder="@lang('Enter Include Es')"/>
                                                        <div class="error text-danger col-form-label-sm"></div>
                                                       <div class="d-flex justify-content-end">
                                                           <button type="button" class="btn btn-danger btn-flat btn-sm" id="btn-delete-includes">Remove Includes <i class="material-icons" style="font-size: 8px">remove_circle</i>
                                                           </button>
                                                       </div>
                                                       <hr> --}}
                                                    </div>
                                                </div>
                                                <div class="col-md-12 d-flex justify-content-end mt-5">
                                                    <button type="button" class="btn btn-success btn-sm" id="btn-add-includes">Add Includes <i class="material-icons f-left" style="font-size: 8px">add_circle</i>
                                                    </button>
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
{{-- <datalist id="valAutocomplete">
    @foreach ($specialites as $specialty)
        <option data-specialty="{{ $specialty->id }}" value="{{ $specialty->name }}"></option>
    @endforeach
</datalist> --}}
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

        var globalRouteobtenerLista = "{{ route('staff.treatments.getTreatmentsList') }}";
        var globalRouteStore = "{{ route('staff.treatments.storeProduct') }}";
        var globalRouteActivar = "{{ route('staff.treatments.activateProduct') }}"
        var globalRouteEditar = "{{ route('staff.treatments.editProduct') }}"
        var globalRouteUpdate = "{{ route('staff.treatments.updateProduct') }}"
        var globalRouteDestroy = "{{ route('staff.treatments.destroyProduct') }}"
        var globalRouteSearchBrand = "{{ route('staff.autocomplete.AutocompleteBrand') }}";
        var globalRouteSearchService = "{{ route('staff.autocomplete.AutocompleteService') }}";
        var globalRouteSearchProcedure = "{{ route('staff.autocomplete.AutocompleteProcedure') }}";
        var globalRouteSearchPackage = "{{ route('staff.autocomplete.AutocompletePackage') }}";
        var globalRouteDeleteFile = "{{ route('staff.treatments.imageDestroy') }}";

        $(document).ready(function () {
            addIncludes()
            $('.form-body').slimscroll({
                height: $('#form_sample_1').height(),
                position: "right",
                size: "5px",
                color: "#9ea5ab",
            })
            var codigo = 1;
		    var treatmentsTable = $('#treatmentsTable').DataTable({
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
					   { data: 'image' },
		            { data: "brand" },
		            { data: "service" },
		            { data: "procedure" },
		            { data: "package" },
		            { data: "price" },
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
                //form_data.append('brand', $('#brand').attr('data-id'))
                form_data.append('service', $('#service').attr('data-id'))
                form_data.append('procedure', $('#procedure').attr('data-id'))
                form_data.append('package', $('#package').attr('data-id'))
                form_data.append('price', $('#price').val())
                form_data.append('clave', $('#clave').val())
                form_data.append('image', $('#image').prop('files')[0])
                var include_es = [];
                var include_en = [];

                $('#includes .include').each(function(index, el) {
                    var en = $(this).find('.includes_en').prop('id', 'include_en_'+index);
                    var es = $(this).find('.includes_es').prop('id', 'include_es_'+index);
                        include_en.push({include_en: en.val()})
                        include_es.push({include_es: es.val()})
                });

                form_data.append('includes_en', JSON.stringify(include_en))
                form_data.append('includes_es', JSON.stringify(include_es))

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
                            treatmentsTable.ajax.reload( null, false );
                            socket.emit('updateDataTablesToServer');
                            clearForm()
                        } else {

                            $.each( data.errors, function( key, value ) {
                                kFormat = key.replace(".", "_");
                                $('*[id^='+kFormat+']').parent().find('.error').append('<p>'+value+'</p>')
                                $('*[id^='+kFormat+']').parents('.cloned').find('.error').append('<p>'+value+'</p>')
                            });
                        }

                    },
                    error: function (err)
                    {
                        //console.clear()
                        var data = err.responseJSON;
                        $.each( data.errors, function( key, value ) {
                            kFormat = key.replace(".", "_");
                            $('*[id^='+kFormat+']').parent().find('.error').append('<p>'+value+'</p>')
                            $('*[id^='+kFormat+']').parents('.cloned').find('.error').append('<p>'+value+'</p>')
                        });
                    },
                    complete: function()
                    {
                    },
                })
            });

            $( document ).on('focus', 'input', function() {
                $('.error').html('')
            });

            $('.autocomplete.brand').on('keyup', function() {
                var key = $(this).val();
                var dataString = new FormData();
                $('.service').val('').removeAttr('data-id')
                $('.procedure').val('').removeAttr('data-id')
                $('.package').val('').removeAttr('data-id')
                dataString.append('key', key);
                $.ajax({
                    type: "POST",
                    url: globalRouteSearchBrand,
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
                        $('#myInputautocomplete-list.brand').html('');
                    },
                    success: function(data) {
                        var sugerencias = '';
                        if (data.length > 0) {
                            for (var i = 0; i < data.length; i++) {
                                sugerencias += '<div><a class="suggest-element" data="' + data[i].id + '">' + data[i].brand + '</a></div>';
                            }
                        } else {
                            sugerencias += '<div><a class="suggest-element no-show-patient" data="" id="">No se encontraron resultados</a></div>';
                        }
                        $('#myInputautocomplete-list.brand').fadeIn(1000).append(sugerencias);
                        $('.suggest-element').not('.no-show-patient').on('click', function(){
                            var id = $(this).attr('data');
                            var brand = $(this).text();
                            $('.autocomplete.brand').val(brand).attr('data-id', id);
                            $('#myInputautocomplete-list.brand').fadeOut(1000).html('');
                            return false;
                        });
                    }
                });
            });

            $('.autocomplete.service').on('keyup click', function() {
                var key = $(this).val();
                var dataString = new FormData();
                dataString.append('key', key);
                //dataString.append('brand', $('#brand').attr('data-id'));
                $('.procedure').val('').removeAttr('data-id')
                $('.package').val('').removeAttr('data-id')
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

            $('.autocomplete.procedure').on('keyup click', function() {
                var key = $(this).val();
                var dataString = new FormData();
                dataString.append('key', key);
                dataString.append('service', $('#service').attr('data-id'));
                $('.package').val('').removeAttr('data-id')
                $.ajax({
                    type: "POST",
                    url: globalRouteSearchProcedure,
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
                        $('.myInputautocomplete-list.procedure').html('');
                    },
                    success: function(data) {
                        var sugerencias = '';
                        if (data.length > 0) {
                            for (var i = 0; i < data.length; i++) {
                                sugerencias += '<div><a class="suggest-element getpack" pack="' + data[i].package + '" data="' + data[i].id + '">' + data[i].procedure + '</a></div>';
                            }

                        } else {
                            sugerencias += '<div><a class="suggest-element no-show-patient" data="" id="">No se encontraron resultados</a></div>';
                        }
                        $('.myInputautocomplete-list.procedure').fadeIn(1000).append(sugerencias);
                        $('.suggest-element').not('.no-show-patient').on('click', function(){
                            var id = $(this).attr('data');
                            var procedure = $(this).text();
                            var pack = $(this).attr('pack');
                            $('.autocomplete.procedure').val(procedure).attr('data-id', id);
                            $('.autocomplete.procedure').attr('pack', pack);
                            $('.myInputautocomplete-list.procedure').fadeOut(1000).html('');
                            if (pack == '1') {
                                $('.pack_div').show('fast')
                            } else {
                                $('.pack_div').hide('fast')
                            }
                            return false;
                        });
                    }
                });
            });

            $('.autocomplete.package').on('keyup click', function() {
                var key = $(this).val();
                var dataString = new FormData();
                dataString.append('key', key);
                dataString.append('procedure', $('#procedure').attr('data-id'));
                $.ajax({
                    type: "POST",
                    url: globalRouteSearchPackage,
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
                        $('.myInputautocomplete-list.package').html('');
                    },
                    success: function(data) {
                        var sugerencias = '';
                        if (data.length > 0) {
                            for (var i = 0; i < data.length; i++) {
                                sugerencias += '<div><a class="suggest-element" data="' + data[i].id + '">' + data[i].package + '</a></div>';
                            }
                        } else {
                            sugerencias += '<div><a class="suggest-element no-show-patient" data="" id="">No se encontraron resultados</a></div>';
                        }
                        $('.myInputautocomplete-list.package').fadeIn(1000).append(sugerencias);
                        $('.suggest-element').not('.no-show-patient').on('click', function(){
                            var id = $(this).attr('data');
                            var package = $(this).text();
                            $('.autocomplete.package').val(package).attr('data-id', id);
                            $('.myInputautocomplete-list.package').fadeOut(1000).html('');
                            return false;
                        });
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
                            treatmentsTable.ajax.reload( null, false );
                        }
                    },
                    complete: function()
                    {
                    },
                })
            });

            $(document).on('click', '.tbl-edit', function (event) {
                var productId = $(this).attr('data-id')
                var form_data = new FormData();
                form_data.append('id', productId);
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
                            drEvents.settings.defaultFile = image_url;
                            drEvents.destroy();
                            drEvents.init();
                            if (data.info.image_one) {
                                $('#image').attr('data-id', data.info.image_one.id);
                            }

                            $('form').attr('treatments', data.info.id)
                            $('#service').val(data.info.service.service).attr('data-id', data.info.service.id);
                            $('#procedure').attr('pack', data.info.procedure.package);
                            $('#procedure').val(data.info.procedure.procedur).attr('data-id', data.info.procedure.id);
                            if (data.info.package_id !== null) {
                                $('#package').val(data.info.package.package).attr('data-id', data.info.package.id).parents('.pack_div').show('fast')
                            } else {
                                $('#package').parents('.pack_div').hide('fast').val('').removeAttr('data-id')
                            }
                            $('#price').val(data.info.price);
                            $('#clave').val(data.info.clave);

                            if (data.info.contains.length > 0) {
                                    $("#includes").html('')
                                $.each(data.info.contains, function(index, val) {
                                    addIncludesEdit(val)
                                });
                            } else {
                                $("#includes").html('');
                                addIncludes()
                            }

                            $('#formSubmit').html('edit').attr({
                                product: $.trim(productId),
                                id: 'formEdit'
                            });

                        } else {
                            Toast.fire({
                                icon: data.icon,
                                title: data.msg
                            })
                            treatmentsTable.ajax.reload( null, false );
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
                form_data.append('brand', $('#brand').attr('data-id'))
                form_data.append('service', $('#service').attr('data-id'))
                form_data.append('procedure', $('#procedure').attr('data-id'))
                form_data.append('package', $('#package').attr('data-id'))
                form_data.append('price', $('#price').val())
                form_data.append('clave', $('#clave').val())
                form_data.append('description_en', $('#description_en').val());
                form_data.append('description_es', $('#description_es').val());
                form_data.append('image', $('#image').prop('files')[0])
                form_data.append('id_image', $('#image').attr('data-id'))
                form_data.append('id', $(this).attr('product'));
                var include_es = [];
                var include_en = [];

                $('#includes .include').each(function(index, el) {
                    var en = $(this).find('.includes_en').prop('id', 'include_en_'+index);
                    var es = $(this).find('.includes_es').prop('id', 'include_es_'+index);
                        include_en.push({include_en: en.val()})
                        include_es.push({include_es: es.val()})
                });

                form_data.append('includes_en', JSON.stringify(include_en))
                form_data.append('includes_es', JSON.stringify(include_es))
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
                    console.log("data", data);
                        Toast.fire({
                            icon: data.icon,
                            title: data.msg
                        })
                        if (data.reload) {
                            treatmentsTable.ajax.reload( null, false );
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

            $(document).on('click', '#formCancel', function () {
                clearForm()
            });

            $(document).on('click', '.dropify-clear', function(event) {
                event.preventDefault();
                var form_data = new FormData();
                form_data.append('id_image', $('#image').attr('data-id'));
                form_data.append('treatment', $('form').attr('treatments'));
                $.ajax({
                    url: globalRouteDeleteFile,
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
                        treatmentsTable.ajax.reload( null, false );
                        socket.emit('updateDataTablesToServer');
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

            $(document).on('click', '#btn-add-includes', function(event) {
                event.preventDefault();
                addIncludes()
            });

            $(document).on('click', '#btn-delete-includes', function(event) {
                event.preventDefault();
                $(this).parents('.include').remove();
                if ($('.include').length == 0) {addIncludes()}
            });

            function deleteRecord(id){
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
                            treatmentsTable.ajax.reload( null, false );
                            socket.emit('updateDataTablesToServer');
                        } else {
                            socket.emit('updateDataTablesToServer');
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
            function clearDropify(){
                drEvents = drEvent.data('dropify');
                drEvents.resetPreview();
                drEvents.clearElement();
            }
            function clearForm(){
                $('#brand').val('').removeAttr('data-id')
                $('#service').val('').removeAttr('data-id')
                $('#procedure').val('').removeAttr('data-id')
                $('#package').val('').removeAttr('data-id')
                $('#price').val('')
                $('#clave').val('')
                $("#formReset").click()
                $('#formEdit')
                .removeAttr('service')
                .html('Add')
                .attr('id', 'formSubmit')
                clearDropify()
                $("#includes").html('');
                addIncludes()
                $('#image').removeAttr('data-id');
                $('form').removeAttr('treatments')
            }
            function addIncludes(){
                let includes = '';
                includes += '<div class="include">'
                includes += '<input type="text" name="includes_en[]" class="form-control input-sm includes_en" placeholder="@lang('Enter Include En')"/>';
                includes += '<div class="error text-danger col-form-label-sm"></div>';
                includes += '<input type="text" name="includes_es[]" class="form-control input-sm includes_es" placeholder="@lang('Enter Include Es')"/>';
                includes += '<div class="error text-danger col-form-label-sm"></div>';
                includes += '<div class="d-flex justify-content-end">';
                   includes += '<button type="button" class="btn btn-danger btn-flat btn-sm ml-auto" id="btn-delete-includes">Remove Includes <i class="material-icons" style="font-size: 8px">remove_circle</i>';
                   includes += '</button>';
                includes += '</div>';
                includes += '<hr>';
                includes += '</div>';

                $("#includes").append(includes);
            }
            function addIncludesEdit(contain){

                let includes = '';
                includes += '<div class="include">'
                includes += '<input type="text" name="includes_en[]" value="'+contain.contain_en+'" class="form-control input-sm includes_en" placeholder="@lang('Enter Include En')"/>';
                includes += '<div class="error text-danger col-form-label-sm"></div>';
                includes += '<input type="text" name="includes_es[]" value="'+contain.contain_es+'" class="form-control input-sm includes_es" placeholder="@lang('Enter Include Es')"/>';
                includes += '<div class="error text-danger col-form-label-sm"></div>';
                includes += '<div class="d-flex justify-content-end">';
                   includes += '<button type="button" class="btn btn-danger btn-flat btn-sm ml-auto" id="btn-delete-includes">Remove Includes <i class="material-icons" style="font-size: 8px">remove_circle</i>';
                   includes += '</button>';
                includes += '</div>';
                includes += '<hr>';
                includes += '</div>';

                $("#includes").append(includes);
            }

            socket.on('updateDataTablesToClient', () =>  {
                treatmentsTable.ajax.reload( null, false );
            });

        });

    </script>
@endsection
