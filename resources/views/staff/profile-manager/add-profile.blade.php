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
                                    <form class="" id="careerObjetiveSubmit">
                                        <div id="career_objective_area">
                                            <div class="row" id="career_objective_Form"></div>
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
                                            <div class="row" id="workHistoryForm"></div>
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
                                            <div class="row" id="educationBackgroundForm"></div>
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
                                            <div class="row" id="postgraduateStudiesForm"></div>
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
                                    <h5 class="font-weight-bold mt-5 mb-3">Update courses:</h5>
                                    <form class="" id="updateCoursesSubmit">
                                        <div id="updateCoursesArea">
                                            <div class="row" id="updateCoursesForm"></div>
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
                                    <form class="" id="uploadImagesSubmit" enctype="multipart/form-data">
                                        <div id="uploadImnagesArea">
                                            <div class="row" id="uploadImagesForm"></div>
                                        </div>
                                        <div class="addbtnArea text-right">
                                            <button type="button" id="addbtnImage" class="btn btn-warning">+ @lang('Add')</button>
                                        </div>
                                        <div class="addbtnArea text-right mt-5">
                                            <button type="submit" id="uploadImagesBtn" class="btn btn-success">+ @lang('Upload Images')</button>
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
        globalUploadImages = '{{ route('staff.profile.UploadImagesPublicProfile') }}';
        globalcareerObjetive = '{{ route('staff.profile.careerObjetive ') }}';
    </script>
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
            var $fistChild = $('#'+$element).children(":first").attr('id');
            if ($fistChild == 'workHistoryForm') {workHistory()}
            if ($fistChild == 'educationBackgroundForm') {educationBackground()}
            if ($fistChild == 'postgraduateStudiesForm') {postgraduateStudies()}
            if ($fistChild == 'updateCoursesForm') {updateCourses()}   
        });
        $(document).on('click', '.delBtn', function(event) {
            event.preventDefault();
            var $element = $(this).parents('.cloned').parent().parent().attr('id');
            var $fistChild = $('#'+$element).children(":first").attr('id');
            $(this).parents(".cloned").remove();
            var count = $('#'+$element).find('.cloned').length;
            if (count == 0) {
                if ($fistChild == 'workHistoryForm') {workHistory()}
                if ($fistChild == 'educationBackgroundForm') {educationBackground()}
                if ($fistChild == 'postgraduateStudiesForm') {postgraduateStudies()}
                if ($fistChild == 'updateCoursesForm') {updateCourses()}
            }
        });
        $(document).on('keypress', 'input, textarea', function(event) {
            event.preventDefault();
            $('.error').html('');
            $('.form-group').removeClass('has-error has-danger')
        });
        $(document).on('submit', '#workHistorySubmit', function(event) {
            event.preventDefault();
            event.stopPropagation();
            event.stopImmediatePropagation();
            var formData = new FormData(this);
            var form = $(this)
            $.ajax({
                url: globalWorkHistory,
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
                    var workHistoryCount = $('#workHistoryForm > .cloned')
                    $('.error').html('');
                    $('.form-group').removeClass('has-error has-danger')
                    workHistoryCount .each(function(index, el) {
                        $(this).find('input[name*="job_title"]').attr('id', 'job_title-'+index);
                        $(this).find('input[name*="job_company"]').attr('id', 'job_company-'+index);
                        $(this).find('input[name*="job_from_year"]').attr('id', 'job_from_year-'+index);
                        $(this).find('input[name*="job_to_year"]').attr('id', 'job_to_year-'+index);
                        $(this).find('textarea[name*="job_notes"]').attr('id', 'job_notes-'+index);
                        $(this).find('note-editor').attr('id', 'job_notes-'+index)
                    });
                },
                success:function(data){
                    console.log("data", data);
                    if (!data.success) {
                        $.each( data.errors, function( key, value ) {
                            var Nkey = key.replace('.', '-')
                            $('#'+key.replace('.', '-')).parent().find('.error').text(value)
                            $('#'+key.replace('.', '-')).parent().addClass('has-error has-danger')
                        });
                        return
                     } else {
                        Toast.fire({
                              icon: data.icon,
                              title: data.title,
                        })
                     }
                },
            })
        });
        $(document).on('submit', '#educationBackgroundSubmit', function(event) {
            event.preventDefault();
            event.stopPropagation();
            event.stopImmediatePropagation();
            var formData = new FormData(this);
            var form = $(this)
            $.ajax({
                url: globalEducationBackground,
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
                    var educationBackgroundCount = $('#educationBackgroundForm > .cloned')
                    $('.error').html('');
                    $('.form-group').removeClass('has-error has-danger')
                    educationBackgroundCount .each(function(index, el) {
                        $(this).find('input[name*="education_title"]').attr('id', 'education_title-'+index);
                        $(this).find('input[name*="education_school"]').attr('id', 'education_school-'+index);
                        $(this).find('input[name*="education_from_year"]').attr('id', 'education_from_year-'+index);
                        $(this).find('input[name*="education_to_year"]').attr('id', 'education_to_year-'+index);
                        $(this).find('textarea[name*="education_notes"]').attr('id', 'education_notes-'+index);
                        $(this).find('note-editor').attr('id', 'education_notes-'+index)
                    });
                },
                success:function(data){
                    console.log("data", data);
                    if (!data.success) {
                        $.each( data.errors, function( key, value ) {
                            var Nkey = key.replace('.', '-')
                            $('#'+key.replace('.', '-')).parent().find('.error').text(value)
                            $('#'+key.replace('.', '-')).parent().addClass('has-error has-danger')
                        });
                        return
                     } else {
                        Toast.fire({
                              icon: data.icon,
                              title: data.title,
                        })
                     }
                },
            })
        });
        $(document).on('submit', '#updateCoursesSubmit', function(event) {
            event.preventDefault();
            event.stopPropagation();
            event.stopImmediatePropagation();
            var formData = new FormData(this);
            var form = $(this)
            $.ajax({
                url: globalUpdateCourses,
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
                    var updateCoursesCount = $('#postgraduateStudiesForm > .cloned')
                    $('.error').html('');
                    $('.form-group').removeClass('has-error has-danger')
                    updateCoursesCount .each(function(index, el) {
                        $(this).find('input[name*="course_title"]').attr('id', 'course_title-'+index);
                        $(this).find('input[name*="course_school"]').attr('id', 'course_school-'+index);
                        $(this).find('input[name*="course_year"]').attr('id', 'course_year-'+index);
                    });
                },
                success:function(data){
                    console.log("data", data);
                    if (!data.success) {
                        $.each( data.errors, function( key, value ) {
                            var Nkey = key.replace('.', '-')
                            $('#'+key.replace('.', '-')).parent().find('.error').text(value)
                            $('#'+key.replace('.', '-')).parent().addClass('has-error has-danger')
                        });
                        return
                     } else {
                        Toast.fire({
                              icon: data.icon,
                              title: data.title,
                        })
                     }
                },
            })
        });
        $(document).on('submit', '#updateCoursesSubmit', function(event) {
            event.preventDefault();
            event.stopPropagation();
            event.stopImmediatePropagation();
            var formData = new FormData(this);
            var form = $(this)
            $.ajax({
                url: globalUploadImages,
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
                    var updateCoursesCount = $('#postgraduateStudiesForm > .cloned')
                    $('.error').html('');
                    $('.form-group').removeClass('has-error has-danger')
                    updateCoursesCount .each(function(index, el) {
                        $(this).find('input[name*="image_title"]').attr('id', 'image_title-'+index);
                        $(this).find('input[name*="image_file"]').attr('id', 'image_file-'+index);
                    });
                },
                success:function(data){
                    console.log("data", data);
                    if (!data.success) {
                        $.each( data.errors, function( key, value ) {
                            var Nkey = key.replace('.', '-')
                            $('#'+key.replace('.', '-')).parent().find('.error').text(value)
                            $('#'+key.replace('.', '-')).parent().addClass('has-error has-danger')
                        });
                        return
                     } else {
                        Toast.fire({
                              icon: data.icon,
                              title: data.title,
                        })
                     }
                },
            })
        });

        $(document).on('submit', '#careerObjetiveSubmit', function(event) {
            event.preventDefault();
            event.stopPropagation();
            event.stopImmediatePropagation();
            var formData = new FormData(this);
            var form = $(this)
            $.ajax({
                url: globalcareerObjetive,
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
                    if (!data.success) {
                        $.each( data.errors, function( key, value ) {
                            var Nkey = key.replace('.', '-')
                            $('#'+key.replace('.', '-')).parent().find('.error').text(value)
                            $('#'+key.replace('.', '-')).parent().addClass('has-error has-danger')
                        });
                        return
                     } else {
                        Toast.fire({
                              icon: data.icon,
                              title: data.title,
                        })
                     }
                },
            })
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
            dropify += '<input type="text" class="form-control mb-2 image_title" name="image_title[]" placeholder="Image Title">';
            dropify += '<input type="file" class="form-control dropify image_file" name="image_file[]">';
            dropify += '</div>';
            dropify += '</div>';

            $('#uploadImagesForm').append(dropify);
            $('.dropify').dropify();
        }
        function careerObjetive(){
            var careerObjetive = "";
           
            careerObjetive += '<div class="col-12">';
            careerObjetive += '<textarea name="career_objective" class="summernote-career_objective career_objective" id="career_objective" style="width: 100%;"></textarea>';
            careerObjetive += '<div class="addbtnArea text-right">';
            careerObjetive += '<button type="submit" id="agregate" class="btn btn-success">+ @lang('upload info')</button>';
            careerObjetive += '</div>';
            careerObjetive += '</div>';
            careerObjetive += '<hr>';

            $('#career_objective_Form').append(careerObjetive);
            summernote("summernote-career_objective", "Career Objective")
        }
        function workHistory(){
            var delBtn =  '<div class="col-12" id="delbtn">'
            delBtn += '<div class="form-group text-right" id="delBtnDiv">'
            delBtn += '<button type="button" class="btn delBtn btn-danger">@lang('delete')</button>'
            delBtn += '</div>'
            delBtn += '<hr>'
            delBtn += '</div>'
            var workHistory = '';
            workHistory += '<div class="cloned" style="display: contents">';
            workHistory += '<div class="col-md-6">';
            workHistory += '<div class="form-group">';
            workHistory += '<label for="simpleFormEmail">Job Title</label>';
            workHistory += '<input type="text" class="form-control" name="job_title[]" placeholder="Job Title">';
            workHistory += '<div class="error text-danger"></div>';
            workHistory += '</div>';
            workHistory += '</div>';
            workHistory += '<div class="col-md-6">';
            workHistory += '<div class="form-group">';
            workHistory += '<label for="simpleFormPassword">Job Company</label>';
            workHistory += '<input type="text" class="form-control" name="job_company[]" placeholder="Job Company">';
            workHistory += '<div class="error text-danger"></div>';
            workHistory += '</div>';
            workHistory += '</div>';
            workHistory += '<div class="col-md-6">';
            workHistory += '<div class="form-group">';
            workHistory += '<label for="simpleFormEmail">From Year</label>';
            workHistory += '<input type="date" class="form-control datepicker" name="job_from_year[]" placeholder="Job Title">';
            workHistory += '<div class="error text-danger"></div>';
            workHistory += '</div>';
            workHistory += '</div>';
            workHistory += '<div class="col-md-6">';
            workHistory += '<div class="form-group">';
            workHistory += '<label for="simpleFormPassword">To Year</label>';
            workHistory += '<input type="date" class="form-control datepicker" name="job_to_year[]"id="simpleFormPassword" placeholder="Job Company">';
            workHistory += '<div class="error text-danger"></div>';
            workHistory += '</div>';
            workHistory += '</div>';
            workHistory += '<div class="col-12">';
            workHistory += '<div class="form-group">';
            workHistory += '<label for="simpleFormPassword">Notes</label>';
            workHistory += '<textarea class="form-control summernote-history-notes mb-3" name="job_notes[]" style="width: 100%;"></textarea> ';
            workHistory += '<div class="error text-danger"></div>';
            workHistory += '</div>';
            workHistory += '</div>';
            workHistory += delBtn
            workHistory += '</div>';
            
            $('#workHistoryForm').append(workHistory);
            //$('#workHistoryForm').append(delBtn);
            summernote("summernote-history-notes", "Work History Notes")
        }
        function educationBackground(){
            var delBtn =  '<div class="col-12" id="delbtn">'
            delBtn += '<div class="form-group text-right" id="delBtnDiv">'
            delBtn += '<button type="button" class="btn delBtn btn-danger">@lang('delete')</button>'
            delBtn += '</div>'
            delBtn += '<hr>'
            delBtn += '</div>'
            var educationBackground = '';
            educationBackground += '<div class="cloned" style="display: contents">';
            educationBackground += '<div class="col-md-6">';
            educationBackground += '<div class="form-group">';
            educationBackground += '<label for="education_title">Education Title</label>';
            educationBackground += '<input type="text" class="form-control education_title" name="education_title[]" placeholder="Education Title">';
            educationBackground += '<div class="error text-danger"></div>';
            educationBackground += '</div>';
            educationBackground += '</div>';
            educationBackground += '<div class="col-md-6">';
            educationBackground += '<div class="form-group">';
            educationBackground += '<label for="simpleFormPassword">Education Company</label>';
            educationBackground += '<input type="text" class="form-control education_school" name="education_school[]" id="simpleFormPassword" placeholder="Education Company">';
            educationBackground += '<div class="error text-danger"></div>';
            educationBackground += '</div>';
            educationBackground += '</div>';
            educationBackground += '<div class="col-md-6">';
            educationBackground += '<div class="form-group">';
            educationBackground += '<label for="simpleFormEmail">From Year</label>';
            educationBackground += '<input type="date" class="form-control datepicker education_from_year" name="education_from_year[]">';
            educationBackground += '<div class="error text-danger"></div>';
            educationBackground += '</div>';
            educationBackground += '</div>';
            educationBackground += '<div class="col-md-6">';
            educationBackground += '<div class="form-group">';
            educationBackground += '<label for="simpleFormPassword">To Year</label>';
            educationBackground += '<input type="date" class="form-control datepicker education_to_year" name="education_to_year[]"id="simpleFormPassword">';
            educationBackground += '<div class="error text-danger"></div>';
            educationBackground += '</div>';
            educationBackground += '</div>';
            educationBackground += '<div class="col-12">';
            educationBackground += '<div class="form-group">';
            educationBackground += '<label for="simpleFormPassword">Notes</label>';
            educationBackground += '<textarea class="form-control summernote-education-notes mb-3 education_notes" id="simpleFormPassword" name="education_notes[]" style="width: 100%;"></textarea> ';
            educationBackground += '<div class="error text-danger"></div>';
            educationBackground += '</div>';
            educationBackground += '</div>';
            educationBackground +=  delBtn
            educationBackground += '</div>';
            
            $('#educationBackgroundForm').append(educationBackground);
            summernote("summernote-education-notes", "Educaion Notes")
        }
        function postgraduateStudies(){
            var delBtn =  '<div class="col-12" id="delbtn">'
            delBtn += '<div class="form-group text-right" id="delBtnDiv">'
            delBtn += '<button type="button" class="btn delBtn btn-danger">@lang('delete')</button>'
            delBtn += '</div>'
            delBtn += '<hr>'
            delBtn += '</div>'
            var postgraduateStudies = '';
            postgraduateStudies += '<div class="cloned" style="display: contents">';
            postgraduateStudies += '<div class="col-md-6">';
            postgraduateStudies += '<div class="form-group">';
            postgraduateStudies += '<label for="simpleFormEmail">Job Title</label>';
            postgraduateStudies += '<input type="text" class="form-control postgraduate_title" name="postgraduate_title[]" placeholder="Postgraduate Studies Title">';
            postgraduateStudies += '<div class="error text-danger"></div>';
            postgraduateStudies += '</div>';
            postgraduateStudies += '</div>';
            postgraduateStudies += '<div class="col-md-6">';
            postgraduateStudies += '<div class="form-group">';
            postgraduateStudies += '<label for="simpleFormPassword">Job Company</label>';
            postgraduateStudies += '<input type="text" class="form-control postgraduate_school" name="postgraduate_school[]" id="simpleFormPassword" placeholder="Postgraduate Studies Company">';
            postgraduateStudies += '<div class="error text-danger"></div>';
            postgraduateStudies += '</div>';
            postgraduateStudies += '</div>';
            postgraduateStudies += '<div class="col-md-6">';
            postgraduateStudies += '<div class="form-group">';
            postgraduateStudies += '<label for="simpleFormEmail">From Year</label>';
            postgraduateStudies += '<input type="date" class="form-control datepicker postgraduate_from_year" name="postgraduate_from_year[]">';
            postgraduateStudies += '<div class="error text-danger"></div>';
            postgraduateStudies += '</div>';
            postgraduateStudies += '</div>';
            postgraduateStudies += '<div class="col-md-6">';
            postgraduateStudies += '<div class="form-group">';
            postgraduateStudies += '<label for="simpleFormPassword">To Year</label>';
            postgraduateStudies += '<input type="date" class="form-control datepicker postgraduate_to_year" name="postgraduate_to_year[]"id="simpleFormPassword">';
            postgraduateStudies += '<div class="error text-danger"></div>';
            postgraduateStudies += '</div>';
            postgraduateStudies += '</div>';
            postgraduateStudies += '<div class="col-12">';
            postgraduateStudies += '<div class="form-group">';
            postgraduateStudies += '<label for="simpleFormPassword">Notes</label>';
            postgraduateStudies += '<textarea class="form-control summernote-posgraduate-notes mb-3 postgraduate_notes" id="simpleFormPassword" name="postgraduate_notes[]" style="width: 100%;"></textarea> ';
            postgraduateStudies += '<div class="error text-danger"></div>';
            postgraduateStudies += '</div>';
            postgraduateStudies += '</div>';
            postgraduateStudies +=  delBtn;
            postgraduateStudies += '</div>';
            $('#postgraduateStudiesForm').append(postgraduateStudies);
            summernote("summernote-posgraduate-notes", "Postgraduate Studies Notes")
        }
        function updateCourses(){
            var delBtn =  '<div class="col-12" id="delbtn">'
            delBtn += '<div class="form-group text-right" id="delBtnDiv">'
            delBtn += '<button type="button" class="btn delBtn btn-danger">@lang('delete')</button>'
            delBtn += '</div>'
            delBtn += '<hr>'
            delBtn += '</div>'
            var updateCourses = '';
            updateCourses += '<div class="cloned" style="display: contents">';
            updateCourses += '<div class="col-md-4">';
            updateCourses += '<div class="form-group">';
            updateCourses += '<label for="simpleFormEmail">Course Title</label>';
            updateCourses += '<input type="text" class="form-control course_title" name="course_title[]" placeholder="Study Title">';
            updateCourses += '<div class="error text-danger"></div>';
            updateCourses += '</div>';
            updateCourses += '</div>';
            updateCourses += '<div class="col-md-4">';
            updateCourses += '<div class="form-group">';
            updateCourses += '<label for="simpleFormPassword">Course School</label>';
            updateCourses += '<input type="text" class="form-control course_school" name="course_school[]" id="simpleFormPassword" placeholder="Study School">';
            updateCourses += '<div class="error text-danger"></div>';
            updateCourses += '</div>';
            updateCourses += '</div>';
            updateCourses += '<div class="col-md-4">';
            updateCourses += '<div class="form-group">';
            updateCourses += '<label for="simpleFormEmail">Year</label>';
            updateCourses += '<input type="date" class="form-control datepicker course_year" name="course_year[]">';
            updateCourses += '<div class="error text-danger"></div>';
            updateCourses += '</div>';
            updateCourses += '</div>';
            updateCourses +=    delBtn
            updateCourses += '</div>';
            
            $('#updateCoursesForm').append(updateCourses);
        }
    </script>
@endsection