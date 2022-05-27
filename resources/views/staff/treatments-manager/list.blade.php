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

    <script src="{{ asset('staffFiles/assets/js/customjs/treatment.min.js') }}"></script>
    <script>
        
    </script>
@endsection()
