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
                            <img src="{{ asset( getAvatarCached(auth()->guard('staff')->user(), 'avatar') ) }}" class="img-responsive" alt="{{ $staff->name }}"> </div>
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
        </div>
        <!-- END BEGIN PROFILE SIDEBAR -->
        <!-- BEGIN PROFILE CONTENT -->
        <div class="profile-content">
            <div class="row">
                <div class="profile-tab-box">
                    <div class="p-l-20">
                        <ul class="nav ">
                            <li class="nav-item tab-all">
                                <a class="nav-link active show" href="#careerObjetive" data-toggle="tab">Career Objective</a>
                            </li>
                            <li class="nav-item tab-all p-l-20">
                                <a class="nav-link" href="#workHistory" data-toggle="tab">Work History</a>
                            </li>
                            <li class="nav-item tab-all p-l-20">
                                <a class="nav-link" href="#educationBackground" data-toggle="tab">Education Background</a>
                            </li>
                            <li class="nav-item tab-all p-l-20">
                                <a class="nav-link" href="#postgraduateStudies" data-toggle="tab">Postgaduate Studies</a>
                            </li>
                            <li class="nav-item tab-all p-l-20">
                                <a class="nav-link" href="#updateCourses" data-toggle="tab">Update courses</a>
                            </li>
                            <li class="nav-item tab-all p-l-20">
                                <a class="nav-link" href="#uploadImages" data-toggle="tab">Upload Images</a>
                            </li>
                            @if (Auth::guard('staff')->user()->hasAnyRole(['dios', 'administrator', 'super-administrator']))
                                <li class="nav-item tab-all p-l-20">
                                    <a class="nav-link" href="#surgeriesPerfored" data-toggle="tab">Surgeries performed</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="white-box">
                    <div class="tab-content">
                        <div class="tab-pane active fontawesome-demo" id="careerObjetive">
                            <div id="biography" >
                                <div class="row" style="flex-flow: column;">
                                    <h5 class="font-weight-bold mt-5 mb-3">Career Objective:</h5>
                                    <form class="" id="careerObjetiveSubmit">
                                        <div id="career_objective_area">
                                            <div class="row" id="career_objective_Form">
                                                @foreach ($staff->careerobjetive as $careerobjetive)
                                                    <div class="col-12">
                                                        <textarea name="career_objective" class="summernote-career_objective career_objective" id="career_objective" style="width: 100%;">{!! $careerobjetive->career_objective !!}</textarea>
                                                        <div class="addbtnArea text-right">
                                                            <button type="submit" id="agregate" class="btn btn-success">+ @lang('upload info')</button>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                <hr>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fontawesome-demo" id="workHistory">
                            <div id="biography">
                                <div class="row" style="flex-flow: column;">
                                    <h5 class="font-weight-bold mt-5 mb-3">Work History:</h5>
                                    <form class="" id="workHistorySubmit">
                                        <div id="workHistoryArea">
                                            <div class="row" id="workHistoryForm">
                                               @foreach ($staff->workhistory as $workhistory)
                                                   <div class="cloned" style="display: contents">
                                                       <div class="col-md-6">
                                                           <div class="form-group">
                                                               <label for="simpleFormEmail">Job Title</label>
                                                               <input type="text" class="form-control" name="job_title[]" placeholder="Job Title" value="{{ $workhistory->job_title}}">
                                                               <div class="error text-danger"></div>
                                                           </div>
                                                       </div>
                                                       <div class="col-md-6">
                                                           <div class="form-group">
                                                               <label for="simpleFormPassword">Job Company</label>
                                                               <input type="text" class="form-control" name="job_company[]" placeholder="Job Company" value="{{ $workhistory->job_company }}">
                                                               <div class="error text-danger"></div>
                                                           </div>
                                                       </div>
                                                       <div class="col-md-6">
                                                           <div class="form-group">
                                                               <label for="simpleFormEmail">From Year</label>
                                                               <input type="text" class="form-control intLimitTextBox" name="job_from_year[]" placeholder="Job Title" value="{{ $workhistory->job_from_year }}">
                                                               <div class="error text-danger"></div>
                                                           </div>
                                                       </div>
                                                       <div class="col-md-6">
                                                           <div class="form-group">
                                                               <label for="simpleFormPassword">To Year</label>
                                                               <input type="text" class="form-control intLimitTextBox" name="job_to_year[]"id="simpleFormPassword" placeholder="Job Company" value="{{ $workhistory->job_to_year }}">
                                                               <div class="error text-danger"></div>
                                                           </div>
                                                       </div>
                                                       <div class="col-12">
                                                           <div class="form-group">
                                                               <label for="simpleFormPassword">Notes</label>
                                                               <textarea class="form-control summernote-history-notes mb-3" name="job_notes[]" style="width: 100%;">{!! $workhistory->job_notes !!}</textarea>
                                                               <div class="error text-danger"></div>
                                                           </div>
                                                       </div>
                                                       <div class="col-12" id="delbtn">
                                                           <div class="form-group text-right" id="delBtnDiv">
                                                               <button type="button" class="btn delBtn btn-danger">Delete</button>
                                                           </div>
                                                           <hr>
                                                       </div>
                                                   </div>
                                               @endforeach
                                            </div>
                                        </div>
                                        <div class="addbtnArea text-right">
                                            <button type="button" id="addbtn" class="btn btn-warning">+ @lang('Add')</button>
                                        </div>
                                        <div class="addbtnArea text-right mt-5">
                                            <button type="submit" id="workHistoryBtn" class="btn btn-success">+ @lang('Upload Work history')</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fontawesome-demo" id="educationBackground">
                            <div id="biography">
                                <div class="row" style="flex-flow: column;">
                                    <h5 class="font-weight-bold mt-5 mb-3">Education Background:</h5>
                                    <form class="" id="educationBackgroundSubmit">
                                        <div id="educationBackgroundArea">
                                            <div class="row" id="educationBackgroundForm">
                                                @foreach ($staff->educationbackground as $educationbackground)
                                                    <div class="cloned" style="display: contents">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="education_title">Education Title</label>
                                                                <input type="text" class="form-control education_title" name="education_title[]" placeholder="Education Title" value="{{ $educationbackground->education_title }}">
                                                                <div class="error text-danger"></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="simpleFormPassword">Education School</label>
                                                                <input type="text" class="form-control education_school" name="education_school[]" id="simpleFormPassword" placeholder="Education School" value="{{ $educationbackground->education_school }}">
                                                                <div class="error text-danger"></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="simpleFormEmail">From Year</label>
                                                                <input type="text" class="form-control intLimitTextBox education_from_year" name="education_from_year[]" value="{{ $educationbackground->education_from_year }}">
                                                                <div class="error text-danger"></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="simpleFormPassword">To Year</label>
                                                                <input type="text" class="form-control intLimitTextBox education_to_year" name="education_to_year[]" value="{{ $educationbackground->education_to_year }}">
                                                                <div class="error text-danger"></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="simpleFormPassword">Notes</label>
                                                                <textarea class="form-control summernote-education-notes mb-3 education_notes" id="simpleFormPassword" name="education_notes[]" style="width: 100%;">{!! $educationbackground->education_notes !!}</textarea>
                                                                <div class="error text-danger"></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12" id="delbtn">
                                                            <div class="form-group text-right" id="delBtnDiv">
                                                                <button type="button" class="btn delBtn btn-danger">Delete</button>
                                                            </div>
                                                            <hr>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="addbtnArea text-right">
                                            <button type="button" id="addbtn" class="btn btn-warning">+ @lang('Add')</button>
                                        </div>
                                        <div class="addbtnArea text-right mt-5">
                                            <button type="submit" id="educationBackgroundBtn" class="btn btn-success">+ @lang('Upload education background')</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fontawesome-demo" id="postgraduateStudies">
                            <div id="biography">
                                <div class="row" style="flex-flow: column;">
                                    <h5 class="font-weight-bold mt-5 mb-3">Postgaduate Studies:</h5>
                                    <form class="" id="postgraduateStudiesSubmit">
                                        <div id="postgraduateStudiesArea">
                                            <div class="row" id="postgraduateStudiesForm">
                                                @foreach ($staff->postgraduatestudies as $postgraduatestudies)
                                                    <div class="cloned" style="display: contents">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="simpleFormEmail"> Title</label>
                                                                <input type="text" class="form-control postgraduate_title" name="postgraduate_title[]" placeholder="Postgraduate Studies Title" value="{{ $postgraduatestudies->postgraduate_title }}">
                                                                <div class="error text-danger"></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="simpleFormPassword">School</label>
                                                                <input type="text" class="form-control postgraduate_school" name="postgraduate_school[]" id="simpleFormPassword" placeholder="Postgraduate Studies Company" value="{{ $postgraduatestudies->postgraduate_school }}">
                                                                <div class="error text-danger"></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="simpleFormEmail">From Year</label>
                                                                <input type="text" class="form-control intLimitTextBox postgraduate_from_year intLimitTextBox" name="postgraduate_from_year[]"  value="{{ $postgraduatestudies->postgraduate_from_year }}">
                                                                <div class="error text-danger"></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="simpleFormPassword">To Year</label>
                                                                <input type="text" class="form-control intLimitTextBox postgraduate_to_year intLimitTextBox" name="postgraduate_to_year[]" value="{{ $postgraduatestudies->postgraduate_to_year }}">
                                                                <div class="error text-danger"></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="simpleFormPassword">Notes</label>
                                                                <textarea class="form-control summernote-posgraduate-notes mb-3 postgraduate_notes" id="simpleFormPassword" name="postgraduate_notes[]" style="width: 100%;">{!! $postgraduatestudies->postgraduate_notes !!}</textarea>
                                                                <div class="error text-danger"></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12" id="delbtn">
                                                            <div class="form-group text-right" id="delBtnDiv">
                                                                <button type="button" class="btn delBtn btn-danger">Delete</button>
                                                            </div>
                                                            <hr>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="addbtnArea text-right">
                                            <button type="button" id="addbtn" class="btn btn-warning">+ @lang('Add')</button>
                                        </div>
                                        <div class="addbtnArea text-right mt-5">
                                            <button type="submit" id="postgraduateStudiesBtn" class="btn btn-success">+ @lang('Upload Postgraduate Studies')</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fontawesome-demo" id="updateCourses">
                            <div id="biography">
                                <div class="row" style="flex-flow: column;">
                                    <h5 class="font-weight-bold mt-5 mb-3">Update Courses:</h5>
                                    <form class="" id="updateCoursesSubmit">
                                        <div id="updateCoursesArea">
                                            <div class="row" id="updateCoursesForm">
                                                @foreach ($staff->updatecourses as $updatecourses)
                                                    <div class="cloned" style="display: contents">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="simpleFormEmail">Course Title</label>
                                                                <input type="text" class="form-control course_title" name="course_title[]" placeholder="Study Title" value="{{ $updatecourses->course_title}}">
                                                                <div class="error text-danger"></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="simpleFormPassword">Course School</label>
                                                                <input type="text" class="form-control course_school" name="course_school[]" id="simpleFormPassword" placeholder="Study School" value="{{ $updatecourses->course_school}}">
                                                                <div class="error text-danger"></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="simpleFormEmail">Year</label>
                                                                <input type="text" class="form-control intLimitTextBox course_year" name="course_year[]" value="{{ $updatecourses->course_year}}">
                                                                <div class="error text-danger"></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12" id="delbtn">
                                                            <div class="form-group text-right" id="delBtnDiv">
                                                                <button type="button" class="btn delBtn btn-danger">Delete</button>
                                                            </div>
                                                            <hr>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="addbtnArea text-right">
                                            <button type="button" id="addbtn" class="btn btn-warning">+ @lang('Add')</button>
                                        </div>
                                        <div class="addbtnArea text-right mt-5">
                                            <button type="submit" id="updateCoursesBtn" class="btn btn-success">+ @lang('Upload Update Courses')</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fontawesome-demo" id="uploadImages">
                            <div id="biography">
                                <div class="row" style="flex-flow: column;">
                                    <h5 class="font-weight-bold mt-5 mb-3">Upload Images:</h5>
                                    <form class="" id="uploadImagesSubmit">
                                        <div id="suergeriesPerformedArea">
                                            <div class="row" id="uploadImagesForm">
                                                @foreach ($staff->imageMany as $imagespublicprofile)
                                                    <div class="col-md-4" id="">
                                                        <div class="form-group">
                                                            <label>Image Title</label>
                                                            <input type="text" class="form-control mb-2 image_title" name="image_title" placeholder="Image Title" value="{{ $imagespublicprofile->title }}">
                                                            <div class="error text-danger"></div>
                                                            <input type="file" class="form-control dropify image_file" data-allowed-file-extensions="pdf png jpg jpge" count="{{ $imagespublicprofile->order }}" name="image_file" data-default-file="{{ asset($imagespublicprofile->image) }}" code="{{ $imagespublicprofile->code }}">
                                                            <div class="error text-danger"></div>
                                                        </div>
                                                        <div class="col-12" id="delbtn">
                                                            <div class="form-group text-right" id="delBtnDiv">
                                                                <button type="button" class="btn addBtnImg btn-success mr-1">@lang('Add image')</button>
                                                                <button type="button" class="btn delBtnImg btn-danger ml-1">@lang('delete image')</button>
                                                            </div>
                                                            <hr>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="addbtnArea text-right">
                                            <button type="button" id="addbtnImage" class="btn btn-warning">+ @lang('Add')</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fontawesome-demo" id="surgeriesPerfored">
                            <div id="biography">
                                <div class="row" style="flex-flow: column;">
                                    <h5 class="font-weight-bold mt-5 mb-3">Update Courses:</h5>
                                    <form class="" id="surgeryPerformedSubmit">
                                        <div id="surgeryPerformedArea">
                                            <div class="row" id="surgeryPerformedForm">
                                                @foreach ($staff->surgeryperformed as $surgery)
                                                <div class="cloned" style="display: contents">
                                                    <div class="col-md-4"><div class="form-group">
                                                        <label for="simpleFormEmail">Surgery Title</label>
                                                        <input type="text" class="form-control surgery_title" name="surgery_title[]" placeholder="Study Title" value="{{ $surgery->surgery_title }}">
                                                        <div class="error text-danger"></div></div><div class="form-group">
                                                            <label for="simpleFormEmail">SurgeryCount</label>
                                                            <input type="text" class="form-control surgery_cant uintTextBox" name="surgery_cant[]" placeholder="Study Title" value="{{ $surgery->surgery_number }}">
                                                            <div class="error text-danger"></div>
                                                        </div>
                                                        <div class="col-12" id="delbtn">
                                                            <div class="form-group text-right" id="delBtnDiv">
                                                                <button type="button" class="btn delBtn btn-danger">Delete</button>
                                                            </div>
                                                            <hr>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="addbtnArea text-right">
                                            <button type="button" id="addbtn" class="btn btn-warning">+ @lang('Add')</button>
                                        </div>
                                        <div class="addbtnArea text-right mt-5">
                                            <button type="submit" id="surgeryPerformedBtn" class="btn btn-success">+ @lang('Upload Update Courses')</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
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
        globalWorkHistory = '{{ route('staff.profile.workHistory') }}';
        globalEducationBackground = '{{ route('staff.profile.educationBackground') }}';
        globalPostgraduateStudies = '{{ route('staff.profile.postgraduateStudies') }}';
        globalUpdateCourses = '{{ route('staff.profile.updateCourses') }}';
        globalUploadImages = '{{ route('staff.profile.uploadImagesPublicProfile') }}';
        globalcareerObjetive = '{{ route('staff.profile.careerObjetive') }}';
        globalDeleteImages = '{{ route('staff.profile.deleteImagesPublicProfile') }}';
        globalDeleteSurgeriesPerformed = '{{ route('staff.profile.deleteSurgeriesPerformed') }}'
        globalDeleteSurgeriesPerformed = '{{ route('staff.profile.addSurgeriesPerformed') }}'
        var career_objective = "{{ count($staff->careerobjetive) }}"
        var workHistoryForm = "{{ count($staff->workhistory) }}"
        var educationBackgroundForm = "{{ count($staff->educationbackground) }}"
        var postgraduateStudiesForm = "{{ count($staff->postgraduatestudies) }}"
        var uploadImagesForm = "{{ count($staff->imageMany) }}"
        var updateCoursesForm = "{{ count($staff->updatecourses) }}"
        var surgeryPerformedForm = "{{ count($staff->surgeryperformed) }}"
        var staffID = "{{ $staff->id}}"
    </script>
    <script src="{{ asset('staffFiles/assets/js/customjs/staff-add-profile.min.js') }}"></script>

@endsection
