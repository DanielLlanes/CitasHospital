@extends('staff.layouts.app')
@section('title')
	@lang('Services')
@endsection
@section('content')
<div class="page-bar">
    <div class="page-title-breadcrumb">
        <div class=" pull-left">
            <div class="page-title">@lang('Services Manager')</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index-2.html">@lang('breadcrumb.Home')</a>&nbsp;<i class="fa fa-angle-right"></i>
            </li>
            <li class="active">@lang('Services Manager')</li>
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
                            <div class="col-md-8">
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
                                        <table class="table table-hover table-checkable order-column full-width" id="serviceTable">
                                            <thead>
                                                <tr>
                                                    <th> ID </th>
                                                    <th> @lang('Service') </th>
                                                    <th> @lang('Brand') </th>
                                                    <th> @lang('Need Image') </th>
                                                    <th> @lang('Qty Images') </th>
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
                            <div class="col-md-4">
                                <div class="card-box">
                                    <div class="card-head">
                                        <header>@lang('Services Manager')</header>
                                    </div>
                                    <div class="card-body" id="bar-parent">
                                       <form action="#" id="form_sample_1" class="form-horizontal" autocomplete="off">
                                            <div class="form-body">
                                                <div class="form-group mb-2">
                                                    <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Brand')
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-12">
                                                        <input type="text" name="brand" id="brand" autocomplete="off" placeholder="@lang('Enter brand name')" class="form-control input-sm autocomplete brand" onClick="this.setSelectionRange(0, this.value.length)" />
                                                        <div class="error text-danger col-form-label-sm"></div>
                                                        <div id="myInputautocomplete-list" class="autocomplete-items brand" style="overflow-x: auto; max-height: 200px">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Service english')
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-12">
                                                        <input type="text" name="service_en" id="service_en" placeholder="@lang('Service english')" class="form-control input-sm" />
                                                        <div class="error text-danger col-form-label-sm"></div>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Service spanish')
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-12">
                                                        <input type="text" name="service_es" id="service_es" placeholder="@lang('Service spanish')" class="form-control input-sm" />
                                                        <div class="error text-danger col-form-label-sm"></div>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Need images')
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-12">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="need_images" id="need_images-no" value="0" checked>
                                                            <label class="form-check-label" for="need_images-no">No</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="need_images" id="need_images-yes" value="1">
                                                            <label class="form-check-label" for="need_images-yes">Yes</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group mb-2" style="display: none">
                                                    <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Quantity of images')
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-12">
                                                        <input type="text" name="qty_images" id="qty_images" placeholder="@lang('Quantity of images')" class="form-control input-sm validanumericos" />
                                                        <div class="error text-danger col-form-label-sm"></div>
                                                    </div>
                                                </div>

                                                <div class="form-group mb-2">
                                                    <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Specialties')
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-12 d-none" id="clone_div">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control input-sm" onclick="this.setSelectionRange(0, this.value.length)" placeholder="Add specialties" list="valAutocomplete">
                                                            <span class="input-group-btn">
                                                                <button type="button" class="btn btn-danger btn-flat btn-sm" style="margin-top: 3px">
                                                                    <i class="material-icons f-left" style="font-size: 8px">remove_circle</i>
                                                                </button>
                                                            </span>

                                                        </div>
                                                        <div class="error text-danger col-form-label-sm"></div>
                                                    </div>
                                                    <div class="clone-area">
                                                    </div>
                                                    <div class="col-md-12 d-flex justify-content-end mt-2">
                                                        <button type="button" class="btn btn-success btn-sm" id="btn-add-secialtie">Add specialtie <i class="material-icons f-left" style="font-size: 8px">add_circle</i>
                                                        </button>
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
    @foreach ($specialites as $specialty)
        <option data-specialty="{{ $specialty->id }}" value="{{ $specialty->name }}"></option>
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
        var globalRouteobtenerLista = "{{ route('staff.products.getServiceList') }}";
        var globalRouteStore = "{{ route('staff.products.storeService') }}";
        var globalRouteActivar = "{{ route('staff.products.activateService') }}"
        var globalRouteEditar = "{{ route('staff.products.editService') }}"
        var globalRouteUpdate = "{{ route('staff.products.updateService') }}"
        var globalRouteDestroy = "{{ route('staff.products.destroyService') }}"
        var globalRouteSearchBrand = "{{ route('staff.autocomplete.AutocompleteBrand') }}";



        $(document).ready(function () {
            function cloneSpecialyArea(){
                var newelw = $('#clone_div').clone();
                newelw.removeAttr('id');
                newelw.show('fast');
                newelw.addClass('cloned')
                newelw.removeClass('d-none')
                newelw.find('input').val('').removeAttr('data-id').addClass('input_specialties').prop('name', 'input_specialties[]')
                newelw.find('button').addClass('btn-remove-specialtie')
                $(".clone-area").append(newelw)
            }
            function cloneSpecialyAreaEdit(inputValue, idValue){
                var newelw = $('#clone_div').clone();
                newelw.removeAttr('id');
                newelw.show('fast');
                newelw.addClass('cloned')
                newelw.removeClass('d-none')
                newelw.find('input').val(inputValue).attr('data-id', idValue).addClass('input_specialties').prop('name', 'input_specialties[]')
                newelw.find('button').addClass('btn-remove-specialtie')
                $(".clone-area").append(newelw)
            }
            cloneSpecialyArea()
            var codigo = 1;
		    var serviceTable = $('#serviceTable').DataTable({
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
		            { data: "service" },
		            { data: "brand" },
		            { data: "need_images" },
		            { data: "qty_images" },
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
                form_data.append('brand', $('#brand').attr('data-id'))
                form_data.append('service_en', $('#service_en').val())
                form_data.append('service_es', $('#service_es').val())

                if ($("input[name='need_images']:checked").val() == '1') {
                    form_data.append('need_images', 1)
                    form_data.append('qty_images', $('#qty_images').val())
                } else {
                    form_data.append('need_images', 0)
                    form_data.append('qty_images', 0)
                }

                form_data.append('description_en', $('#description_en').val());
                form_data.append('description_es', $('#description_es').val());
                specialties_cadena = [];
                $(".input_specialties").each(function(indice,elemento){
                    if( $(this).attr('data-id') && $(this).val() ) {
                        $(this).prop('id', 'input_specialties_'+indice)
                        specialties_cadena.push({id: $(this).attr('data-id'), name: $(this).val()})
                    }
                });

                form_data.append('input_specialties', JSON.stringify(specialties_cadena))
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
                            serviceTable.ajax.reload( null, false );
                            clearForm()
                        } else {

                            $.each( data.errors, function( key, value ) {
                                kFormat = key.replace(".", "_");
                                console.log(kFormat);
                                $('*[id^='+kFormat+']').parent().find('.error').append('<p>'+value+'</p>')
                                $('*[id^='+kFormat+']').parents('.cloned').find('.error').append('<p>'+value+'</p>')
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

            $('.autocomplete.brand').on('keyup', function() {
                var key = $(this).val();
                var dataString = new FormData();
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
                        console.log(data);
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
                .removeAttr('service')
                .html('Add')
                .attr('id', 'formSubmit')
                cloneSpecialyArea()
            }

            $('input[name=need_images]').on('change', function() {
                $('#qty_images').val('')
                if($(this).val() == '1'){
                    $('#qty_images').parents('.form-group').show('fast');
                } else {
                    $('#qty_images').parents('.form-group').hide('fast');
                }
            });

            $(document).on('click', '#btn-add-secialtie', function () {
                cloneSpecialyArea()
            });

            $(document).on('click', '.btn-remove-specialtie', function () {
                $(this).parents('.cloned').remove();

                if(document.getElementsByClassName("cloned").length == 0){
                    cloneSpecialyArea()
                }
            });

            $(document).on('change', '.input_specialties', function(event) {
                event.preventDefault();
                var roleText = $(this).val();
                var roleId = $("#valAutocomplete option[value='"+roleText+"']").attr('data-specialty');
                $(this).attr('data-id', roleId);
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
                            serviceTable.ajax.reload( null, false );
                        }
                    },
                    complete: function()
                    {
                    },
                })
            });

            $(document).on('click', '.btn-tbl-edit', function (event) {
                var serviceId = $(this).attr('data-id')
                var form_data = new FormData();
                form_data.append('id', serviceId);
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
                        console.log(data);

                        if (data.success) {
                            clearForm()

                            $('#brand').val(data.info.brand.brand).attr('data-id', data.info.brand.id);
                            $('#service_en').val(data.info.service_en);
                            $('#service_es').val(data.info.service_es);
                            $('#description_en').val(data.info.description_en);
                            $('#description_es').val(data.info.description_es);
                            $('#need_images').val(data.info.need_images);

                            if (data.info.need_images > 0) {
                                $('#qty_images').parents('.form-group').show('fast').val(data.info.qty_images)
                                $("input[name=need_images][value='1']").prop("checked",true);
                            } else {
                                $('#qty_images').parents('.form-group').hide('fast').val('')
                                $("input[name=need_images][value='0']").prop("checked",true);
                            }
                            $('#qty_images').val(data.info.qty_images);
                            $('#description_es').val(data.info.description_es);
                            $('#formSubmit').html('edit').attr({
                                service: $.trim(serviceId),
                                id: 'formEdit'
                            });
                            $(".clone-area .cloned").remove()
                            $.each( data.info.specialties, function( key, value ) {
                                cloneSpecialyAreaEdit(value.specialty_name,  value.id)
                            });

                        } else {
                            Toast.fire({
                                icon: data.icon,
                                title: data.msg
                            })
                            serviceTable.ajax.reload( null, false );
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
                form_data.append('id', $('#formEdit').attr('service'));
                form_data.append('brand', $('#brand').attr('data-id'))
                form_data.append('service_en', $('#service_en').val())
                form_data.append('service_es', $('#service_es').val())

                if ($("input[name='need_images']:checked").val() == '1') {
                    form_data.append('need_images', 1)
                    form_data.append('qty_images', $('#qty_images').val())
                } else {
                    form_data.append('need_images', 0)
                    form_data.append('qty_images', 0)
                }

                form_data.append('description_en', $('#description_en').val());
                form_data.append('description_es', $('#description_es').val());

                specialties_cadena = [];
                $(".input_specialties").each(function(indice,elemento){
                    if( $(this).attr('data-id') && $(this).val() ) {
                        $(this).prop('id', 'input_specialties_'+indice)
                        specialties_cadena.push({id: $(this).attr('data-id'), name: $(this).val()})
                    }
                });


                form_data.append('input_specialties', JSON.stringify(specialties_cadena))
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
                            serviceTable.ajax.reload( null, false );
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
                            serviceTable.ajax.reload( null, false );
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

        onload = function(){
            var ele = document.querySelectorAll('.validanumericos')[0];
            ele.onkeypress = function(e) {
                if(isNaN(this.value+String.fromCharCode(e.charCode)))
                    return false;
            }
            ele.onpaste = function(e){
                e.preventDefault();
            }
        }

    </script>
@endsection
