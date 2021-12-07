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
                            <img src="{{ asset($staff->avatar) }}" class="img-responsive" alt=""> </div>
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
                        </ul>
                    </div>
                </div>
                <div class="white-box">
                    <div class="tab-content">
                        <div class="tab-pane active fontawesome-demo" id="careerObjetive">
                            <div id="biography" >
                                <div class="row" style="flex-flow: column;">
                                    <h5 class="font-weight-bold mt-5 mb-3">Career Objective:</h5>
                                    <div class="">
                                        <div id="career_objective_area">
                                            <div class="row" id="career_objective_Form"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fontawesome-demo" id="workHistory">
                            <div id="biography">
                                <div class="row" style="flex-flow: column;">
                                    <h5 class="font-weight-bold mt-5 mb-3">Work History:</h5>
                                    <div class="">
                                        <div id="workHistoryArea">
                                            <div class="row" id="workHistoryForm"></div>
                                        </div>
                                        <div class="addbtnArea text-right">
                                            <button type="button" id="addbtn" class="btn btn-warning">+ @lang('Add')</button>
                                        </div>
                                        <div class="addbtnArea text-right mt-5">
                                            <button type="button" id="workHistoryBtn" class="btn btn-success">+ @lang('Upload Work history')</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fontawesome-demo" id="educationBackground">
                            <div id="biography">
                                <div class="row" style="flex-flow: column;">
                                    <h5 class="font-weight-bold mt-5 mb-3">Education Background:</h5>
                                    <div class="">
                                        <div id="educationBackgroundArea">
                                            <div class="row" id="educationBackgroundForm"></div>
                                        </div>
                                        <div class="addbtnArea text-right">
                                            <button type="button" id="addbtn" class="btn btn-warning">+ @lang('Add')</button>
                                        </div>
                                        <div class="addbtnArea text-right mt-5">
                                            <button type="button" id="educationBackgroundBtn" class="btn btn-success">+ @lang('Upload education background')</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fontawesome-demo" id="postgraduateStudies">
                            <div id="biography">
                                <div class="row" style="flex-flow: column;">
                                    <h5 class="font-weight-bold mt-5 mb-3">Postgaduate Studies:</h5>
                                    <div class="">
                                        <div id="postgraduateStudiesArea">
                                            <div class="row" id="postgraduateStudiesForm"></div>
                                        </div>
                                        <div class="addbtnArea text-right">
                                            <button type="button" id="addbtn" class="btn btn-warning">+ @lang('Add')</button>
                                        </div>
                                        <div class="addbtnArea text-right mt-5">
                                            <button type="button" id="postgraduateStudiesBtn" class="btn btn-success">+ @lang('Upload Postgraduate Studies')</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fontawesome-demo" id="updateCourses">
                            <div id="biography">
                                <div class="row" style="flex-flow: column;">
                                    <h5 class="font-weight-bold mt-5 mb-3">Update courses:</h5>
                                    <div class="">
                                        <div id="updateCoursesArea">
                                            <div class="row" id="updateCoursesForm"></div>
                                        </div>
                                        <div class="addbtnArea text-right">
                                            <button type="button" id="addbtn" class="btn btn-warning">+ @lang('Add')</button>
                                        </div>
                                        <div class="addbtnArea text-right mt-5">
                                            <button type="button" id="updateCoursesBtn" class="btn btn-success">+ @lang('Upload Update Courses')</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fontawesome-demo" id="uploadImages">
                            <div id="biography">
                                <div class="row" style="flex-flow: column;">
                                    <h5 class="font-weight-bold mt-5 mb-3">Upload Images:</h5>
                                    <div class="">
                                        <div id="uploadImnagesArea">
                                            <div class="row" id="uploadImagesForm"></div>
                                        </div>
                                        <div class="addbtnArea text-right">
                                            <button type="button" id="addbtnImage" class="btn btn-warning">+ @lang('Add')</button>
                                        </div>
                                        <div class="addbtnArea text-right mt-5">
                                            <button type="button" id="uploadImagesBtn" class="btn btn-success">+ @lang('Upload Images')</button>
                                        </div>
                                    </div>
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
        careerObjetive();
        workHistory();
        educationBackground();
        postgraduateStudies();
        upload_images();
        updateCourses();
        
        $(document).on('click', '#addbtnImage', function(event) {
            upload_images()
        });
        $(document).on('click', ".dropify-clear", function(event) {
            $(this).parents('.col-md-4').remove();
            var count = $('#uploadImnagesArea>.row>.col-md-4').length
            console.log("count", count);
            if (count == 0) {upload_images()}
        });
        $(document).on('click', '#addbtn', function(event) {
            event.preventDefault();
            var $element = $(this).parent().siblings('div').attr('id');
            //console.log("$element", $element);
            var $fistChild = $('#'+$element).children(":first").attr('id');
            //console.log("$fistChild", $fistChild);
            if ($fistChild == 'workHistoryForm') {workHistory()}
            if ($fistChild == 'educationBackgroundForm') {educationBackground()}
            if ($fistChild == 'postgraduateStudiesForm') {postgraduateStudies()}
            if ($fistChild == 'updateCoursesForm') {updateCourses()}
            
        });
        $(document).on('click', '.delBtn', function(event) {
            event.preventDefault();
            var $element = $(this).parent().parent().parent().parent().attr('id');
            console.log("$element", $element);
            var $fistChild = $('#'+$element).children(":first").attr('id');
            console.log("$fistChild", $fistChild);
            $(this).parents(".cloned").remove();
            var count = $('#'+$element).find('.cloned').length;
            console.log("count", count);
            if (count == 0) {
                if ($fistChild == 'workHistoryForm') {workHistory()}
                if ($fistChild == 'educationBackgroundForm') {educationBackground()}
                if ($fistChild == 'postgraduateStudiesForm') {postgraduateStudies()}
                if ($fistChild == 'updateCoursesForm') {updateCourses()}
            }
        });
        function summernote(element, placeholder) {
            $('.'+element).summernote({
                placeholder: placeholder,
                height: 100,
                toolbar: false,
                disableResizeEditor: true,
            })
        }
        function upload_images(){
            var dropify = '';
            dropify += '<div class="col-md-4" id="">';
            dropify += '<div class="form-group">';
            dropify += '<label for="simpleFormEmail">Image Title</label>';
            dropify += '<input type="text" class="form-control mb-2" name="image_title[]" placeholder="Image Title">';
            dropify += '<input type="file" class="form-control dropify imageFile" name="image_file[]">';
            dropify += '</div>';
            dropify += '</div>';

            $('#uploadImagesForm').append(dropify);
            $('.dropify').dropify();
        }

        function careerObjetive(){
            var careerObjetive = "";
           
            careerObjetive += '<div class="col-12">';
            careerObjetive += '<textarea name="career_objective" class="summernote-career_objective" id="career_objective" style="width: 100%;"></textarea>';
            careerObjetive += '<div class="addbtnArea text-right">';
            careerObjetive += '<button type="button" id="agregate" class="btn btn-success">+ @lang('upload info')</button>';
            careerObjetive += '</div>';
            careerObjetive += '</div>';
            careerObjetive += '<hr>';

            $('#career_objective_Form').append(careerObjetive);
            summernote("summernote-career_objective", "Career Objective")
        }

        function workHistory(){
            var workHistory = '';
            var delBtn =  '<div class="col-12" id="delbtn">'
            delBtn += '<div class="form-group text-right" id="delBtnDiv">'
            delBtn += '<button type="button" class="btn delBtn btn-danger">@lang('delete')</button>'
            delBtn += '</div>'
            delBtn += '<hr>'
            delBtn += '</div>'
            workHistory += '<div class="cloned" style="display: contents">';
            workHistory += '<div class="col-md-6">';
            workHistory += '<div class="form-group">';
            workHistory += '<label for="simpleFormEmail">Job Title</label>';
            workHistory += '<input type="text" class="form-control" name="job_titie[]" placeholder="Job Title">';
            workHistory += '</div>';
            workHistory += '</div>';
            workHistory += '<div class="col-md-6">';
            workHistory += '<div class="form-group">';
            workHistory += '<label for="simpleFormPassword">Job Company</label>';
            workHistory += '<input type="text" class="form-control" name="job_company[]" id="simpleFormPassword" placeholder="Job Company">';
            workHistory += '</div>';
            workHistory += '</div>';
            workHistory += '<div class="col-md-6">';
            workHistory += '<div class="form-group">';
            workHistory += '<label for="simpleFormEmail">From Year</label>';
            workHistory += '<input type="date" class="form-control datepicker" name="job_from_year[]" placeholder="Job Title">';
            workHistory += '</div>';
            workHistory += '</div>';
            workHistory += '<div class="col-md-6">';
            workHistory += '<div class="form-group">';
            workHistory += '<label for="simpleFormPassword">To Year</label>';
            workHistory += '<input type="date" class="form-control datepicker" name="job_to_year[]"id="simpleFormPassword" placeholder="Job Company">';
            workHistory += '</div>';
            workHistory += '</div>';
            workHistory += '<div class="col-12">';
            workHistory += '<div class="form-group">';
            workHistory += '<label for="simpleFormPassword">Notes</label>';
            workHistory += '<textarea class="form-control summernote-history-notes mb-3" id="simpleFormPassword" name="job_notes[]" style="width: 100%;"></textarea> ';
            workHistory += '</div>';
            workHistory += '</div>';
            workHistory += delBtn
            workHistory += '</div>';
            
            $('#workHistoryForm').append(workHistory);
            //$('#workHistoryForm').append(delBtn);
            summernote("summernote-history-notes", "Work History Notes")

        }
        function educationBackground(){
            var educationBackground = '';
            educationBackground += '<div class="cloned" style="display: contents">';
            educationBackground += '<div class="col-md-6">';
            educationBackground += '<div class="form-group">';
            educationBackground += '<label for="simpleFormEmail">Job Title</label>';
            educationBackground += '<input type="text" class="form-control" name="education_titie[]" placeholder="Education Title">';
            educationBackground += '</div>';
            educationBackground += '</div>';
            educationBackground += '<div class="col-md-6">';
            educationBackground += '<div class="form-group">';
            educationBackground += '<label for="simpleFormPassword">Job Company</label>';
            educationBackground += '<input type="text" class="form-control" name="education_school[]" id="simpleFormPassword" placeholder="Education Company">';
            educationBackground += '</div>';
            educationBackground += '</div>';
            educationBackground += '<div class="col-md-6">';
            educationBackground += '<div class="form-group">';
            educationBackground += '<label for="simpleFormEmail">From Year</label>';
            educationBackground += '<input type="date" class="form-control datepicker" name="education_from_year[]">';
            educationBackground += '</div>';
            educationBackground += '</div>';
            educationBackground += '<div class="col-md-6">';
            educationBackground += '<div class="form-group">';
            educationBackground += '<label for="simpleFormPassword">To Year</label>';
            educationBackground += '<input type="date" class="form-control datepicker" name="education_to_year[]"id="simpleFormPassword">';
            educationBackground += '</div>';
            educationBackground += '</div>';
            educationBackground += '<div class="col-12">';
            educationBackground += '<div class="form-group">';
            educationBackground += '<label for="simpleFormPassword">Notes</label>';
            educationBackground += '<textarea class="form-control summernote-education-notes mb-3" id="simpleFormPassword" name="education_notes[]" style="width: 100%;"></textarea> ';
            educationBackground += '</div>';
            educationBackground += '</div>';
            educationBackground += '</div>';
            var delBtn =  '<div class="col-12" id="delbtn">'
            delBtn += '<div class="form-group text-right" id="delBtnDiv">'
            delBtn += '<button type="button" class="btn delBtn btn-danger">@lang('delete')</button>'
            delBtn += '</div>'
            delBtn += '<hr>'
            delBtn += '</div>'
            $('#educationBackgroundForm').append(educationBackground);
            $('#educationBackgroundForm').append(delBtn);
            summernote("summernote-education-notes", "Educaion Notes")
        }
        function postgraduateStudies(){
            var postgraduateStudies = '';
            postgraduateStudies += '<div class="cloned" style="display: contents">';
            postgraduateStudies += '<div class="col-md-6">';
            postgraduateStudies += '<div class="form-group">';
            postgraduateStudies += '<label for="simpleFormEmail">Job Title</label>';
            postgraduateStudies += '<input type="text" class="form-control" name="postgraduate_titie[]" placeholder="Postgraduate Studies Title">';
            postgraduateStudies += '</div>';
            postgraduateStudies += '</div>';
            postgraduateStudies += '<div class="col-md-6">';
            postgraduateStudies += '<div class="form-group">';
            postgraduateStudies += '<label for="simpleFormPassword">Job Company</label>';
            postgraduateStudies += '<input type="text" class="form-control" name="postgraduate_school[]" id="simpleFormPassword" placeholder="Postgraduate Studies Company">';
            postgraduateStudies += '</div>';
            postgraduateStudies += '</div>';
            postgraduateStudies += '<div class="col-md-6">';
            postgraduateStudies += '<div class="form-group">';
            postgraduateStudies += '<label for="simpleFormEmail">From Year</label>';
            postgraduateStudies += '<input type="date" class="form-control datepicker" name="postgraduate_from_year[]">';
            postgraduateStudies += '</div>';
            postgraduateStudies += '</div>';
            postgraduateStudies += '<div class="col-md-6">';
            postgraduateStudies += '<div class="form-group">';
            postgraduateStudies += '<label for="simpleFormPassword">To Year</label>';
            postgraduateStudies += '<input type="date" class="form-control datepicker" name="postgraduate_to_year[]"id="simpleFormPassword">';
            postgraduateStudies += '</div>';
            postgraduateStudies += '</div>';
            postgraduateStudies += '<div class="col-12">';
            postgraduateStudies += '<div class="form-group">';
            postgraduateStudies += '<label for="simpleFormPassword">Notes</label>';
            postgraduateStudies += '<textarea class="form-control summernote-posgraduate-notes mb-3" id="simpleFormPassword" name="postgraduate_notes[]" style="width: 100%;"></textarea> ';
            postgraduateStudies += '</div>';
            postgraduateStudies += '</div>';
            postgraduateStudies += '</div>';
            var delBtn =  '<div class="col-12" id="delbtn">'
            delBtn += '<div class="form-group text-right" id="delBtnDiv">'
            delBtn += '<button type="button" class="btn delBtn btn-danger">@lang('delete')</button>'
            delBtn += '</div>'
            delBtn += '<hr>'
            delBtn += '</div>'
            $('#postgraduateStudiesForm').append(postgraduateStudies);
            $('#postgraduateStudiesForm').append(delBtn);
            summernote("summernote-posgraduate-notes", "Postgraduate Studies Notes")
        }
        function updateCourses(){
            var updateCourses = '';
            updateCourses += '<div class="cloned" style="display: contents">';
            updateCourses += '<div class="col-md-4">';
            updateCourses += '<div class="form-group">';
            updateCourses += '<label for="simpleFormEmail">Course Title</label>';
            updateCourses += '<input type="text" class="form-control" name="course_title[]" placeholder="Study Title">';
            updateCourses += '</div>';
            updateCourses += '</div>';
            updateCourses += '<div class="col-md-4">';
            updateCourses += '<div class="form-group">';
            updateCourses += '<label for="simpleFormPassword">Course School</label>';
            updateCourses += '<input type="text" class="form-control" name="course_school[]" id="simpleFormPassword" placeholder="Study School">';
            updateCourses += '</div>';
            updateCourses += '</div>';
            updateCourses += '<div class="col-md-4">';
            updateCourses += '<div class="form-group">';
            updateCourses += '<label for="simpleFormEmail">Year</label>';
            updateCourses += '<input type="date" class="form-control datepicker" name="course_year[]">';
            updateCourses += '</div>';
            updateCourses += '</div>';
            updateCourses += '</div>';
            var delBtn =  '<div class="col-12" id="delbtn">'
            delBtn += '<div class="form-group text-right" id="delBtnDiv">'
            delBtn += '<button type="button" class="btn delBtn btn-danger">@lang('delete')</button>'
            delBtn += '</div>'
            delBtn += '<hr>'
            delBtn += '</div>'
            $('#updateCoursesForm').append(updateCourses);
            $('#updateCoursesForm').append(delBtn);
        }
    </script>
@endsection