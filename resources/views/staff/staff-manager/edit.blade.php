@extends('staff.layouts.app')
@section('title')
    @lang('staff.Edit Staff')
@endsection
@section('content')
<div class="page-bar">
    <div class="page-title-breadcrumb">
        <div class=" pull-left">
            <div class="page-title">@lang('staff.Edit Staff')</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index-2.html">@lang('breadcrumb.Home')</a>&nbsp;<i class="fa fa-angle-right"></i>
            </li>
            <li><a class="parent-item" href="#">@lang('staff.Staff')</a>&nbsp;<i class="fa fa-angle-right"></i>
            </li>
            <li class="active">@lang('breadcrumb.Edit Staff')</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="card card-box">
            <div class="card-head">
                <header>@lang('staff.Basic Information')</header>
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
                <form method="POST" action="{{ route('staff.staff.update', $staff->id) }}" id="add-staff" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    <div class="form-body">
                        <div class="form-group row">
                            <label class="control-label col-md-3">@lang('Profile Picture')
                                <span class="required">  </span>
                            </label>
                            <div class="col-md-5">
                                <input type="file" name="avatar" class="dropify" data-default-file="{{ asset($staff->avatar) }}" />
                                @error('avatar')
                                    <span class="help-block text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">@lang('staff.Name')
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-5">
                                <input autocomplete="off" type="text" name="name" value="{{ $staff->name }}" data-required="1" placeholder="@lang('staff.Enter Name')" class="form-control input-height" />
                                @error('name')
                                    <span class="help-block text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">@lang('staff.Language')
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-5">
                                <select class="form-control input-height" name="language">
                                    <option value="">@lang('staff.Select...')</option>
                                    <option {{ $staff->lang == 'es' ? 'selected' : '' }} value="es">@lang('staff.Spanish')</option>
                                    <option {{ $staff->lang == 'en' ? 'selected' : '' }} value="en">@lang('staff.English')</option>
                                </select>
                                @error('language')
                                    <span class="help-block text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">@lang('staff.UserName')
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-5">
                                <input autocomplete="off" type="text" name="username" value="{{ $staff->username }}" data-required="1" placeholder="@lang('staff.Enter Username')" class="form-control input-height" />
                                @error('username')
                                    <span class="help-block text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">@lang('staff.Phone')
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-5">
                                <input autocomplete="off" type="text" name="phone" value="{{ $staff->phone }}"  id="phone" data-required="1" data-mask="(999) 999-9999" placeholder="@lang('staff.Enter  Phone')" class="form-control input-height" />
                                @error('phone')
                                    <span class="help-block text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">@lang('staff.Mobile')
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-5">
                                <input autocomplete="off" type="text" name="cellphone" value="{{ $staff->cellphone }}" data-required="1" data-mask="(999) 999-9999" placeholder="@lang('staff.Enter Mobile')" class="form-control input-height" />
                                @error('cellphone')
                                    <span class="help-block text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">@lang('staff.Email')
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-5">
                                <input autocomplete="off" type="text" name="email" value="{{ $staff->email }}" data-required="1" placeholder="@lang('staff.Enter Email')" class="form-control input-height" />
                                @error('email')
                                    <span class="help-block text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">@lang('staff.Rol')
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-5">
                                <select class="form-control input-height" name="role" id="role">
                                    <option value="">@lang('staff.Select...')</option>
                                    @foreach ($roles as $rol)
                                        <option {{ $staff->roles[0]->id == $rol->id ? 'selected' : '' }} value="{{ $rol->id }}">{{ $rol->name }}</option>
                                    @endforeach
                                </select>
                                @error('role')
                                    <span class="help-block text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row" id="specialyiesRow">
                            <label class="control-label col-md-3">@lang('Specialty')
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-5" id="specialtiesArea">
                                <div class="col-12">
                                    <div class="checkbox checkbox-icon-red form-check form-check-inline">
                                        <input id="checkbox-selectAll" class="form-check-input" type="checkbox">
                                        <label for="checkbox-selectAll" class="form-check-label" style="font-size: 12px">@lang("Select All")</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="assignable_area_div" @if(count($staff->assignToService) > 0) style="display: none" @endif>
                            @if (count($staff->assignToService) > 0)
                                @for ($i = 0; $i < count($staff->assignToService); $i++)
                                    <div class="form-group row assigned_cloned">
                                        <label class="control-label col-md-3">@lang("Assigned To")
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-5">
                                            <div class="input-group">
                                                <input autocomplete="off" list="valAutocomplete" type="text" onclick="this.setSelectionRange(0, this.value.length)" name="assigned_to[]" value="{{ $staff->assignToService[$i]->atsName }}" data-required="1" placeholder="@lang("Assigned To")" class="form-control input-height" />
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
                        <div class="form-group row assignable_area" @if(count($staff->assignToService) < 1) style="display: none" @endif>
                            <label class="control-label col-md-3">
                                <span class="required">  </span>
                            </label>
                            <div class="col-md-5 d-flex justify-content-end">
                                <button type="button" class="btn btn-info" id="add_asiggnament">@lang('Add Asiggnament')</button>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">@lang('url')
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-5">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-url-span"></span>
                                    </div>
                                    <input type="text" name="url" id="url" value="{{ $staff->url }}" class="form-control" id="basic-url" aria-describedby="basic-url">
                                </div>
                                @error('url')
                                <span class="help-block text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">@lang('staff.Color')
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-5">
                                <input autocomplete="off" type="color" value="{{ $staff->color }}" class="form-control input-height" name="color">
                                @error('color')
                                    <span class="help-block text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>
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
    @foreach($services as $service)
        <option  value="{{ $service->service }}"></option>
    @endforeach
</datalist>

@endsection

