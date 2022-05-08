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
                                                    <th> @lang('Image') </th>
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
                                        <header>@lang('Procedures Manager')</header>
                                    </div>
                                    <div class="card-body" id="bar-parent">
                                       <form action="#" id="form_sample_1" class="form-horizontal" autocomplete="off">
                                            <div class="form-body">
                                                <div class="form-group mb-2" style="overflow: hidden">
                                                    <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Image')
                                                    <span class="required">  </span>
                                                    </label>
                                                    <div class="col-md-12">
                                                        <input type="file" name="image" id="image" class="dropify"  style="overflow: hidden">
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
                                                        {{-- <input type="text" name="service" id="service" placeholder="@lang('Service')" class="form-control input-sm autocomplete service" onclick="this.setSelectionRange(0, this.value.length)"/> --}}
                                                        <select class="form-control input-height" id="choice-service-select">
                                                        </select>
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
        
        var globalRouteobtenerLista = "{{ route('staff.treatments.configuration.getProcedureList') }}";
        var globalRouteStore = "{{ route('staff.treatments.configuration.storeProcedure') }}";
        var globalRouteActivar = "{{ route('staff.treatments.configuration.activateProcedure') }}"
        var globalRouteEditar = "{{ route('staff.treatments.configuration.editProcedure') }}"
        var globalRouteUpdate = "{{ route('staff.treatments.configuration.updateProcedure') }}"
        var globalRouteDestroy = "{{ route('staff.treatments.configuration.destroyProcedure') }}"
        var globalRouteSearchService = "{{ route('staff.autocomplete.AutocompleteService') }}";
        var globalRouteDeleteFile = "{{ route('staff.treatments.configuration.imageDestroy') }}";

    </script>
    <script src="{{ asset('staffFiles/assets/js/customjs/procedures.min.js') }}"></script> 
    <script>
        
    </script>
@endsection
