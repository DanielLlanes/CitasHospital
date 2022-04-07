@extends('staff.layouts.app')
@section('title')
	@lang('Payments')
@endsection
@section('content')
<div class="page-bar">
    <div class="page-title-breadcrumb">
        <div class=" pull-left">
            <div class="page-title">@lang('Payments Manager')</div>
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
            <li class="active">@lang('Payments Manager')</li>
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
                                        <table class="table table-hover table-checkable order-column full-width" id="paymentTable">
                                            <thead>
                                                <tr>
                                                    <th> ID </th>
                                                    <th> @lang('Image') </th>
                                                    <th> @lang('Patient') </th>
                                                    <th> @lang('Application') </th>
                                                    <th> @lang('Application Total') </th>
                                                    <th> @lang('Payment Amount') </th>
                                                    <th> @lang('Currency') </th>
                                                    <th> @lang('Payment method') </th>
                                                    <th> @lang('Date') </th>
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
                            <div class="col-md-3 col-sm-12">
                                <div class="card-box">
                                    <div class="card-head">
                                        <header>@lang('Add Payment')</header>
                                    </div>
                                    <div class="card-body" id="bar-parent">
                                       <form action="#" id="form_sample_1" class="form-horizontal" autocomplete="off">
                                           <div class="form-body">
                                               <div class="form-group mb-2">
                                                   <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Patient Name')
                                                       <span class="required"> * </span>
                                                   </label>
                                                   <div class="col-md-12">
                                                       <select type="text" name="patient" id="patient" placeholder="@lang('Enter patient name')" class="form-control input-sm autocomplete patient" />
                                                        </select>
                                                       <div class="error text-danger col-form-label-sm"></div>
                                                       {{-- <div id="myInputautocomplete-list" class="autocomplete-items patient" style="overflow-x: auto; max-height: 200px">
                                                       </div> --}}
                                                   </div>
                                               </div>
                                               <div class="form-group mb-2">
                                                   <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Patient Phone')
                                                       <span class="required"> * </span>
                                                   </label>
                                                   <div class="col-md-12">
                                                       <input type="text" name="phone" id="phone" placeholder="@lang('Enter patient phone')" disabled class="form-control input-sm" />
                                                       <div class="error text-danger col-form-label-sm"></div>
                                                   </div>
                                               </div>
                                               <div class="form-group mb-2">
                                                   <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Patient Email')
                                                       <span class="required"> * </span>
                                                   </label>
                                                   <div class="col-md-12">
                                                       <input type="email" name="email" id="email" placeholder="@lang('Enter patient email')"  disabled class="form-control input-sm" />
                                                       <div class="error text-danger col-form-label-sm"></div>
                                                   </div>
                                               </div>
                                               <div class="form-group mb-2">
                                                    <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Application')
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-12">
                                                        <select name="applications" id="applications" class="form-control input-sm">
                                                            <option value="" disabled selected>Select....</option>
                                                        </select>
                                                        <div class="error text-danger col-form-label-sm"></div>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Brand')
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-12">
                                                        <input type="text" name="brand" id="brand" placeholder="@lang('Enter Brand')" disabled class="form-control input-sm" />
                                                        <div class="error text-danger col-form-label-sm"></div>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Service')
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-12">
                                                        <input type="text" name="service" id="service" placeholder="@lang('Enter Service')" disabled class="form-control input-sm" />
                                                        <div class="error text-danger col-form-label-sm"></div>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Precedure')
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-12">
                                                        <input type="text" name="procedure" id="procedure" placeholder="@lang('Enter Precedure')" disabled class="form-control input-sm" />
                                                        <div class="error text-danger col-form-label-sm"></div>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Package')
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-12">
                                                        <input type="text" name="package" id="package" placeholder="@lang('Enter Package')" disabled class="form-control input-sm" />
                                                        <div class="error text-danger col-form-label-sm"></div>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Price')
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-12">
                                                        <input type="text" name="price" id="price" placeholder="@lang('Enter Price')" disabled class="form-control input-sm" />
                                                        <div class="error text-danger col-form-label-sm"></div>
                                                    </div>
                                                </div>
                                           </div>
                                           <div class="form-actions">
                                               <div class="row">
                                                   <div class="offset-md-3 col-md-9">
                                                       {{-- @can('payment.create') --}}
                                                           <button type="button" data-toggle="modal" disabled class="btn btn-info" id="paymentAdd">@lang('Add')</button>
                                                       {{-- @endcan --}}
                                                       <button type="button" class="btn btn-default" id="formCancel">@lang('Cancel')</button>
                                                       <button type="reset" id="formReset" class="d-none" id="formReset">@lang('Cancel')</button>
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

<div class="modal fade" id="paymenModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Modal title</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" id="form_sample_1" class="form-horizontal" autocomplete="off" enctype="multipart/form-data">
                    <div class="form-body">
                        <div class="form-group mb-2">
                            <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Photographic evidence')
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-12">
                                <input type="file" name="evivicence" id="evidence" class="form-control input-sm dropify" accept="image/*" />
                                <div class="error text-danger col-form-label-sm"></div>
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Amount')
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-12">
                                <input type="text" name="amount" id="amount" placeholder="@lang('Enter amount')"  class="form-control input-sm currencyTextBox" />
                                <div class="error text-danger col-form-label-sm"></div>
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Currency')
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-12">
                                <select name="currency" id="currency" class="form-control input-sm">
                                    <option value="" disabled selected>Select....</option>
                                    <option value="Dollar">Dollar (USD)</option>
                                    <option value="Peso">Peso (MXP)</option>
                                </select>
                                <div class="error text-danger col-form-label-sm"></div>
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Payment method')
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-12">
                                <select name="paymentMethod" id="paymentMethod" class="form-control input-sm">
                                    <option value="" disabled selected>Select....</option>
                                    @foreach($paymentMethod as $method)
                                        <option value="{{ $method->code }}">{{ $method->name }}</option>
                                    @endforeach
                                </select>
                                <div class="error text-danger col-form-label-sm"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="appPaymentModal" class="btn btn-primary">Save</button>
                        <button type="button"  class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="reset" id="formResetModal" class="d-none"></button>
                    </div>
                </form>
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
        var globalSearchStaff = '{{ route('staff.autocomplete.AutocompleteStaff') }}'
        var globalSearchPatient = '{{ route('staff.autocomplete.AutocompletePatient') }}'
        var globalRouteobtenerApps = '{{ route('staff.payments.patientsApps') }}'
        var globalRoutelistar = '{{ route('staff.payments.getList') }}'
        var globalRouteStore = '{{ route('staff.payments.store') }}'
        var globalRoutesearchPatientWithApps = '{{ route('staff.payments.searchPatientWithApps') }}'
        var globalSearchPatientAppDetails = '{{ route('staff.payments.searchPatientAppDetails') }}'

    </script>
    <script src="{{ asset('staffFiles/assets/js/customjs/payments.min.js') }}"></script>
@endsection
