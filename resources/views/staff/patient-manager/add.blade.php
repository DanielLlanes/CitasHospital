@extends('staff.layouts.app')
@section('title')
    @lang('Add Patient')
@endsection
@section('content')

<div class="page-bar">
    <div class="page-title-breadcrumb">
        <div class=" pull-left">
            <div class="page-title">@lang('Add Patient')</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index-2.html">@lang('Home')</a>&nbsp;<i class="fa fa-angle-right"></i>
            </li>
            <li><a class="parent-item" href="#">@lang('Patient')</a>&nbsp;<i class="fa fa-angle-right"></i>
            </li>
            <li class="active">@lang('Add Patient')</li>
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
                <form method="POST" action="{{ route('staff.patients.store') }}" id="add-patient" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    <div class="form-body">

                        <div class="form-group row">
                            <label class="control-label col-md-3">@lang('Profile Picture')
                                <span class="required">  </span>
                            </label>
                            <div class="col-md-5">
                                <input type="file" name="avatar" class="dropify" />
                                @error('avatar')
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
                            <label class="control-label col-md-3">@lang('Biological Sex')
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-5">
                                <select class="form-control input-height" name="sex" id="sex">
                                    <option value="" disabled selected>Select....</option>
                                    <option value="male" @if (old('sex') == "male") selected @elseif(!empty($patient) && $patient->sex == 'male') selected @endif>Male</option>
                                    <option value="female" @if (old('sex') == "female") selected @elseif(!empty($patient) && $patient->sex == 'famale') selected @endif>Female</option>
                                </select>
                                @error('sex')
                                    <span class="help-block text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">@lang('Birth Date')
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-5">
                                <input autocomplete="off" type="date" name="dob" value="{{ old('dob') }}" data-required="1" placeholder="@lang('Enter dob')" class="form-control input-height" />
                                @error('dob')
                                    <span class="help-block text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">@lang('Age')
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-5">
                                <input autocomplete="off" type="text" name="age" value="{{ old('age') }}" data-required="1" placeholder="@lang('Enter age')" class="form-control input-height" />
                                @error('age')
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
                                <input autocomplete="off" type="text" name="mobile" value="{{ old('mobile') }}" data-required="1" data-mask="(999) 999-9999" placeholder="@lang('Enter Mobile')" class="form-control input-height" />
                                @error('mobile')
                                    <span class="help-block text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">@lang('Adrress')
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-5">
                                <input autocomplete="off" type="text" name="address" value="{{ old('address') }}" data-required="1" placeholder="@lang('Enter address')" class="form-control input-height" />
                                @error('address')
                                    <span class="help-block text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">@lang('Country')
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-5">
                                <input autocomplete="off" type="text" name="country_id" value="{{ old('country_id') }}" data-required="1" placeholder="@lang('Enter country')" class="form-control input-height" />
                                @error('country_id')
                                    <span class="help-block text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>

    
                        <div class="form-group row">
                            <label class="control-label col-md-3">@lang('State')
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-5">
                                <input autocomplete="off" type="text" name="state_id" value="{{ old('state_id') }}" data-required="1" placeholder="@lang('Enter state')" class="form-control input-height" />
                                @error('state_id')
                                    <span class="help-block text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="control-label col-md-3">@lang('City')
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-5">
                                <input autocomplete="off" type="text" name="city" value="{{ old('city') }}" data-required="1" placeholder="@lang('Enter city')" class="form-control input-height" />
                                @error('city')
                                    <span class="help-block text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">@lang('Zip Code')
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-5">
                                <input autocomplete="off" type="text" name="zip" value="{{ old('zip') }}" data-required="1" placeholder="@lang('Enter zip')" class="form-control input-height" />
                                @error('zip')
                                    <span class="help-block text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">@lang('Emergency Contact Name')
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-5">
                                <input autocomplete="off" type="text" name="ecn" value="{{ old('ecn') }}" data-required="1" placeholder="@lang('Enter emergency contact name')" class="form-control input-height" />
                                @error('ecn')
                                    <span class="help-block text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">@lang('Emergency Contact Phone')
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-5">
                                <input autocomplete="off" type="text" name="ecp" value="{{ old('ecp') }}" data-required="1" placeholder="@lang('Enter emergency contact phone')" class="form-control input-height" />
                                @error('ecp')
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
    <script src="{{ asset('staffFiles/assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js') }}" ></script>
    @section('scripts')
    <script>
        
    </script>

    <script>
        // $(document).on('change', '#email', function () {
        //     var form_data = new FormData();
        //     form_data.append('email', $(this).val());
        //     $.ajax({
        //         url: globalRoutechekIfPatientExist,
        //         method:"POST",
        //         data:form_data,
        //         dataType:'JSON',
        //         contentType: false,
        //         cache: false,
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         },
        //         processData: false,
        //         beforeSend: function()
        //         {

        //         },
        //         success:function(data)
        //         {
        //             if (data.success) {
        //                 //$("input[name=treatmentBefore][value=1]").prop('checked', true);
        //                 //$("input[name=treatmentBefore]").attr('disabled', true);
        //                 $("#email").val(data.info.email);
        //                 $("#name").val(data.info.name);
        //                 $("#data-hidde").hide('fast');


        //             } else {
        //                 //clearForm()
        //                 $("#data-hidde").show('fast');
        //             }
        //         },
        //     })
        // });
        // $(document).on('change', '#country_id', function(event) {
        //     event.preventDefault();
        //     getStates()
        // });
        $(document).on('change', "input, select", function () {
            $(this).parent().find('.invalid-feedback ').html('');
        });
        // function getStates(state = null) {
        //     var form_data = new FormData();
        //     form_data.append('id', $( "#country_id option:selected" ).val());
        //     $.ajax({
        //         url: globalRouteobtenerEstados,
        //         method:"POST",
        //         data:form_data,
        //         dataType:'JSON',
        //         contentType: false,
        //         cache: false,
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         },
        //         processData: false,
        //         beforeSend: function()
        //         {
        //             $('#state_id').find('option').not(':first').remove();
        //             $('#state_id').val($("#state_id option:first").val());
        //         },
        //         success:function(data)
        //         {
        //             $.each(data, function (i, v) {
        //                 if (state !== null ) {
        //                     if (state == v.id) {
        //                         $('#state_id').append('<option selected value="'+v.id+'">'+v.name+'</option>');
        //                     }
        //                     $('#state_id').append('<option value="'+v.id+'">'+v.name+'</option>');
        //                 } else {
        //                     $('#state_id').append('<option value="'+v.id+'">'+v.name+'</option>');
        //                     $('#state_id').val($("#state_id option:eq(1)").val());
        //                 }

        //             });
        //         },
        //         complete: function()
        //         {
        //         },
        //     })
        // }
    </script>
    {{-- @if (old('country_id') || !empty($patient ?? ''))
    <script>
        var country_id = $( "#country_id" ).attr('country');
        $("#country_id option[value="+country_id+"]").attr("selected", true);
        getStates()
    </script>
    @endif
    @if (old('state_id') || !empty($patient ?? ''))
    <script>
        var state_id = $( "#state_id" ).attr('state');
        getStates(state_id)
    </script>
    @endif --}}
@endsection

@endsection
