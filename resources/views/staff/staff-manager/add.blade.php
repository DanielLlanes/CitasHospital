@extends('staff.layouts.app')
@section('title')
    @lang('Add Staff')
@endsection
@section('content')

<div class="page-bar">
    <div class="page-title-breadcrumb">
        <div class=" pull-left">
            <div class="page-title">@lang('Add Staff')</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index-2.html">@lang('Home')</a>&nbsp;<i class="fa fa-angle-right"></i>
            </li>
            <li><a class="parent-item" href="#">@lang('Staff')</a>&nbsp;<i class="fa fa-angle-right"></i>
            </li>
            <li class="active">@lang('Add Staff')</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="card card-box">
            <div class="card-head">
                <header>@lang('Basic Information')</header>
                 <button id = "panel-button"
                       class = "mdl-button mdl-js-button mdl-button--icon pull-right"
                       data-upgraded = ",MaterialButton">
                       <i class = "material-icons">more_vert</i>
                    </button>
                    <ul class = "mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
                       data-mdl-for = "panel-button">
                       <li class = "mdl-menu__item"><i class="material-icons">assistant_photo</i>Action</li>
                       <li class = "mdl-menu__item"><i class="material-icons">print</i>Another action</li>
                       <li class = "mdl-menu__item"><i class="material-icons">favorite</i>Something else here</li>
                    </ul>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card-body" id="bar-parent">
                <form method="POST" action="{{ route('staff.staff.store') }}" id="add-staff" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    <div class="form-body">
                    	<div class="form-group row">
                    		<label class="control-label col-md-3">@lang('Profile Picture')
                    		</label>
                    		<div class="compose-editor">
                    			<input type="file" class="default" name="avatar">
                    		</div>
                            @error('avatar')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                    	</div>
                    	<div class="form-group row">
                            <label class="control-label col-md-3">@lang('Name')
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-5">
                                <input autocomplete="off" type="text" name="name" value="{{ old('name') }}" data-required="1" placeholder="@lang('Enter Name')" class="form-control input-height" />
                                @error('name')
                                    <span class="help-block text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">@lang('Language')
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-5">
                                <select class="form-control input-height" name="language">
                                    <option value="" disabled selected>@lang('Select...')</option>
                                    <option {{ old('language') == 'es' ? 'selected' : '' }} value="es">@lang('Spanish')</option>
                                    <option {{ old('language') == 'en' ? 'selected' : '' }} value="en">@lang('English')</option>
                                </select>
                                @error('language')
                                    <span class="help-block text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">@lang('UserName')
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-5">
                                <input autocomplete="off" type="text" name="username" value="{{ old('username') }}" data-required="1" placeholder="@lang('Enter Username')" class="form-control input-height" />
                                @error('username')
                                    <span class="help-block text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">@lang('Phone')
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-5">
                                <input autocomplete="off" type="text" name="phone" value="{{ old('phone') }}"  id="phone" data-required="1" data-mask="(999) 999-9999" placeholder="@lang('Enter Phone')" class="form-control input-height" />
                                @error('phone')
                                    <span class="help-block text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">@lang('Mobile')
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-5">
                                <input autocomplete="off" type="text" name="cellphone" value="{{ old('cellphone') }}" data-required="1" data-mask="(999) 999-9999" placeholder="@lang('Enter Mobile')" class="form-control input-height" />
                                @error('cellphone')
                                    <span class="help-block text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">@lang('Email')
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-5">
                                <input autocomplete="off" type="text" name="email" value="{{ old('email') }}" data-required="1" placeholder="@lang('Enter Email')" class="form-control input-height" />
                                @error('email')
                                    <span class="help-block text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">@lang('Rol')
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-5">
                                <select class="form-control input-height" name="role" id="role">
                                    <option value="" disabled selected>@lang('Select...')</option>
                                    @foreach ($roles as $rol)
                                        <option {{ old('role') == $rol->id ? 'selected' : '' }} assignable="{{ $rol->assignable }}" value="{{ $rol->id }}">{{ $rol->name }}</option>
                                    @endforeach
                                </select>
                                @error('role')
                                    <span class="help-block text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">@lang('Specialty')
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-5">
                                <select class="form-control input-height"  name="specialty" id="specialty">
                                    <option value="" disabled selected>@lang('Select...')</option>
                                </select>
                                @error('specialty')
                                    <span class="help-block text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>
                        <div class="assignable_area_div" style="display: none">

                            @if (!empty(old('assigned_to')))
                                @for ($i = 0; $i < count(old('assigned_to')); $i++)
                                    <div class="form-group row assigned_cloned">
                                        <label class="control-label col-md-3">@lang("Assigned To")
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-5">
                                            <div class="input-group">
                                                <input autocomplete="off" list="valAutocomplete" type="text" onclick="this.setSelectionRange(0, this.value.length)" name="assigned_to[]" value="{{ old("assigned_to.$i") }}" data-required="1" placeholder="@lang("Assigned To")" class="form-control input-height" />
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-danger btn-flat btn-remove-assign">
                                                        <i class="material-icons f-left" style="">remove_circle</i>
                                                    </button>
                                                </span>
                                            </div>
                                            @error('assigned_to.'.$i)
                                                <span class="help-block text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                @endfor
                            @endif

                        </div>
                        <div class="form-group row assignable_area" style="display: none">
                            <label class="control-label col-md-3">
                                <span class="required">  </span>
                            </label>
                            <div class="col-md-5 d-flex justify-content-end">
                                <button type="button" class="btn btn-info" id="add_asiggnament">@lang('Add Asiggnament')</button>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">@lang('Color')
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-5">
                                <input autocomplete="off" type="color" value="{{ old('color') }}" class="form-control input-height" name="color">
                                @error('color')
                                    <span class="help-block text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>
                        @if (Auth::guard('staff')->user()->can('staff.create.permisions.admins') || Auth::guard('staff')->user()->can('staff.create.permisions'))
                            @include('staff.staff-manager.permissions-add')
                        @endif
						<div class="form-actions">
                            <div class="row justify-content-md-center col-12">
                                <div class="offset-md-6 col-md-9">
                                    <button type="submit" class="btn btn-info">@lang('Submit')</button>
                                    <button type="button" class="btn btn-default">@lang('Cancel')</button>
                                </div>
                        	</div>
                   		 </div>
					</div>
                </form>
            </div>
        </div>
    </div>
