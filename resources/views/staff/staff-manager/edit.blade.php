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
                            <label class="control-label col-md-3">@lang('staff.Profile Picture')
                            </label>
                            <div class="compose-editor">
                                <input type="file" class="default" name="avatar">
                            </div>
                            @error('avatar')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">@lang('staff.Name')
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-5">
                                <input autocomplete="off" type="text" name="name" value="{{ $staff->name }}" data-required="1" placeholder="@lang('staff.enter name')" class="form-control input-height" />
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
                                <input autocomplete="off" type="text" name="username" value="{{ $staff->username }}" data-required="1" placeholder="@lang('staff.enter username')" class="form-control input-height" />
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
                                <input autocomplete="off" type="text" name="phone" value="{{ $staff->phone }}"  id="phone" data-required="1" data-mask="(999) 999-9999" placeholder="@lang('staff.enter phone')" class="form-control input-height" />
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
                                <input autocomplete="off" type="text" name="cellphone" value="{{ $staff->cellphone }}" data-required="1" data-mask="(999) 999-9999" placeholder="@lang('staff.enter mobile')" class="form-control input-height" />
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
                                <input autocomplete="off" type="text" name="email" value="{{ $staff->email }}" data-required="1" placeholder="@lang('staff.enter email')" class="form-control input-height" />
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
                        <div class="form-group row">
                            <label class="control-label col-md-3">@lang('staff.Specialty')
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-5">
                                <select class="form-control input-height"  name="specialty" id="specialty">
                                    <option value="">@lang('staff.Select...')</option>
                                </select>
                                @error('specialty')
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
                        <div class="form-group row mt-2 mb-0">
                            <label class="control-label col-md-3 p-0 m-0">

                                <span class="required">  </span>
                            </label>
                            <div class="col-md-5">
                                <h3 class="m-0">@lang('staff.Permission')</h3>
                            </div>
                        </div>
                            <div class="form-group row">
                                @foreach ($groups as $group)
                                    <div class="col-md-4">
                                        <label class="control-label col-md-3">
                                        </label>
                                        <div class="col-md-12">
                                            <div class="card card-box">
                                                <div class="card-head">
                                                    <header>{{ $group->group }}</header>
                                                    {{-- <div class="tools">
                                                        <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                                                        <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                                        <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                                                    </div> --}}
                                                </div>
                                                <div class="card-body " id="bar-parent2">
                                                    <div class="row text-nowrap">
                                                        @foreach($permissions as $key => $permission)
                                                            @if ($permission->groupP == $group->group)
                                                                <div class="col-md-6 col-sm-6">
                                                                    <div class="checkbox checkbox-icon-black">
                                                                        <input
                                                                            id="permissions_{{ $permission->id }}"
                                                                            type="checkbox" name="permissions[]"
                                                                            value="{{ $permission->id }}"
                                                                            @if($staff->permissions->contains($permission)) checked @endif>
                                                                        <label for="permissions_{{ $permission->id }}">
                                                                            {{ $permission->description }}
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
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

@endsection

@section('scripts')

    <script src="{{ asset('staffFiles/assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js') }}" ></script>
    <script type="text/javascript">
        var globalRouteGetSpecialty = '{{ route('staff.staff.getSpecialty') }}'
    </script>
        <script>
            getSpecialtyx({{ $staff->roles[0]->id }})
            function getSpecialtyx(id)
            {
                var form_data = new FormData();
                form_data.append('id', id);
                console.log("id", id);
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

                     console.log({{ $staff->specialty->id }});
                        if (data.reload) {
                            Toast.fire({
                                icon: data.icon,
                                title: data.msg
                            })
                            location.reload(true);
                        } else {
                            $("#specialty option:not(:first-child)").remove();
                            $.each(data.data, function(index, val) {
                                if (val.id == {{ $staff->specialty->id }}) {
                                    var selected = 'selected'
                                    console.log("selected", selected);
                                }
                                $("#specialty").append('<option '+selected+' value="'+val.id+'">'+val.name+'</option>')
                            });
                        }
                     },
                     complete: function()
                     {
                     },
                 })
            }

        var globalRouteGetSpecialty = '{{ route('staff.staff.getSpecialty') }}'
        $(document).on('change', '#role', function(event) {
            event.preventDefault();
            var id = $( "#role option:selected" ).val()
            if (!isNaN(id)) {
                getSpecialty(id)
            } else {
                location.reload(true);
            }
        });
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
                                console.log("val", val.name);
                                $("#specialty").append('<option value="'+val.id+'">'+val.name+'</option>')
                            });
                        }
                     },
                     complete: function()
                     {
                     },
                 })
        }
    </script>
@endsection