@section('scripts')
    <script>
        // $("#selectAll").click(function() {
        //     $("input[type=checkbox]").prop("checked", $(this).prop("checked"));
        // });
        // $("input[type=checkbox]").click(function() {
        //     if (!$(this).prop("checked")) {
        //         $("#selectAll").prop("checked", false);
        //         $(this).parents('.card-body').siblings().find('.selectAllGroup').prop("checked", false);
        //     }
        // });
        // $(".selectAllGroup").click(function() {
        //     var input = $(this).parents('.card-head').siblings().find('.check-group')
        //     var checked = $(this).is(":checked")
        //     if (checked) {
        //         input.prop('checked', true);
        //     } else {
        //         input.prop('checked', false);
        //     }
        // });
        // 
        
        var domain = window.location.protocol+"//"+window.location.hostname+"/";
        $('#basic-url-span').html(domain)
        $(document).on('keyup', '#name', function(){
            var value = $(this).val();
            
            $("#url").val(value.stringToSlug(value))
        })

        $("#checkbox-selectAll").click(function() {
            $(".specialtyCheckbox").prop("checked", $(this).prop("checked"));
        });

        // $(".specialtyCheckbox").on("click", function(){
        //     var checkboxs = $(".specialtyCheckbox");
        //     var todos = checkboxs.length === checkboxs.filter(":checked").length;
        //     var assignableArray = [];
        //     todos ? $("#checkbox-selectAll").prop("checked", true): $("#checkbox-selectAll").prop("checked", false);

        //     // var cont = 0; 

        //     for (var x=0; x < checkboxs.length; x++) {
        //         if (checkboxs[x].checked) {
        //             cont = checkboxs[x].getAttribute("assignable");
        //             if (checkboxs[x].getAttribute("assignable") > 0) {
        //                 assignableArray.push(checkboxs[x].getAttribute("assignable"))
        //             }
        //         }
        //     }

        //     if (assignableArray.length > 0) {
        //         console.log("assignableArray", assignableArray);
        //         $('.assignable_area').show('fast')
        //         $('.assignable_area_div').show('fast');
        //         if(document.getElementsByClassName("assigned_cloned").length == 0){
        //             add_asiggnable()
        //         }
        //     } else {
        //         $('.assignable_area').hide('fast')
        //         $('.assignable_area_div').hide('fast');
        //     }
        // })

        $(document).on('submit','form#add-staff',function(){
           var cont = 0; 
           var assignableArray = [];
           var checkboxs = $(".specialtyCheckbox");
            for (var x=0; x < checkboxs.length; x++) {
                if (checkboxs[x].checked) {
                    cont = checkboxs[x].getAttribute("assignable");
                    if (checkboxs[x].getAttribute("assignable") > 0) {
                        assignableArray.push(checkboxs[x].getAttribute("assignable"))
                    }
                }
            }

            if (assignableArray.length == 0) {
                $('.assignable_area').hide('fast')
                $('.assignable_area_div').hide('fast').html('');
            }
        });
    </script>   
    <script src="{{ asset('staffFiles/assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js') }}" ></script>
    <script type="text/javascript">
        var globalRouteGetSpecialty = '{{ route('staff.staff.getSpecialty') }}'
    </script>
        <script>
        @if ($staff->specialties) 
            var array = {!!json_encode($staff->specialties)!!};
        @endif   

        var globalRouteGetSpecialty = '{{ route('staff.staff.getSpecialty') }}'
        $(document).on('change', '#role', function(event) {
            event.preventDefault();
            var id = $( "#role option:selected" ).val()
            if (!isNaN(id)) {
                var flag = true;
                getSpecialty(id, flag)
                $('.assignable_area').hide('fast')
                $('.assignable_area_div').hide('fast').html('');
            } else {
                location.reload(true);
            }
        });
        getSpecialty({{ $staff->roles[0]->id }})
        function getSpecialty(id, flag = false)
        {
            var form_data = new FormData();
            var assignableArray = [];
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
                    $("#specialtiesArea .col-12:not(:first)").remove();
                },
                success:function(data)
                {
                console.log("data", data);
                    if (data.reload) {
                        Toast.fire({
                            icon: data.icon,
                            title: data.msg
                        })
                        location.reload(true);
                    } else {
                        var selected = '';
                        var one = false;
                        if (data.data.length == 1) {
                            selected = 'checked'
                            one = true;
                        }
                        var assignables = [];
                        $.each(data.data, function(index, val) {
                            var  ckhbx = '<div class="col-12">';
                                 ckhbx += '<div class="checkbox checkbox-icon-red form-check form-check-inline">';
                                 ckhbx += '<input id="checkbox-'+val.id+'" '+selected+' assignable="'+val.assignable+'"  name="specialties[]" class="form-check-input specialtyCheckbox" type="checkbox" value="'+val.id+'">';
                                 ckhbx += '<label for="checkbox-'+val.id+'" class="form-check-label" style="font-size: 12px">'+val.name+'</label>';
                                 ckhbx += '</div">';
                                 ckhbx += '</div">';

                            if (val.assignable) {
                                assignableArray.push(val.assignable)
                            }
                            $('#specialtiesArea').append(ckhbx);
                        });

                        $('#specialyiesRow').show('fast');
                        var checkboxs = $('#specialtiesArea').find($('.specialtyCheckbox'));
                        if (typeof array !== 'undefined') {
                            console.log("array", array);
                            $.each(array, function(index, val) {
                                $('#checkbox-'+val.id).prop("checked", true)
                            });
                        }
                        if (assignableArray.length > 0) {
                            $('.assignable_area').show('fast')
                            $('.assignable_area_div').show('fast');
                            if (flag) {add_asiggnable()}
                        }
                    }
                },
            })
        }
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
@endsection