</div>
<datalist id="valAutocomplete">

</datalist>
@endsection

@section('scripts')
    <script>
        $("#selectAll").click(function() {
            $("input[type=checkbox]").prop("checked", $(this).prop("checked"));
        });
        $("input[type=checkbox]").click(function() {
            if (!$(this).prop("checked")) {
                $("#selectAll").prop("checked", false);
                $(this).parents('.card-body').siblings().find('.selectAllGroup').prop("checked", false);
            }
        });
        $(".selectAllGroup").click(function() {
            var input = $(this).parents('.card-head').siblings().find('.check-group')
            var checked = $(this).is(":checked")
            if (checked) {
                input.prop('checked', true);
            } else {
                input.prop('checked', false);
            }
        });
    </script>
    <script src="{{ asset('staffFiles/assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js') }}" ></script>
    <script type="text/javascript">
        var globalRouteGetSpecialty = '{{ route('staff.staff.getSpecialty') }}'
        var globalRouteGetAssignation = '{{ route('staff.staff.getAssignation') }}'
    </script>
    <script>
        function get_assignable(id)
        {
            console.log(id);
            var form_data = new FormData();
            form_data.append('id', id);
            $.ajax({
                url: globalRouteGetAssignation,
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
                    $("#valAutocomplete").html('');
                },
                success:function(data)
                {
                    if (data.data.length > 0) {
                        $('.assignable_area_div').show('fast').html('');

                        if (data.data.length == 1) {
                            $('.assignable_area').hide('fast')
                            add_asiggnable()
                            $('[name^="assigned_to"]').val(data.data[0].service)
                        } else {
                            $('.assignable_area').show('fast')
                        }
                        $.each(data.data, function (indexInArray, val) {
                            $("#valAutocomplete").append('<option  value="'+val.service+'">'+val.service+'</option>')
                        });

                    }
                },
            })
        }

        function getSpecialty(id)
        {
            var form_data = new FormData();
            form_data.append('id', id);
            $.ajax({
                url: globalRouteGetSpecialty,
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
                    $("#specialty option:not(:first)").remove();
                    $("#specialty").prop("selectedIndex", 0);
                    $('.assignable_area').hide('fast')
                    $('.assignable_area_div').hide('fast').html('');
                },
                success:function(data)
                {
                    if (data.reload) {
                        Toast.fire({
                            icon: data.icon,
                            title: data.msg
                        })
                        location.reload(true);
                    } else {
                        $("#specialty option:not(:first-child)").remove();
                        var selected;
                        var one = false;
                        if (data.data.length == 1) {
                            selected = 'selected'
                            one = true;
                        }
                        $.each(data.data, function(index, val) {
                            $("#specialty").append('<option '+selected+' assignable="'+val.assignable+'" value="'+val.id+'">'+val.name+'</option>')
                            if (one) {
                                if (val.assignable == '1') {
                                    get_assignable(val.id)
                                }
                            }
                        });
                    }
                },
            })
        }

        $(document).on('change', '#role', function(event) {
            event.preventDefault();
            var id = $( "#role option:selected" ).val()
            if (!isNaN(id)) {
                getSpecialty(id)
                $('.assignable_area').hide('fast')
                $('.assignable_area_div').hide('fast').html('');
            } else {
                location.reload(true);
            }
        });

        $(document).on('change', '#specialty', function(event) {
            event.preventDefault();
            var id = $( "#specialty option:selected" ).val()
            var assignable = $( "#specialty option:selected" ).attr('assignable')
            if (assignable == 1) {
                get_assignable(id)
            } else {
                $('.assignable_area').hide('fast')
                $('.assignable_area_div').hide('fast').html('');
            }
        });

        $(document).on("click", ".btn-remove-assign", function () {
            $(this).parents('.assigned_cloned').remove();

            if(document.getElementsByClassName("assigned_cloned").length == 0){
                add_asiggnable()
            }
        });

        $('#add_asiggnament').on('click', function(e){
            add_asiggnable()
        })

        function add_asiggnable() {
            $assing = '';
            $assing += '<div class="form-group row assigned_cloned">'
            $assing += '<label class="control-label col-md-3">@lang("Assigned To")'
            $assing += '<span class="required"> * </span>'
            $assing += '</label>'
            $assing += '<div class="col-md-5">'
            $assing += '<div class="input-group">'
            $assing += '<input autocomplete="off" list="valAutocomplete" type="text" onclick="this.setSelectionRange(0, this.value.length)" name="assigned_to[]" value="" data-required="1" placeholder="@lang("Assigned To")" class="form-control input-height" />'
            $assing += '<span class="input-group-btn">'
            $assing += '<button type="button" class="btn btn-danger btn-flat btn-remove-assign">'
            $assing += '<i class="material-icons f-left" style="">remove_circle</i>'
            $assing += '</button>'
            $assing += '</span>'
            $assing += '</div>'
            $assing += '@error("color")'
            $assing += '<span class="help-block text-danger"> holis </span>'
            $assing += '@enderror'
            $assing += '</div>'
            $assing += '</div>'
            $('.assignable_area_div').append($assing);
        }

    </script>
    @if ($errors->any())
        <script>
            getSpecialty({{ old('role') }})
            function getSpecialty(id)
            {
                    var form_data = new FormData();
                    form_data.append('id', id);
                    $.ajax({
                        url: globalRouteGetSpecialty,
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
                            if (data.reload) {
                                Toast.fire({
                                    icon: data.icon,
                                    title: data.msg
                                })
                                location.reload(true);
                            } else {
                                $("#specialty option:not(:first-child)").remove();
                                $.each(data.data, function(index, val) {
                                    if (val.id == '{{ old('specialty') }}') {
                                        var selected = 'selected'
                                    }
                                    $("#specialty").append('<option '+selected+' assignable="'+val.assignable+'" value="'+val.id+'">'+val.name+'</option>')
                                });
                            }
                        },
                        complete: function()
                        {
                        },
                    })
            }

            // if ($( "#role option:selected" ).attr('assignable') == 1) {
            //     $('.assignable_area').show('fast')
            //     $('.assignable_area_div').show('fast')

            // } else {
            //     $('.assignable_area').hide('fast')
            //     $('.assignable_area_div').hide('fast').html('');

            // }
        </script>
    @endif
@endsection
