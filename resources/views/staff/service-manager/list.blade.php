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
            <li>
                <i class="fa fa-home"></i>&nbsp;
                <a class="parent-item" href="index-2.html">@lang('breadcrumb.Home')</a>
                &nbsp;<i class="fa fa-angle-right">

                </i>
            </li>
            <li class="active">@lang('Configuration')&nbsp;
                <i class="fa fa-angle-right"></i>
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
                            <div class="col-md-3">
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
                                                        {{-- <input type="text" name="brand" id="brand" autocomplete="off" placeholder="@lang('Enter brand name')" class="form-control input-sm autocomplete brand" onClick="this.setSelectionRange(0, this.value.length)" /> --}}
                                                        <select class="form-control input-height" id="choice-brand-select">
                                                        </select>
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
                                                        <input type="text" name="qty_images" id="qty_images" placeholder="@lang('Quantity of images')" class="form-control input-sm intTextBox" />
                                                        <div class="error text-danger col-form-label-sm"></div>
                                                    </div>
                                                </div>

                                                <div class="form-group mb-2">
                                                    <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Staff')
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
                                                        <button type="button" class="btn btn-success btn-sm" id="btn-add-secialtie">Add staff <i class="material-icons f-left" style="font-size: 8px">add_circle</i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Description English')
                                                    <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-12">
                                                        <textarea name="address" class="form-control-textarea summernote" name="description_en" id="description_en" placeholder="@lang('Description English')" rows="5" style="font-size: 12px;resize: none"></textarea>
                                                        <div class="error text-danger col-form-label-sm"></div>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Description Spanish')
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-12">
                                                        <textarea name="address" class="form-control-textarea summernote" name="description_es" id="description_es" placeholder="@lang('Description Spanish')" rows="5" style="font-size: 12px;resize: none"></textarea>
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
        
        var globalRouteobtenerLista = "{{ route('staff.treatments.configuration.getServiceList') }}";
        var globalRouteStore = "{{ route('staff.treatments.configuration.storeService') }}";
        var globalRouteActivar = "{{ route('staff.treatments.configuration.activateService') }}"
        var globalRouteEditar = "{{ route('staff.treatments.configuration.editService') }}"
        var globalRouteUpdate = "{{ route('staff.treatments.configuration.updateService') }}"
        var globalRouteDestroy = "{{ route('staff.treatments.configuration.destroyService') }}"
        var globalRouteSearchBrand = "{{ route('staff.autocomplete.AutocompleteBrand') }}";

    </script>
    <script src="{{ asset('staffFiles/assets/js/customjs/services.min.js') }}"></script>
@endsection