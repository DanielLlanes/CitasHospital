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
                                            <div class="table-scrollable responsive">
                                                <table class="table table-hover table-checkable order-column full-width"
                                                    id="paymentTable">
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
                                                            <th> @lang('Staff') </th>
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
                                            <form action="#" id="form_sample_1" class="form-horizontal"
                                                autocomplete="off">
                                                <div class="form-body">
                                                    <div class="form-group mb-2">
                                                        <label
                                                            class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Patient Name')
                                                            <span class="required"> * </span>
                                                        </label>
                                                        <div class="col-md-12">
                                                            <select type="text" name="patient" id="patient"
                                                                placeholder="@lang('Enter patient name')"
                                                                class="form-control input-sm autocomplete patient" />
                                                            </select>
                                                            <div class="error text-danger col-form-label-sm"></div>
                                                            {{-- <div id="myInputautocomplete-list" class="autocomplete-items patient" style="overflow-x: auto; max-height: 200px">
                                                       </div> --}}
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label
                                                            class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Patient Phone')
                                                            <span class="required"> * </span>
                                                        </label>
                                                        <div class="col-md-12">
                                                            <input type="text" name="phone" id="phone"
                                                                placeholder="@lang('Enter patient phone')" disabled
                                                                class="form-control input-sm" />
                                                            <div class="error text-danger col-form-label-sm"></div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label
                                                            class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Patient Email')
                                                            <span class="required"> * </span>
                                                        </label>
                                                        <div class="col-md-12">
                                                            <input type="email" name="email" id="email"
                                                                placeholder="@lang('Enter patient email')" disabled
                                                                class="form-control input-sm" />
                                                            <div class="error text-danger col-form-label-sm"></div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label
                                                            class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Application')
                                                            <span class="required"> * </span>
                                                        </label>
                                                        <div class="col-md-12">
                                                            <select name="applications" id="applications"
                                                                class="form-control input-sm">
                                                                <option value="" disabled selected>Select....</option>
                                                            </select>
                                                            <div class="error text-danger col-form-label-sm"></div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label
                                                            class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Brand')
                                                            <span class="required"> * </span>
                                                        </label>
                                                        <div class="col-md-12">
                                                            <input type="text" name="brand" id="brand"
                                                                placeholder="@lang('Enter Brand')" disabled
                                                                class="form-control input-sm" />
                                                            <div class="error text-danger col-form-label-sm"></div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label
                                                            class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Service')
                                                            <span class="required"> * </span>
                                                        </label>
                                                        <div class="col-md-12">
                                                            <input type="text" name="service" id="service"
                                                                placeholder="@lang('Enter Service')" disabled
                                                                class="form-control input-sm" />
                                                            <div class="error text-danger col-form-label-sm"></div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label
                                                            class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Precedure')
                                                            <span class="required"> * </span>
                                                        </label>
                                                        <div class="col-md-12">
                                                            <input type="text" name="procedure" id="procedure"
                                                                placeholder="@lang('Enter Precedure')" disabled
                                                                class="form-control input-sm" />
                                                            <div class="error text-danger col-form-label-sm"></div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label
                                                            class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Package')
                                                            <span class="required"> * </span>
                                                        </label>
                                                        <div class="col-md-12">
                                                            <input type="text" name="package" id="package"
                                                                placeholder="@lang('Enter Package')" disabled
                                                                class="form-control input-sm" />
                                                            <div class="error text-danger col-form-label-sm"></div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label
                                                            class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Price')
                                                            <span class="required"> * </span>
                                                        </label>
                                                        <div class="col-md-12">
                                                            <input type="text" name="price" id="price"
                                                                placeholder="@lang('Enter Price')" disabled
                                                                class="form-control input-sm" />
                                                            <div class="error text-danger col-form-label-sm"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-actions">
                                                    <div class="row">
                                                        <div class="offset-md-3 col-md-9">
                                                            {{-- @can('payment.create') --}}
                                                            <button type="button" data-toggle="modal" disabled
                                                                class="btn btn-info"
                                                                id="paymentAdd">@lang('Add')</button>
                                                            {{-- @endcan --}}
                                                            <button type="button" class="btn btn-default"
                                                                id="formCancel">@lang('Cancel')</button>
                                                            <button type="reset" id="formReset" class="d-none"
                                                                id="formReset">@lang('Cancel')</button>
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

    <div class="modal fade" id="paymenModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Modal title</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="#" id="form_sample_1" class="form-horizontal" autocomplete="off"
                        enctype="multipart/form-data">
                        <div class="form-body">
                            
                              <div class="form-group mb-2">
                                <label
                                    class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Patient Statistics')
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-12">
                                    <table class="table">
                                        <thead>
                                          <tr>
                                            <th scope="col">Numero de pagos</th>
                                            <th scope="col">Pagado</th>
                                            <th scope="col">Restante</th>
                                            <th scope="col">Total</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <th id="numPagos"></th>
                                            <td id="pagado"></td>
                                            <td id="restante"></td>
                                            <td id="total"></td>
                                          </tr>
                                        </tbody>
                                      </table>
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <label
                                    class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Photographic evidence')
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-12">
                                    <input type="file" name="evivicence" id="evidence"
                                        class="form-control input-sm dropify" accept="image/*" />
                                    <div class="error text-danger col-form-label-sm"></div>
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <label
                                    class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Amount')
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-12">
                                    <input type="text" name="amount" id="amount" placeholder="@lang('Enter amount')"
                                        class="form-control input-sm currencyTextBox" />
                                    <div class="error text-danger col-form-label-sm"></div>
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <label
                                    class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Currency')
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
                                <label
                                    class="control-label col-form-label-sm col-md-3 text-left text-nowrap">@lang('Payment method')
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-12">
                                    <select name="paymentMethod" id="paymentMethod" class="form-control input-sm">
                                        <option value="" disabled selected>Select....</option>
                                        @foreach ($paymentMethod as $method)
                                            <option value="{{ $method->code }}">{{ $method->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="error text-danger col-form-label-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="appPaymentModal" class="btn btn-primary">Save</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
                icon: '{{ \Session::get('icon') }}',
                title: '{{ \Session::get('msg') }}',
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
        var globalGetAppsPayment = '{{ route('staff.payments.getAppsPayment') }}'
    </script>
    {{-- <script src="{{ asset('staffFiles/assets/js/customjs/payments.min.js') }}"></script> --}}
    <script>
        $(document)['ready'](function() {
            var codigo = 1;
            var paymentTable = $('#paymentTable').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: globalRoutelistar,
                    type: 'get',
                    data: {
                        "estable": codigo
                    },
                    error: function(_0x4bbbx3, _0x4bbbx4, _0x4bbbx5) {}
                },
                language: {
                    "url": dataTablesLangEs
                },
                "columns": [{
                    data: 'DT_RowIndex'
                }, {
                    data: 'image'
                }, {
                    data: 'patient'
                }, {
                    data: 'application'
                }, {
                    data: 'application_total'
                }, {
                    data: 'payment_amount'
                }, {
                    data: 'currency'
                }, {
                    data: 'payment_method'
                }, {
                    data: 'staff'
                }, {
                    data: 'date',
                    className: 'center'
                }, {
                    data: 'action',
                    orderable: false,
                    searchable: false,
                    className: 'center'
                }],
                createdRow: function (row, data, dataIndex) {
                    $(row).addClass('odd gradeX');
                },
            });
            var patient;
            var application;
            function _0x4bbbx9(_0x4bbbxa) {
                var _0x4bbbxb = new FormData();
                _0x4bbbxb['append']('id', _0x4bbbxa);
                $['ajax']({
                    url: globalRouteobtenerApps,
                    type: 'POST',
                    method: 'POST',
                    data: _0x4bbbxb,
                    dataType: 'JSON',
                    contentType: false,
                    cache: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]')['attr']('content')
                    },
                    processData: false,
                    beforeSend: function() {
                        $('#applications option:not(:first)')['remove']();
                        $('#applications')['prop']('selectedIndex', 0)
                    },
                    success: function(_0x4bbbx7) {
                        console.log(_0x4bbbx7)
                        arr = [];
                        obj = {};
                        $('#paymentAdd')['attr']('patient', _0x4bbbx7['data'][0]['patient']['id'])
                        for (let _0x4bbbxc = 0; _0x4bbbxc < _0x4bbbx7['data']['length']; _0x4bbbxc++) {
                            $('#applications')['append']('<option value="' + _0x4bbbx7['data'][
                                _0x4bbbxc
                            ]['id'] + '">' + _0x4bbbx7['data'][_0x4bbbxc][
                                'temp_code'
                            ] + '</option>')
                        };
                        $('#applications')['select2']({
                            placeholder: 'Select ....'
                        })
                    }
                })
            }
            $('#applications')['on']('select2:select', function(e) {
                var _0x4bbbx7 = e['params']['data'];
                var _0x4bbbxe = _0x4bbbx7['id'];
                var _0x4bbbxb = new FormData();
                _0x4bbbxb['append']('id', _0x4bbbxe);
                $['ajax']({
                    url: globalSearchPatientAppDetails,
                    type: 'POST',
                    method: 'POST',
                    data: _0x4bbbxb,
                    dataType: 'JSON',
                    contentType: false,
                    cache: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]')['attr']('content')
                    },
                    processData: false,
                    beforeSend: function() {},
                    success: function(_0x4bbbx7) {
                        $('#brand')['val'](_0x4bbbx7['treatment']['brand']['brand']);
                        $('#service')['val'](_0x4bbbx7['treatment']['service']['service']);
                        $('#procedure')['val'](_0x4bbbx7['treatment']['procedure'][
                            'procedure'
                        ]);
                        if (_0x4bbbx7['treatment']['package']) {
                            $('#package')['val'](_0x4bbbx7['treatment']['package']['package'])
                        };
                        $('#price')['val'](_0x4bbbx7['treatment']['price']);
                        $('#paymentAdd')['attr']('disabled', false)
                        $('#paymentAdd')['attr']('app', _0x4bbbxe)
                    }
                })
            });
            $('#patient')['empty']()['attr']('placeholder', 'Enter patient name')['trigger']('change');
            $('#patient')['select2']({
                placeholder: 'Enter patient name',
                ajax: {
                    url: globalRoutesearchPatientWithApps,
                    type: 'post',
                    dataType: 'json',
                    data: function(_0x4bbbxf) {
                        return {
                            search: _0x4bbbxf['term'],
                            app: 1
                        }
                    },
                    processResults: function(_0x4bbbx7) {
                        return {
                            results: $['map'](_0x4bbbx7, function(_0x4bbbx10) {
                                return {
                                    id: _0x4bbbx10['id'],
                                    text: _0x4bbbx10['name'],
                                    email: _0x4bbbx10['email'],
                                    phone: _0x4bbbx10['phone']
                                }
                            })
                        }
                    },
                    cache: true
                }
            });
            $('#patient')['on']('select2:select', function(_0x4bbbxd) {
                var _0x4bbbx7 = _0x4bbbxd['params']['data'];
                if (_0x4bbbx7) {
                    $('#email')['val']('')['removeAttr']('disabled');
                    $('#phone')['val']('')['removeAttr']('disabled');
                    $('#brand')['val']('');
                    $('#service')['val']('');
                    $('#procedure')['val']('');
                    $('#package')['val']('');
                    $('#price')['val']('');
                    $('#paymentAdd')['removeAttr']('appId');
                    $('#paymentAdd')['attr']('disabled', true);
                    $('#applications option:not(:first)')['remove']();
                    $('#email')['val'](_0x4bbbx7['email'])['prop']('disabled', true);
                    $('#phone')['val'](_0x4bbbx7['phone'])['prop']('disabled', true);
                    _0x4bbbx9(_0x4bbbx7['id'])
                }
            });
            
            $(document)['on']('click', '#paymentAdd', function(_0x4bbbx11) {
                _0x4bbbx11['preventDefault']();
                application = $(this).attr('app');
                patient = $(this).attr('patient');
                $('#paymenModal')['modal']('show')
            });
            $(document)['on']('click', '.no-show-patient', function(_0x4bbbx11) {
                _0x4bbbx11['preventDefault']();
                $('#myInputautocomplete-list.patient')['fadeOut'](1000)['html']('');
                $('.autocomplete.patient')['val']('')['focus']()['attr']('data-id', '')
            });
            $(document)['on']('click', '#formCancel', function(_0x4bbbx11) {
                _0x4bbbx11['preventDefault']();
                $('#formEdit')['html']('add')['removeAttr']('event')['attr']('id', 'formSubmit');
                $('input')['removeAttr']('disabled');
                $('#lang')['removeAttr']('disabled');
                $('#formReset')['click']();
                $('.error')['html']('');
                $('.eventApp')['hide']('fast');
                $('#is_app')['prop']('checked', false);
                $('#is_app')['parent']()['removeClass']('is-checked');
                $('#app')['removeAttr']('data-id');
                _0x4bbbx1a()
            });
            $('#paymenModal')['on']('show.bs.modal', function(_0x4bbbx11) {
                var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                var dataString = {'id': application, 'patient': patient};
                fetch(globalGetAppsPayment, {
                    method: 'POST',
                    headers: {'X-CSRF-TOKEN': csrfToken, 'Content-Type': 'application/json'},
                    body: JSON.stringify(dataString)
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data)
                    var $form = $('#paymenModal'),
                    $amount = $form.find('#amount'),
                    numPagos  = $form.find('#numPagos'),
                    pagado  = $form.find('#pagado'),
                    restante  = $form.find('#restante'),
                    total  = $form.find('#total');
                    var pagoMinimo = data.price * .1;
                    if (data.numeroDePagos == '0') {
                        $amount.attr('placeholder', `min: ${pagoMinimo}, max: ${data.price}`);
                        $amount.attr('data-min', pagoMinimo);
                        $amount.attr('data-max', data.price);
                    }
                    numPagos.html(data.numeroDePagos);
                    pagado.html(data.suma);
                    restante.html(data.resta);
                    total.html(data.price);

                })
                .catch(error => {
                    console.log(error);
                });
            });
            $(document)['on']('click', '.closeModal', function(_0x4bbbx11) {
                _0x4bbbx11['preventDefault']();
                $('#formEdit')['html']('add')['removeAttr']('event')['attr']('id', 'formSubmit');
                $('input')['removeAttr']('disabled');
                $('#lang')['removeAttr']('disabled');
                $('#formReset')['click']();
                $('.error')['html']('')
            });
            $(document)['on']('click', '#appPaymentModal', function(_0x4bbbxd) {
                var _0x4bbbx12 = new FormData();
                var _0x4bbbx13 = $('#evidence')[0]['files'][0];
                var _0x4bbbx14 = $('#amount')['val']();
                var _0x4bbbx15 = $('#patient')['select2']('data');
                var _0x4bbbx16 = $('#applications')['select2']('data');
                var _0x4bbbx17 = $('#paymentMethod')['val']();
                _0x4bbbx12['append']('evidence', _0x4bbbx13);
                _0x4bbbx12['append']('amount', _0x4bbbx14);
                _0x4bbbx12['append']('evidence', 1);
                _0x4bbbx12['append']('id', _0x4bbbx16[0]['id']);
                _0x4bbbx12['append']('code', _0x4bbbx16[0]['text']);
                _0x4bbbx12['append']('paymentMethod', _0x4bbbx17);
                _0x4bbbx12['append']('currency', $('#currency')['val']());
                _0x4bbbx12['append']('patId', _0x4bbbx15[0]['id']);
                $['ajax']({
                    url: globalRouteStore,
                    type: 'POST',
                    method: 'POST',
                    data: _0x4bbbx12,
                    dataType: 'JSON',
                    contentType: false,
                    cache: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]')['attr']('content')
                    },
                    processData: false,
                    beforeSend: function() {},
                    success: function(_0x4bbbx7) {
                        console['log']('data', _0x4bbbx7);
                        Toast['fire']({
                            icon: _0x4bbbx7['icon'],
                            title: _0x4bbbx7['msg']
                        });
                        if (_0x4bbbx7['reload']) {
                            paymentTable['ajax']['reload'](null, false);
                            _0x4bbbx1a()
                        } else {
                            $['each'](_0x4bbbx7['errors'], function(_0x4bbbx18, _0x4bbbx19) {
                                $('*[id^=' + _0x4bbbx18 + ']')['parent']()['find'](
                                    '.error')['append']('<p>' + _0x4bbbx19 + '</p>')
                            })
                        }
                    }
                })
            });

            function _0x4bbbx1a() {
                $('#formReset')['click']();
                $('#formResetModal')['click']();
                $('#patient')['removeAttr']('data-id');
                $('#appPaymentModal')['removeAttr']('idA');
                $('#appPaymentModal')['removeAttr']('code');
                $('#paymentAdd')['removeAttr']('app')
                $('#paymenModal')['modal']('hide');
                $('#patient')['val'](null)['trigger']('change');
                _0x4bbbx1b();
                $('#applications')['val'](null)['trigger']('change');
                $('#applications')['select2']('destroy');
                $('#applications')['html']('<option value="" disabled selected>Select....</option>')
            }

            function _0x4bbbx1b() {
                drEvents = drEvent['data']('dropify');
                drEvents['resetPreview']();
                drEvents['clearElement']()
            }
        })
    </script>
@endsection
