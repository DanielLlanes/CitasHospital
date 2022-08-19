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
                                                    <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Service')
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-12">
                                                        {{-- <input type="text" name="service" id="service" placeholder="@lang('Enter service name')" class="form-control input-sm autocomplete service" onclick="this.setSelectionRange(0, this.value.length)"/> --}}
                                                        <select name="service" id="service" class="form-control input-sm"></select>
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
                                                        {{-- <input type="text" name="procedure" id="procedure" placeholder="@lang('Enter procedure name')" class="form-control input-sm autocomplete procedure" onclick="this.setSelectionRange(0, this.value.length)"/> --}}
                                                        <select name="procedure" id="procedure" class="form-control input-sm" ></select>
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
                                                        {{-- <input type="text" name="package" id="package" placeholder="@lang('Enter package name')" class="form-control input-sm autocomplete package" onclick="this.setSelectionRange(0, this.value.length)"/> --}}
                                                        <select name="package" id="package" class="form-control input-sm"></select>
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
                                                        <span class="required">  </span>
                                                    </label>
                                                    <div class="col-md-12">
                                                        <input type="text" name="price" id="price"  class="form-control input-sm floatTextBox" placeholder="@lang('Enter price')"/>
                                                        <div class="error text-danger col-form-label-sm"></div>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Is it a starting price?')
                                                        <span class="required">  </span>
                                                    </label>
                                                    <div class="col-md-12">
                                                        <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="starting">
                                                            <input type="checkbox" id="starting" name="starting" value="1" class="mdl-checkbox__input">
                                                            <span class="mdl-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Discount')
                                                        <span class="required">  </span>
                                                    </label>
                                                    <div class="col-md-12">
                                                        <input type="text" name="discount" id="discount"  class="form-control input-sm floatTextBox" placeholder="@lang('Enter Discount')"/>
                                                        <div class="error text-danger col-form-label-sm"></div>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Discount type')
                                                        <span class="required">  </span>
                                                    </label>
                                                    <div class="col-md-12">
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" id="discunt_porcent_1" name="discountCheck" value="porcent" class="custom-control-input">
                                                            <label class="custom-control-label" for="discunt_porcent_1">% Porcent</label>
                                                        </div>
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" id="discunt_porcent_2" name="discountCheck" value="money" class="custom-control-input">
                                                            <label class="custom-control-label" for="discunt_porcent_2">$ Money</label>
                                                        </div>
                                                        <div class="custom-control custom-radio">
                                                            <button type="button" class="btn btn-sm btn-info " id="clearDiscountType">Clear selection</button>
                                                        </div>
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
        
    </script>

    {{-- <script src="{{ asset('staffFiles/assets/js/customjs/treatment.min.js') }}"></script> --}}
    <script>
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
                    success: function(data) {
                        console.log(data)
                    }
                 },
                language: {
                    "url": dataTablesLangEs
                },
                "columns": [

                    { data: 'DT_RowIndex' },
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
                //console.log("\"click\"", "click");

                $('.error').html('')
                var form_data = new FormData();
                let data_service = $('#service').select2('data')[0];
                let data_procedure = $('#procedure').select2('data')[0];
                let data_package = $('#package').select2('data');
                if (data_package.length > 0 ) {
                    packId = data_package[0].id}else{packId = 0
                };

                form_data.append('service', data_service.id)
                form_data.append('procedure', data_procedure.id)
                form_data.append('package', packId)
                form_data.append('price', $('#price').val())
                form_data.append('clave', $('#clave').val())

                $starting = $('#starting').is(":checked") 
                if ($starting) {
                    form_data.append('starting', 1)
                } else {
                    form_data.append('starting', 0)
                }

                    $discount = $('#discount').val();
                    $typeDiscount = $('input[name="discountCheck"]:checked').val();
                    $price = $('#price').val();

                    if ($discount) {
                        if ($price) {
                            form_data.append('discount', $discount);
                        }

                        if (!$('#price').val()) {
                            $('#discount').next('.error').html('This field should only be filled if a price is set');
                            return
                        }
                    }
                    if ($typeDiscount) {
                        form_data.append('discountType', $typeDiscount);
                        if (!$discount) {
                            $('#discount').next('.error').html('please set a discount amotnt first');
                            $('input[name="discountCheck"]').prop('checked', false);
                            return
                        }
                    }



                    if ($typeDiscount) {
                        if ($typeDiscount == 'money') {
                            if ($discount >= $('#price').val()) {
                                $('#discount').next('.error').html('The cash discount must be less than the price of the treatment.');
                                return
                            }
                        } else if ($typeDiscount == "porcent"){
                            if ($discount > 100) {
                                $('#discount').next('.error').html('The percentage discount cannot exceed 100 %.');
                                return
                            }
                        } else {
                            $('#discount').next('.error').html('This type of discount is not allowed');
                        }
                    }

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
                    complete: function()
                    {
                    },
                })
            });

            $( document ).on('focus', 'input', function() {
                $('.error').html('')
            });

            $('#service').empty().attr('placeholder', "Select click here").trigger('change');
            $('#procedure').empty().attr('placeholder', "Select click here").trigger('change');
            $('#procedure').select2({placeholder: 'select ...',});
            $('#package').select2({placeholder: 'select ...',});
            $('#service').select2({
                placeholder: 'Select...',
                ajax: {
                 url: globalRouteSearchService,
                    type: 'post',
                    dataType: 'json',
                    data: function (params) {
                        return {
                            key: params.term,
                        }
                    },
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(obj) {
                                return {
                                    id: obj.id,
                                    text: obj.service,
                                };
                            })
                        };
                    },
                    cache: true,
                }
            })
            $('#service').on('select2:select', function(e){
                let data = e.params.data;
                $('#procedure').val(null).empty().attr('placeholder', "Select click here").trigger('change');
                $('#package').val(null).empty().attr('placeholder', "Select click here").trigger('change');
                getProcedure(data.id)
            })
            function getProcedure(id){
                $('#procedure').select2({
                    placeholder: 'Select...',
                    ajax: {
                    url: globalRouteSearchProcedure,
                        type: 'post',
                        dataType: 'json',
                        data: function (params) {
                            return {
                                key: params.term,
                                service: id,
                            }
                        },
                        processResults: function(data) {
                            return {
                                results: $.map(data, function(obj) {
                                    return {
                                        id: obj.id,
                                        text: obj.procedure,
                                        package: obj.package,
                                    };
                                })
                            };
                        },
                        cache: true,
                    }
                })
            }
            $('#procedure').on('select2:select', function(e){
                let data = e.params.data;
                $('#package').val(null).empty().attr('placeholder', "Select click here").trigger('change');
                if (data.package == 1) {$('.pack_div').show('fast')} else {$('.pack_div').hide('fast')}
                getPackage(data.id)
            })
            function getPackage(id){
                $('#package').select2({
                    placeholder: 'Select...',
                    ajax: {
                    url: globalRouteSearchPackage,
                        type: 'post',
                        dataType: 'json',
                        data: function (params) {
                            return {
                                key: params.term,
                                service: id,
                            }
                        },
                        processResults: function(data) {
                            return {
                                results: $.map(data, function(obj) {
                                    return {
                                        id: obj.id,
                                        text: obj.package,
                                    };
                                })
                            };
                        },
                        cache: true,
                    }
                })
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
                        

                    },
                    success:function(data)
                    {
                    console.log("data", data);
                        if (data.success) {
                           
                            clearForm()
                        
                            $('form').attr('treatments', data.info.id)

                            var service = {
                                id: data.info.service.id,
                                text: data.info.service.service
                            };

                            var procedure = {
                                id:data.info.procedure.id,
                                text: data.info.procedure.procedur
                            };

                            var newService = new Option(service.text, service.id, false, false);
                            var newProcedure = new Option(procedure.text, procedure.id, false, false);
                            $('#service').append(newService).trigger('change');
                            $('#procedure').append(newProcedure).trigger('change');
                            getProcedure(data.info.service.id)
                            if (data.info.package_id !== null) {
                                var package = {
                                    id:data.info.package.id,
                                    text: data.info.package.package
                                };
                                var newPackage = new Option(package.text, package.id, false, false);
                                $('#package').append(newPackage).trigger('change');
                                $('#package').parents('.pack_div').show('fast');
                                getPackage(data.info.procedure.id)
                            } else {
                                $('#package').parents('.pack_div').hide('fast').val('').removeAttr('data-id')
                            }
                            $('#price').val(data.info.price);
                            $('#clave').val(data.info.clave);

                            if (data.info.starting == 1) {
                                $('#starting').prop('checked', true);
                                $("#starting").parent().addClass('is-checked');
                            }


                            $('#discount').val(data.info.discount)
                            $('input[name=discountCheck][value=' + data.info.discountType + ']').attr('checked',true)
                            

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
                let data_service = $('#service').select2('data')[0];
                let data_procedure = $('#procedure').select2('data')[0];
                let data_package = $('#package').select2('data');
                if (data_package.length > 0 ) {
                    packId = data_package[0].id}else{packId = 0
                };

                form_data.append('service', data_service.id)
                form_data.append('procedure', data_procedure.id)
                form_data.append('package', packId)
                form_data.append('price', $('#price').val())
                form_data.append('clave', $('#clave').val())
                form_data.append('description_en', $('#description_en').val());
                form_data.append('description_es', $('#description_es').val());
                
                form_data.append('id_image', $('#image').attr('data-id'))
                form_data.append('id', $(this).attr('product'));

                 $starting = $('#starting').is(":checked") 
                if ($starting) {
                    form_data.append('starting', 1)
                } else {
                    form_data.append('starting', 0)
                }

                    $discount = $('#discount').val();
                    $typeDiscount = $('input[name="discountCheck"]:checked').val();
                    $price = $('#price').val();

                    if ($discount) {
                        if ($price) {
                            form_data.append('discount', $discount);
                        }

                        if (!$('#price').val()) {
                            $('#discount').next('.error').html('This field should only be filled if a price is set');
                            return
                        }
                    }
                    if ($typeDiscount) {
                        form_data.append('discountType', $typeDiscount);
                        if (!$discount) {
                            $('#discount').next('.error').html('please set a discount amotnt first');
                            $('input[name="discountCheck"]').prop('checked', false);
                            return
                        }
                    }



                    if ($typeDiscount) {
                        if ($typeDiscount == 'money') {
                            if ($discount >= $('#price').val()) {
                                $('#discount').next('.error').html('The cash discount must be less than the price of the treatment.');
                                return
                            }
                        } else if ($typeDiscount == "porcent"){
                            if ($discount > 100) {
                                $('#discount').next('.error').html('The percentage discount cannot exceed 100 %.');
                                return
                            }
                        } else {
                            $('#discount').next('.error').html('This type of discount is not allowed');
                        }
                    }



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
                            socket.emit('eventCalendarRefetchToServer');
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

            $(document).on('click', '#btn-add-includes', function(event) {
                event.preventDefault();
                addIncludes()
            });

            $(document).on('click', '#btn-delete-includes', function(event) {
                event.preventDefault();
                $(this).parents('.include').remove();
                if ($('.include').length == 0) {addIncludes()}
            });

            $(document).on('change', '#discount', function(event) {
                event.preventDefault();
                    console.log("$(this).val()", $(this).val());
                if ($(this).val() == '' || $(this).val()<= 0)  {
                    $('input[name="discountCheck"]').prop('checked', false);
                }
            });

            $(document).on('click', '#clearDiscountType', function(event) {
                event.preventDefault();
                console.log("hola", 'hola');
                $('input[name="discountCheck"]').prop('checked', false);
                $('#discount').val('')
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

            function clearForm(){
                $('#service').val(null).empty().attr('placeholder', "Select click here").trigger('change');
                $('#procedure').val(null).empty().attr('placeholder', "Select click here").trigger('change');
                $('#package').val(null).empty().attr('placeholder', "Select click here").trigger('change');
                $('input[name="discountCheck"]').prop('checked', false);
                $('#price').val('')
                $('#clave').val('')
                $("#formReset").click()
                $('#formEdit')
                .removeAttr('service')
                .html('Add')
                .attr('id', 'formSubmit')
                $('#starting').prop('checked', false);
                $("#starting").parent().removeClass('is-checked');
                $('#discount').val('')
                
                $("#includes").html('');
                addIncludes()
                $('#image').removeAttr('data-id');
                $('form').removeAttr('treatments')
            }
            function addIncludes(){
                let includes = '';
                includes += '<div class="include">'
                includes += '<input type="text" name="includes_en[]" class="form-control input-sm includes_en" placeholder="Enter Include En"/>';
                includes += '<div class="error text-danger col-form-label-sm"></div>';
                includes += '<input type="text" name="includes_es[]" class="form-control input-sm includes_es" placeholder="Enter Include Es"/>';
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
                includes += '<input type="text" name="includes_en[]" value="'+contain.contain_en+'" class="form-control input-sm includes_en" placeholder="Enter Include En"/>';
                includes += '<div class="error text-danger col-form-label-sm"></div>';
                includes += '<input type="text" name="includes_es[]" value="'+contain.contain_es+'" class="form-control input-sm includes_es" placeholder="Enter Include Es"/>';
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
@endsection()
