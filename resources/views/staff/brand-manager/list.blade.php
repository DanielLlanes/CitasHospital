@extends('staff.layouts.app')
@section('title')
	@lang('Brand')
@endsection
@section('content')
<div class="page-bar">
    <div class="page-title-breadcrumb">
        <div class=" pull-left">
            <div class="page-title">@lang('Brand Manager')</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li>
                <i class="fa fa-home"></i>&nbsp;
                <a class="parent-item" href="index-2.html">@lang('breadcrumb.Home')</a>&nbsp;
                <i class="fa fa-angle-right">

                </i>
            </li>
            <li class="active">@lang('Configuration')&nbsp;
                <i class="fa fa-angle-right"></i>
            </li>
            <li class="active">@lang('Brand Manager')</li>
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
                                        <table class="table table-hover table-checkable order-column full-width" id="brandTable">
                                            <thead>
                                                <tr>
                                                    <th> ID </th>
                                                    <th> @lang('Image') </th>
                                                    <th> @lang('Name') </th>
                                                    <th> @lang('Acronym') </th>
                                                    <th> @lang('Description') </th>
                                                    <th> @lang('Color') </th>
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
                                        <header>@lang('Brand Manager')</header>
                                    </div>
                                    <div class="card-body" id="bar-parent">
                                       <form action="#" id="form_sample_1" class="form-horizontal" autocomplete="off">
                                           <div class="form-body">
                                                <div class="form-group mb-2">
                                                    <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Image brand')
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-12">
                                                        <input type="file" name="image" id="image" class="dropify" />
                                                        <div class="error text-danger col-form-label-sm"></div>
                                                    </div>
                                                </div>
                                               <div class="form-group mb-2">
                                                   <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Brand')
                                                       <span class="required"> * </span>
                                                   </label>
                                                   <div class="col-md-12">
                                                       <input type="text" name="brand" id="brand" placeholder="@lang('Brand')" class="form-control input-sm" />
                                                       <div class="error text-danger col-form-label-sm"></div>
                                                   </div>
                                               </div>
                                               <div class="form-group mb-2">
                                                   <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('acronym')
                                                       <span class="required"> * </span>
                                                   </label>
                                                   <div class="col-md-12">
                                                       <input type="text" name="acronym" id="acronym" autocomplete="off" placeholder="@lang('Enter acronym')" class="form-control input-sm autocomplete patient" onClick="this.setSelectionRange(0, this.value.length)" />
                                                       <div class="error text-danger col-form-label-sm"></div>
                                                   </div>
                                               </div>
                                               <div class="form-group mb-2">
                                                   <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Color')
                                                       <span class="required"> * </span>
                                                   </label>
                                                   <div class="col-md-12">
                                                       <input type="color" name="color" id="color" value="#000000" placeholder="@lang('Enter color')" class="form-control input-sm" />
                                                       <div class="error text-danger col-form-label-sm"></div>
                                                   </div>
                                               </div>
                                              {{--  <div class="form-group mb-2">
                                                   <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Description English')
                                                    <span class="required"> * </span>
                                                   </label>
                                                   <div class="col-md-12">
                                                       <textarea name="address" class="form-control-textarea mb-3" name="description_en" id="description_en" placeholder="@lang('Description English')" rows="5" style="font-size: 12px;resize: none"></textarea>
                                                       <div class="error text-danger col-form-label-sm"></div>
                                                   </div>
                                               </div>
                                               <div class="form-group mb-2">
                                                    <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Description Spanish')
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-12">
                                                        <textarea name="address" class="form-control-textarea mb-5" name="description_es" id="description_es" placeholder="@lang('Description Spanish')" rows="5" style="font-size: 12px;resize: none"></textarea>
                                                        <div class="error text-danger col-form-label-sm"></div>
                                                    </div>
                                                </div> --}}
                                           </div>
                                           <div class="form-actions">
                                               <div class="row">
                                                   <div class="offset-md-3 col-md-9">
                                                       {{-- @can('brand.create') --}}
                                                           <button type="button" class="btn btn-info" id="formSubmit">@lang('Add')</button>
                                                       {{-- @endcan --}}
                                                       <button type="button" class="btn btn-default" id="formCancel">@lang('Cancel')</button>
                                                       <button type="reset" class="d-none" id="formReset">@lang('Cancel')</button>
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
@section('styles')
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
        var globalRouteobtenerLista = "{{ route('staff.treatments.configuration.getBrandList') }}";
        var globalRouteStore = "{{ route('staff.treatments.configuration.storeBrand') }}";
        var globalRouteActivar = "{{ route('staff.treatments.configuration.activateBrand') }}"
        var globalRouteEditar = "{{ route('staff.treatments.configuration.editBrand') }}"
        var globalRouteUpdate = "{{ route('staff.treatments.configuration.updateBrand') }}"
        var globalRouteDestroy = "{{ route('staff.treatments.configuration.destroyBrand') }}"

    </script>
    <script src="{{ asset('staffFiles/assets/js/customjs/brands.min.js') }}"></script>
@endsection
