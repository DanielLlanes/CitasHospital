@extends('staff.layouts.app')
@section('title')
    @lang('User Profile')
@endsection
@section('content')

<div class="page-bar">
    <div class="page-title-breadcrumb">
        <div class=" pull-left">
            <div class="page-title">@lang('User Profile')</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index-2.html">@lang('Home')</a>&nbsp;<i class="fa fa-angle-right"></i>
            </li>
            <li class="active">@lang('User Profile')</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN PROFILE SIDEBAR -->
        <div class="profile-sidebar">
            <div class="card ">
                <div class="card-body no-padding height-9">
                    <div class="row">
                        <div class="profile-userpic">
                            <img src="{{ asset( getAvatarCached(auth()->guard('staff')->user(), 'avatar') ) }}" class="img-responsive" alt="{{ auth()->guard('staff')->user()->name }}"> </div>
                    </div>
                    
                    <div class="profile-usertitle">
                        <div class="profile-usertitle-name">{{ $staff->name }} </div>
                        <h3 class="m-0">Role</h3>
                        @foreach ($staff->roles as $role)
                            <div class="profile-usertitle-job"> {{ $role->Rname }} </div>
                        @endforeach
                        <h3 class="m-0">Specialies</h3>
                        @foreach ($staff->specialties as $specialty)
                            <div class="profile-usertitle-job"> {{ $specialty->Sname }} </div>
                        @endforeach
                        <h3 class="m-0">Assigned to</h3>
                        @foreach ($staff->assignToService as $service)
                           <div class="profile-usertitle-job"> {{ $service->service }} </div>
                        @endforeach
                    </div>
                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>@lang('Username')</b> <a class="pull-right">{{ $staff->username }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>@lang('Email')</b> <a class="pull-right">{{ $staff->email }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>@lang('Phone')</b> <a class="pull-right">{{ $staff->phone }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>@lang('Mobile')</b> <a class="pull-right">{{ $staff->cellphone }}</a>
                        </li>
                    </ul>
                    <!-- END SIDEBAR USER TITLE -->
                    <!-- SIDEBAR BUTTONS -->
                    <div class="profile-userbuttons">
                        {{-- <button type="button" class="btn btn-circle green btn-sm">Follow</button> --}}
                        <button type="button" class="btn btn-circle red btn-sm">@lang('Message')</button>
                    </div>
                    <!-- END SIDEBAR BUTTONS -->
                </div>
            </div>
            @if (auth()->guard('staff')->user()->id === $staff->id)
                <div class="card">
                    <div class="card-head ">
                        <header>@lang('Change my Password')</header>
                    </div>
                    <div class="card-body no-padding height-9">
                        <div class="profile-desc">
                            @lang('Change your password to access the system, with at least 8 characters and easy to remember')
                        </div>
                        <hr>
                        <form>
                            <div class="form-group">
                                <label for="current_password" class="col-form-label-sm">@lang('Current Password')</label>
                                <input type="password" class="form-control input-sm" name="current_password" id="current_password" placeholder="@lang('Current Password')">
                                <div class="error text-danger col-form-label-sm"></div>
                            </div>
                            <div class="form-group">
                                <label for="new_password" class="col-form-label-sm">@lang('New Password')</label>
                                <input type="password" class="form-control input-sm" name="new_password" id="new_password" placeholder="@lang('New Password')">
                                <div class="error text-danger col-form-label-sm"></div>
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation" class="col-form-label-sm">@lang('Confirm new Password')</label>
                                <input type="password" class="form-control input-sm" name="password_confirmation" id="password_confirmation" placeholder="@lang('Confirm new Password')">
                                <div class="error text-danger col-form-label-sm"></div>
                            </div>
                            <button type="submit" id="changepasswordButton" class="btn btn-primary">@lang('Change my Password')</button>
                        </form>
                    </div>
                </div>
            @endif
        </div>
        <!-- END BEGIN PROFILE SIDEBAR -->
        <!-- BEGIN PROFILE CONTENT -->
        <div class="profile-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-head d-flex">
                            <div class="col-6">
                                <header>User Profile </header>
                            </div>
                            @if ($staff->public_profile == 1)
                                <div class="col-6 ml-auto text-right">
                                   <a href="{{ route('staff.profile.createPublicProfile') }}" class="btn btn-circle btn-success btn-sm">@lang('Create public profile')</a>
                                </div> 
                            @endif  
                        </div>
                        @if ($staff->public_profile == 1)
                            <div class="card-body no-padding height-9">
                                <div class="container-fluid">
                                    <h5 class="font-weight-bold mt-5 mb-3 text-center">Career Objective</h5>
                                    <div class="">
                                        <div >
                                            @foreach ($staff->careerobjetive as $careerobjetive)
                                                {!! $careerobjetive->career_objective !!}
                                            @endforeach
                                            <hr>
                                        </div>
                                        <h5 class="font-weight-bold mt-5 mb-3">Work History</h5>
                                        <div >
                                            @foreach ($staff->workhistory as $workhistory)
                                                <p class="p-0 m-0">{{ $workhistory->job_title}}</p>
                                                <p class="p-0 m-0">{{ $workhistory->job_company }}</p>
                                                <p>{{ date('Y', strtotime($workhistory->job_from_year)) }} - {{ date('Y', strtotime($workhistory->job_to_year)) }}</p>
                                                <p>
                                                    {!! $workhistory->job_notes !!}
                                                </p>
                                                <hr>
                                            @endforeach
                                        </div>

                                    </div>
                                    <h5 class="font-weight-bold mt-5 mb-3">Education Background</h5>
                                    <div class="">
                                        <div >
                                            @foreach ($staff->educationbackground as $educationbackground)
                                                <p class="p-0 m-0">{{ $educationbackground->education_title}}</p>
                                                <p class="p-0 m-0">{{ $educationbackground->education_school }}</p>
                                                <p>{{ date('Y', strtotime($educationbackground->education_from_year)) }} - {{ date('Y', strtotime($educationbackground->education_to_year)) }}</p>
                                                <p>
                                                    {!! $educationbackground->education_notes !!}
                                                </p>
                                                <hr>
                                            @endforeach
                                        </div>
                                    </div>
                                    <h5 class="font-weight-bold mt-5 mb-3">Postgaduate Studies:</h5>
                                    <div class="">
                                        <div >
                                            @foreach ($staff->postgraduatestudies as $postgraduatestudies)
                                                <p class="p-0 m-0">{{ $postgraduatestudies->postgraduate_title}}</p>
                                                <p class="p-0 m-0">{{ $postgraduatestudies->postgraduate_school }}</p>
                                                <p>{{ date('Y', strtotime($postgraduatestudies->postgraduate_from_year)) }} - {{ date('Y', strtotime($postgraduatestudies->postgraduate_to_year)) }}</p>
                                                <p>
                                                    {!! $postgraduatestudies->postgraduate_notes !!}
                                                </p>
                                                <hr>
                                            @endforeach
                                        </div>
                                    </div>
                                    <h5 class="font-weight-bold mt-5 mb-3">Update courses:</h5>
                                    <div class="">
                                        @foreach ($staff->updatecourses as $updatecourse)
                                            <p class="p-0 m-0">{{ $updatecourse->course_title }}</p>
                                            <p class="p-0 m-0">{{ $updatecourse->course_school }}</p>
                                            <p class="p-0 m-0">{{ date('Y', strtotime($updatecourse->course_year)) }}</p>
                                            <hr>
                                        @endforeach
                                    </div>
                                    <h5 class="font-weight-bold mt-5 mb-3">Images:</h5>
                                    <div class="col-12">
                                        <div class="row">
                                            @foreach ($staff->imageMany as $imagespublicprofile)
                                                <div class="col-md-4">
                                                    <p>{{ $imagespublicprofile->title }}</p>
                                                    <img class="img-responsive" src="{{ asset($imagespublicprofile->image) }}" alt="{{ $imagespublicprofile->title }}">
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <!-- END PROFILE CONTENT -->
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script>
        var globalChangeOwnPassStaff = '{{ route('staff.profile.changeOwnPassStaff') }}'
    </script>
    <script>
        $(document).on('click', '#changepasswordButton', function(event) {
            event.preventDefault();
            var dataString = new FormData();
            dataString.append('current_password', $('#current_password').val());
            dataString.append('new_password', $('#new_password').val());
            dataString.append('password_confirmation', $('#password_confirmation').val());
            
            $.ajax({
                type: "POST",
                url: globalChangeOwnPassStaff,
                method:"POST",
                data:dataString,
                dataType:'JSON',
                contentType: false,
                cache: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                processData: false,
                beforeSend: function(){
                    $('.error').html('');
                },
                success: function(data) {
                    console.log("data", data);
                    if (data.reload) {
                        Toast.fire({
                            icon: data.icon,
                            title: data.msg
                        })
                        $('#formReset').click();
                    } else {
                        $.each( data.errors, function( key, value ) {
                            $('*[id^='+key+']').parent().find('.error').append('<p>'+value+'</p>')
                        });
                    }
                }
            });
        });
    </script>
@endsection