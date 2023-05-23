@extends('staff.layouts.app')
@section('title')
	@lang('Quotes')
@endsection
@section('content')
<div class="page-bar">
    <div class="page-title-breadcrumb">
        <div class=" pull-left">
            <div class="page-title">@lang('Quotes Manager')</div>
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
            <li class="active">@lang('Quotes Manager')</li>
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
                            <div class="col-md-12">
                                <div class="card card-box">
                                    <div class="card-head">
                                        <header></header>
                                        <div class="tools">
                                            <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                                            <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                            <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="col-12">
                                            <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#quotesModal">Add Quote</button>
                                            
                                        </div>
                                      <div class="table-scrollable responsive" >
                                        <table class="table table-hover table-checkable order-column full-width" id="quotestable">
                                            <thead>
                                                <tr>
                                                    <th> ID </th>
                                                    <th> @lang('cotizacion') </th>
                                                    <th> @lang('Patient') </th>
                                                    <th> @lang('Treatment') </th>
                                                    <th> @lang('Coordinator') </th>
                                                    <th> @lang('Solicitante') </th>
                                                    <th> @lang('price') </th>
                                                    <th> @lang('Date') </th>
                                                    <th> @lang('Action') </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                        </div>
                                        <pre>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="quotesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel1">Selecionar aplicación</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table id="appstable" class="table table-hover table-checkable order-column full-width">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Application</th>
                                <th>Paciente</th>
                                <th>Tratamiento</th>
                                <th>Cordinador</th>
                                <th>Suguerido por</th>
                                <th>Asignado a</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="edit-quote-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document" style="">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel2">Show Quote</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col text-center" id="paciente-modal-name"></div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Dr Fee</th>
                                    <th scope="col">Is Free</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td>Totales</td>
                                    <td><input class="form-control form-control-sm total-price-edit border-0" readonly oninput="this.value = this.value.replace(/[^0-9.]/g, '')" type="text" placeholder=""></td>
                                    <td><input class="form-control form-control-sm total-drFee-edit border-0" readonly oninput="this.value = this.value.replace(/[^0-9.]/g, '')" type="text" placeholder=""></td>
                                    <td></td>
                                </tr>
                            </tfoot>
                            <tbody id="edit-cot-table-body">

                            </tbody>
                        </table>   
                        <div class="modal-footer">
                            <button type="button" class="btn btn-info" id="add-field-btn-edit">Add new field</button>
                        </div> 
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success edit-quote-modal" >Edit quote</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="create-quote-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel3" aria-hidden="true" >
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document" style="">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel3">Add Quote</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col text-center" id="paciente-modal-name"></div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Dr Fee</th>
                                    <th scope="col">Is Free</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td>Totales</td>
                                    <td><input class="form-control form-control-sm total-price border-0" readonly oninput="this.value = this.value.replace(/[^0-9.]/g, '')" type="text" placeholder=""></td>
                                    <td><input class="form-control form-control-sm total-drFee border-0" readonly oninput="this.value = this.value.replace(/[^0-9.]/g, '')" type="text" placeholder=""></td>
                                    <td></td>
                                </tr>

                            </tfoot>
                            <tbody id="add-cot-table-body">

                            </tbody>
                        </table>
                        <div class="modal-footer mt-3 ml-auto">
                            <button type="button" class="btn btn-info" id="add-field-btn">Add new field</button>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success save-quote-modal" >Save quote</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('styles')
    <style>
        @media (min-width: 768px) {
            .modal-xl {
                width: 90%;
                max-width:1200px;
            }
        }

        @media only screen and (max-width: 600px) {
            div.dataTables_wrapper div.dataTables_filter input {
                max-width: 70%;
            }
        }

        .swal2-container.swal2-backdrop-show, .swal2-container.swal2-noanimation {
            z-index: 12000;
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
    <script>
        var globalRouteobtenerApps = '{{ route('staff.quotes.apps') }}'
        var globalRouteobtenersugerencias = '{{ route('staff.quotes.sugerencias') }}'
        var globalRouteDestroy = '{{ route('staff.quotes.destroy') }}'
        var globalRouteDestroyEdit = '{{ route('staff.quotes.destroyEdit') }}'
        var globalRouteStore = '{{ route('staff.quotes.store') }}'
        var globalRouteShow = '{{ route('staff.quotes.show') }}'
        var globalRouteEdit = '{{ route('staff.quotes.edit') }}'
        var globalRouteUpdate = '{{ route('staff.quotes.update') }}'
        var globalRoutelistar = '{{ route('staff.payments.getList') }}'
        var globalRoutesearchPatientWithApps = '{{ route('staff.payments.searchPatientWithApps') }}'
        var globalSearchPatientAppDetails = '{{ route('staff.payments.searchPatientAppDetails') }}'
    </script>

    <script>
        $(function() {
            var codigo = 1;
            var quotestable = $('#quotestable').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax:{
                    url : globalRouteShow,
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
                    { data: "cotizacion" },
                    { data: "paciente" },
                    { data: "tratamiento" },
                    { data: "coordinador" },
                    { data: "doctorUno" },
                    { data: "price" },
                    { data: "date" },
                    { data: "acciones", orderable: false, searchable: false, className: 'center' },

                ],
                createdRow: function (row, data, dataIndex) {
                    $(row).addClass('odd gradeX');
                },
            });
            $('#quotesModal').on('shown.bs.modal', function () {
                var appstable = $('#appstable').DataTable({
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    ajax:{
                        url : globalRouteobtenerApps,
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
                        { data: "app" },
                        { data: "paciente" },
                        { data: "tratamiento" },
                        { data: "coordinador" },
                        { data: "doctorUno" },
                        { data: "doctorDos" },
                        { data: "acciones", orderable: false, searchable: false, className: 'center' },

                    ],
                    createdRow: function (row, data, dataIndex) {
                        $(row).addClass('odd gradeX');
                    },
                });
            });
            $('#quotesModal').on('hide.bs.modal', function (event) {
                console.log("appstable", 'cerrar');
                $.fn.dataTable.ext.errMode = 'throw';
                $('#appstable').DataTable().destroy();
            })
            $(document).on('click', '.seleccionar', function(event) {
                $('#quotesModal').modal('hide')
                obtenerSugerencias( $(this).attr('data-id') )
            });
            $(document).on('click', '#add-field-btn', function(event) {
                event.preventDefault();
                addNewFieldSurgg();
            });
            $(document).on('click', '#add-field-btn-edit', function(event) {
                event.preventDefault();
                addNewFieldSurggEdit();
            });
            function addNewFieldSurgg() {
                var numFilas = $('#add-cot-table-body tr').length;
                 $content = `   
                        <tr data-tr="${numFilas+1}">
                            <th scope="row"><input name="name" class="form-control form-control-sm name" type="text" placeholder=""></th>
                            <td><input class="form-control form-control-sm price" oninput="this.value = this.value.replace(/[^0-9.]/g, '')" type="text" placeholder=""></td>
                            <td><input class="form-control form-control-sm dr-fee" oninput="this.value = this.value.replace(/[^0-9.]/g, '')" type="text" placeholder=""></td>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input isFree" id="customCheck${numFilas+1}">
                                    <label class="custom-control-label" data-sugerencia="" for="customCheck${numFilas+1}"> </label>
                                </div>
                            </td>
                            <td>
                                <button type="button" data-index="${numFilas+1}" class="btn btn-danger btn-sm delete-sugerencia">Delete</button>
                            </td>
                        </tr>
                    `;
                
                $('#add-cot-table-body').append($content);
            }
            function addNewFieldSurggEdit() {
                var numFilas = $('#edit-cot-table-body tr').length;
                 $content = `   
                        <tr data-tr="${numFilas+1}">
                            <th scope="row"><input name="name" class="form-control form-control-sm name-edit" type="text" placeholder=""></th>
                            <td><input class="form-control form-control-sm price-edit" oninput="this.value = this.value.replace(/[^0-9.]/g, '')" type="text" placeholder=""></td>
                            <td><input class="form-control form-control-sm dr-fee-edit" oninput="this.value = this.value.replace(/[^0-9.]/g, '')" type="text" placeholder=""></td>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input isFree-edit" id="customCheck${numFilas+1}">
                                    <label class="custom-control-label" data-sugerencia="" for="customCheck${numFilas+1}"> </label>
                                </div>
                            </td>
                            <td>
                                <button type="button" data-index="${numFilas+1}" class="btn btn-danger btn-sm delete-sugerencia">Delete</button>
                                
                            </td>
                        </tr>
                    `;
                $('#edit-cot-table-body').append($content);
            }
            function obtenerSugerencias(id) {
                var formData = new FormData();
                formData.append('id', id)
                $.ajax({
                    url: globalRouteobtenersugerencias,
                    method:"POST",
                    data:formData,
                    dataType:'JSON',
                    contentType: false,
                    cache: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    processData: false,
                    beforeSend: function(){
                       
                    },
                    success:function(data){
                        console.log("data", data);
                        $('#add-cot-table-body').html('');
                        var $content = '';
                        $('#paciente-modal-name').html(`<strong>${data.patient.name}</strong>`)
                        $.each(data.suggestions, function(index, val) {
                            $content += `   
                                <tr data-tr="${index+1}" data-sugg="${val.id}" data-name="${val.sugerencia}">
                                    <th scope="row">${val.sugerencia}</th>
                                    <td><input class="form-control form-control-sm price" oninput="this.value = this.value.replace(/[^0-9.]/g, '')" type="text" placeholder=""></td>
                                    <td><input class="form-control form-control-sm dr-fee" oninput="this.value = this.value.replace(/[^0-9.]/g, '')" type="text" placeholder=""></td>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input isFree" id="customCheck${index+1}">
                                            <label class="custom-control-label" data-sugerencia="${val.sugerencia}" for="customCheck${index+1}"> </label>
                                        </div>
                                    </td>
                                    <td>
                                        <buttonn app="${data.id}" data-id="${val.sugerencia}" data-index="${index+1}" type="button" class="btn btn-danger btn-sm delete-sugerencia">Delete</button>
                                    </td>
                                </tr>
                            `;
                        });
                        $('#create-quote-modal').modal('show')
                        $('.save-quote-modal').attr('app', data.id);
                        $('#add-cot-table-body').append($content);
                    },
                })
            }
            function obtenerĆotizacion(id) {
                var formData = new FormData();
                formData.append('id', id)
                $.ajax({
                    url: globalRouteEdit,
                    method:"POST",
                    data:formData,
                    dataType:'JSON',
                    contentType: false,
                    cache: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    processData: false,
                    beforeSend: function(){
                       
                    },
                    success:function(data){
                        console.log("data", data);
                        $('#edit-cot-table-body').html('');
                        var $content = '';
                        $('#paciente-modal-name').html(`<strong>${data.application.patient.name}</strong>`)
                        let $totalPrice = 0; 
                        let $totalDrFee = 0; 
                        $.each(data.suggestions, function(index, val) {
                            $content += `   
                                <tr data-tr="${index+1}" data-sugg="${val.id}" data-name-edit="${val.sugerencia}">
                                    <th scope="row">${val.sugerencia}</th>
                                    <td><input class="form-control form-control-sm price-edit" value="${val.unitario}" data-value="${val.unitario}" oninput="this.value = this.value.replace(/[^0-9.]/g, '')" type="text" placeholder=""></td>
                                    <td><input class="form-control form-control-sm dr-fee-edit" value="${val.dr_fee}" data-value="${val.dr_fee}" oninput="this.value = this.value.replace(/[^0-9.]/g, '')" type="text" placeholder=""></td>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input isFree-edit" ${val.is_free == 0 ? "" : "checked"} id="customCheck${index+1}">
                                            <label class="custom-control-label" data-sugerencia="${val.sugerencia}" for="customCheck${index+1}"> </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" app="${data.application.id}" data-id="${val.sugerencia}" data-index="${index+1}" class="custom-control-input delete-sugerencia-edit" id="delete${index+1}">
                                            <label class="custom-control-label text-danger" data-sugerencia="" for="delete${index+1}"> Delete </label>
                                        </div>
                                    </td>
                                </tr>
                            `;
                            // <buttonn app="${data.application.id}" data-id="${val.sugerencia}" data-index="${index+1}" type="button" class="btn btn-danger btn-sm delete-sugerencia-edit">Delete</button>

                            $totalPrice += parseFloat(val.unitario);
                            $totalDrFee += parseFloat(val.dr_fee);
                        });

                        $('.total-price-edit').val($totalPrice);
                        $('.total-drFee-edit').val($totalDrFee);

                        $('#edit-quote-modal').modal('show')
                        $('.edit-quote-modal').attr('app', data.id);
                        $('#edit-cot-table-body').append($content);
                    },
                })
            }
            function deleteRecord(id, app, index){
                var form_data = new FormData();
                form_data.append('id', id);
                form_data.append('app', app);
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
                        if (data == 'ok') {
                            $tr = $("tr[data-tr='" + index +"']");
                           $tr.remove();
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
            function deleteRecordEdit(id, app, index){
                var form_data = new FormData();
                form_data.append('id', id);
                form_data.append('app', app);
                $.ajax({
                    url: globalRouteDestroyEdit,
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
                        if (data == 'ok') {
                            $tr = $("tr[data-tr='" + index +"']");
                           $tr.remove();
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
            $(document).on('click', '.delete-sugerencia', function(event) {
                event.preventDefault();
                $index = $(this).attr('data-index'); 
                $id = $(this).attr('data-id'); 
                $app = $(this).attr('app')
                if ($id && $app) {
                    Swal.fire({
                        title: '¿Esta seguro?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si, borrarlo!'
                    }).then((result) => {
                        if (result.value) {
                            $kha = deleteRecord($id, $app, $index)
                            console.log("$kha", $kha);
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
                } else {
                    $(this).parents('tr').remove();
                    var numFilas = $('#add-cot-table-body tr').length;
                    if (numFilas == 0 ) {
                        addNewFieldSurgg();
                    }
                }
            });
            $(document).on('input', '.price', function(event) {
                event.preventDefault();
                var total = 0;
                $('.price').each(function() {
                    var cantidad = parseFloat($(this).val());;
                    if (!isNaN(cantidad)) {
                        total += cantidad;
                    }
                });
                $('.total-price').val(total)
            });
            $(document).on('input', '.price-edit', function(event) {
                event.preventDefault();
                var total = 0;
                $('.price-edit').each(function() {
                    var cantidad = parseFloat($(this).val());;
                    if (!isNaN(cantidad)) {
                        total += cantidad;
                    }
                });
                $('.total-price-edit').val(total)
            });
            $(document).on('input', '.dr-fee', function(event) {
                event.preventDefault();
                var total = 0;
                $('.dr-fee').each(function() {
                    var cantidad = parseFloat($(this).val());
                    $isCkecked = $(this).find('input[type="checkbox"]').is(':checked')
                    
                    if (!isNaN(cantidad)) {
                        total += cantidad;
                    }

                    if ($isCkecked) {
                        $(this).val(0)
                        total -= cantidad
                    }
                });
                $('.total-drFee').val(total)
            });
            $(document).on('input', '.dr-fee-edit', function(event) {
                event.preventDefault();
                var total = 0;
                $('.dr-fee-edit').each(function() {
                    var cantidad = parseFloat($(this).val());
                    $isCkecked = $(this).find('.isFree-edit').is(':checked')
                    
                    if (!isNaN(cantidad)) {
                        total += cantidad;
                    }

                    if ($isCkecked) {
                        $(this).val(0)
                        total -= cantidad
                    }
                });
                $('.total-drFee-edit').val(total);
            });
            $(document).on('change', '.isFree-edit', function(event) {
                event.preventDefault();
                $drFee = $(this).parents('tr').find('.dr-fee-edit')
                if ($(this).is(':checked')) {
                    $drFee.val(0).select().focus();
                    var total = 0;
                    $('.dr-fee-edit').each(function() {
                        var cantidad = parseFloat($(this).val());
                        total += cantidad;
                    });
                    $('.total-drFee-edit').val(total)
                }
            });
            $(document).on('change', '.isFree', function(event) {
                event.preventDefault();
                $drFee = $(this).parents('tr').find('.dr-fee')
                if ($(this).is(':checked')) {
                    $drFee.val(0).select().focus();
                    var total = 0;
                    $('.dr-fee').each(function() {
                        var cantidad = parseFloat($(this).val());
                        total += cantidad;
                    });
                    $('.total-drFee').val(total)
                }
            });
            $(document).on('click', '.save-quote-modal', function(event) {
                event.preventDefault();
                $app = $(this).attr('app');
                var numFilas = $('#add-cot-table-body tr').length;
                var trs = $('#add-cot-table-body tr');
                var datos = []
                if (numFilas > 0) {
                    $.each(trs, function(index, val) {
                        $data = $(this).attr('data-sugg');
                        $name = $(this).attr('data-name');
                        $price = $(this).find('.price').val();
                        $drFee = $(this).find('.dr-fee').val();
                        $isCkecked = $(this).find('.isFree').is(':checked')
                        $isFree = 0
                        if ($isCkecked) {
                            $isFree = 1;
                        }
                        dato = {
                            data: $data,
                            name: $name,
                            price: $price,
                            drFee: $drFee,
                            isFree: $isFree,
                        }

                        datos.push(dato)
                    });

                    $.ajax({
                        url: globalRouteStore,
                        method:"POST",
                        data:{
                            datos: datos,
                            app: $app
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        beforeSend: function(){
                           //$('#create-quote-modal').modal('hide')
                        },
                        success:function(data){
                            if (data.success) {
                                $('#create-quote-modal').modal('hide')
                            }
                            quotestable.ajax.reload( null, false );
                        },
                    })
                }
            });
            $(document).on('click', '.edit-quote', function(event) {
                obtenerĆotizacion( $(this).attr('data-id') )
            });
            $(document).on('change', '.delete-sugerencia-edit', function(event) {
                event.preventDefault();
                $index = $(this).attr('data-index'); 
                $id = $(this).attr('data-id'); 
                $app = $(this).attr('app')
                $drFee = $(this).parents('tr').find('.dr-fee-edit')
                $price = $(this).parents('tr').find('.price-edit')
                if ($(this).is(':checked')) {
                    $drFee.val(0).select().focus();
                    var total = 0;
                    $('.dr-fee-edit').each(function() {
                        var cantidad = parseFloat($(this).val());
                        total += cantidad;
                    });
                    $('.total-drFee-edit').val(total)
                    var total_price = 0;
                    $('.price-edit').each(function() {
                        var cantidad_price = parseFloat($(this).val());
                        $price.addClass('text-danger')
                        if (!$(this).hasClass('text-danger')) {
                            total_price += cantidad_price;
                        }
                    });
                    $('.total-price-edit').val(total_price)
                } else {
                    var total_price = 0;
                    $('.price-edit').each(function() {
                        if ($(this).hasClass('text-danger')) {
                            $(this).removeClass('text-danger').val($(this).attr('data-value'));
                        }
                        var cantidad_price = parseFloat($(this).val());
                        total_price += cantidad_price;
                    });
                    $('.total-price-edit').val(total_price)
                    var total = 0;
                    $('.dr-fee-edit').each(function() {
                        $drFee.val($(this).attr('data-value'));
                        var cantidad = parseFloat($(this).val());
                        total += cantidad;
                    });
                    $('.total-drFee-edit').val(total)
                    
                }
            });
            $(document).on('click', '.edit-quote-modal', function(event) {
                event.preventDefault();
                $cot = $(this).attr('app');
                var numFilas = $('#edit-cot-table-body tr').length;
                var trs = $('#edit-cot-table-body tr');
                var datos = []
                if (numFilas > 0) {
                    $.each(trs, function(index, val) {
                        $data = $(this).attr('data-sugg');
                        $name = $(this).attr('data-name-edit');
                        $price = $(this).find('.price-edit').val();
                        $drFee = $(this).find('.dr-fee-edit').val();
                        $isCkecked = $(this).find('.isFree-edit').is(':checked')
                        $isDelete = $(this).find('.delete-sugerencia-edit').is(':checked')
                        $isFree = 0
                        if ($isCkecked) {
                            $isFree = 1;
                        }
                        $isDeleted = 0 
                        if ($isDelete) {
                            $isDeleted = 1;
                        }
                        dato = {
                            data: $data,
                            name: $name,
                            price: $price,
                            drFee: $drFee,
                            isFree: $isFree,
                            isDeleted : $isDeleted,
                        }

                        datos.push(dato)
                    });
                        console.log("datos", datos);
                    $.ajax({
                        url: globalRouteUpdate,
                        method:"POST",
                        data:{
                            datos: datos,
                            app: $cot
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        beforeSend: function(){
                           $('#create-quote-modal').modal('hide')
                        },
                        success:function(data){
                           quotestable.ajax.reload( null, false );
                           $("#edit-quote-modal").modal('hide');
                        },
                    })
                }
            });
            $(document).on('input', '.name-edit', function(event) {
                event.preventDefault();
                $(this).parents('tr').attr('data-name-edit', $(this).val())
            });
            $(document).on('input', '.name', function(event) {
                event.preventDefault();
                $(this).parents('tr').attr('data-name', $(this).val())
            });
        });
    </script>
@endsection
