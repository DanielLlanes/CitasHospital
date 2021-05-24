@extends('staff.layouts.app')
@section('title')
	@lang('staff.Staff')
@endsection
@section('content')

<div class="page-bar">
    <div class="page-title-breadcrumb">
        <div class=" pull-left">
            <div class="page-title">User Profile</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index-2.html">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
            </li>
            <li><a class="parent-item" href="#">UI Elements</a>&nbsp;<i class="fa fa-angle-right"></i>
            </li>
            <li class="active">User Profile</li>
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
                        <div class="profile-usertitle-job"> {{ $staff->roles[0]->Rname }} </div>
                        <div class="profile-usertitle-job"> {{ $staff->specialty->Sname }} </div>
                    </div>
                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>User Name</b> <a class="pull-right">{{ $staff->username }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Email</b> <a class="pull-right">{{ $staff->email }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Phone</b> <a class="pull-right">{{ $staff->phone }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Mobile</b> <a class="pull-right">{{ $staff->cellphone }}</a>
                        </li>
                    </ul>
                    <!-- END SIDEBAR USER TITLE -->
                    <!-- SIDEBAR BUTTONS -->
                    <div class="profile-userbuttons">
                        {{-- <button type="button" class="btn btn-circle green btn-sm">Follow</button> --}}
                        <button type="button" class="btn btn-circle red btn-sm">Message</button>
                    </div>
                    <!-- END SIDEBAR BUTTONS -->
                </div>
            </div>
            <div class="card">
                <div class="card-head ">
                    <header>Change my Password</header>
                </div>
                <div class="card-body no-padding height-9">
                    <div class="profile-desc">
                        Change your password to access the system, with at least 8 characters and easy to remember
                    </div>
                    <hr>
                    <form>
                        <div class="form-group">
                            <label for="current_password" class="col-form-label-sm">Current Password</label>
                            <input type="password" class="form-control input-sm" name="current_password" id="current_password" placeholder="Current Password">
                            <div class="error text-danger col-form-label-sm"></div>
                        </div>
                        <div class="form-group">
                            <label for="new_password" class="col-form-label-sm">New Password</label>
                            <input type="password" class="form-control input-sm" name="new_password" id="new_password" placeholder="New Password">
                            <div class="error text-danger col-form-label-sm"></div>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation" class="col-form-label-sm">Confirm new Password</label>
                            <input type="password" class="form-control input-sm" name="password_confirmation" id="password_confirmation" placeholder="New Password confirmation">
                            <div class="error text-danger col-form-label-sm"></div>
                        </div>
                        <button type="submit" id="changepasswordButton" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
            {{-- <div class="card">
                <div class="card-head ">
                    <header>About Me</header>
                </div>
                <div class="card-body no-padding height-9">
                    <div class="profile-desc">
                        Hello I am Dave Gomache a web and user interface designer. I love to work with the application interface and the web elements.
                    </div>
                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>Gender </b>
                            <div class="profile-desc-item pull-right">Male</div>
                        </li>
                        <li class="list-group-item">
                            <b>Project Done </b>
                            <div class="profile-desc-item pull-right">30+</div>
                        </li>
                        <li class="list-group-item">
                            <b>Skills</b>
                            <div class="profile-desc-item pull-right">Java,Spring</div>
                        </li>
                    </ul>
                    <div class="row list-separated profile-stat">
                        <div class="col-md-4 col-sm-4 col-xs-6">
                            <div class="uppercase profile-stat-title"> 37 </div>
                            <div class="uppercase profile-stat-text"> Projects </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-6">
                            <div class="uppercase profile-stat-title"> 51 </div>
                            <div class="uppercase profile-stat-text"> Tasks </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-6">
                            <div class="uppercase profile-stat-title"> 61 </div>
                            <div class="uppercase profile-stat-text"> Uploads </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-head ">
                    <header>Performance</header>
                </div>
                <div class="card-body no-padding height-9">
                    <ul class="performance-list">
                        <li>
                            <a href="#">
                                <i class="fa fa-circle-o" style="color:#F39C12;"></i> Total Product Sales <span class="pull-right">23456</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-circle-o" style="color:#DD4B39;"></i> Total Product Refer <span class="pull-right">$234</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-circle-o" style="color:#00A65A;"></i> Total Earn <span class="pull-right"> $345000</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card">
                <div class="card-head ">
                    <header>Work Progress</header>
                </div>
                <div class="card-body no-padding height-9">
                    <div class="work-monitor work-progress">
                        <div class="states">
                            <div class="info">
                                <div class="desc pull-left">Operations</div>
                                <div class="percent pull-right">80%</div>
                            </div>
                            <div class="progress progress-xs">
                                <div class="progress-bar progress-bar-danger progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 70%">
                                    <span class="sr-only">80% </span>
                                </div>
                            </div>
                        </div>
                        <div class="states">
                            <div class="info">
                                <div class="desc pull-left">Consultation</div>
                                <div class="percent pull-right">55%</div>
                            </div>
                            <div class="progress progress-xs">
                                <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
                                    <span class="sr-only">55% </span>
                                </div>
                            </div>
                        </div>
                        <div class="states">
                            <div class="info">
                                <div class="desc pull-left">Support</div>
                                <div class="percent pull-right">20%</div>
                            </div>
                            <div class="progress progress-xs">
                                <div class="progress-bar progress-bar-warning progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 35%">
                                    <span class="sr-only">20% </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
        <!-- END BEGIN PROFILE SIDEBAR -->
        <!-- BEGIN PROFILE CONTENT -->
        <div class="profile-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-head ">
                            <header>{{-- User Activity --}}</header>
                        </div>
                        <div class="card-body no-padding height-9">
                            <div class="container-fluid">{{--
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="panel">
                                            <form>
                                                <textarea class="form-control p-text-area" rows="4" placeholder="Whats in your mind today?"></textarea>
                                            </form>
                                            <footer class="panel-footer">
                                                <button class="btn btn-post pull-right">Post</button>
                                                <ul class="nav nav-pills p-option">
                                                    <li>
                                                        <a href="#"><i class="fa fa-user"></i></a>
                                                    </li>
                                                    <li>
                                                        <a href="#"><i class="fa fa-camera"></i></a>
                                                    </li>
                                                    <li>
                                                        <a href="#"><i class="fa  fa-location-arrow"></i></a>
                                                    </li>
                                                    <li>
                                                        <a href="#"><i class="fa fa-meh-o"></i></a>
                                                    </li>
                                                </ul>
                                            </footer>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <ul class="activity-list">
                                            <li>
                                                <div class="avatar">
                                                    <img src="../assets/img/user/user1.jpg" alt="" />
                                                </div>
                                                <div class="activity-desk">
                                                    <h5><a href="#">Rajesh</a> <span>Uploaded 5 new photos</span></h5>
                                                    <p class="text-muted">7 minutes ago near Alaska, USA</p>
                                                    <div class="album">
                                                        <a href="#">
                                                            <img alt="" src="../assets/img/mega-img1.jpg">
                                                        </a>
                                                        <a href="#">
                                                            <img alt="" src="../assets/img/mega-img2.jpg">
                                                        </a>
                                                        <a href="#">
                                                            <img alt="" src="../assets/img/mega-img3.jpg">
                                                        </a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="avatar">
                                                    <img src="../assets/img/user/user2.jpg" alt="" />
                                                </div>
                                                <div class="activity-desk">
                                                    <h5><a href="#">Sarah Smith</a> <span>Completed the Sight visit.</span></h5>
                                                    <p class="text-muted">2 minutes ago near Alaska, USA</p>
                                                    <div class="location-map">
                                                        <div id="map-canvas"></div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="avatar">
                                                    <img src="../assets/img/user/user3.jpg" alt="" />
                                                </div>
                                                <div class="activity-desk">
                                                    <h5><a href="#">John Doe</a> <span>attended a meeting with</span>
                                                                    <a href="#">Lina Smith.</a></h5>
                                                    <p class="text-muted">2 days ago near Alaska, USA</p>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="avatar">
                                                    <img src="../assets/img/user/user4.jpg" alt="" />
                                                </div>
                                                <div class="activity-desk">
                                                    <h5><a href="#">Kehn Anderson</a> <span>completed the task “wireframe design” within the dead line</span></h5>
                                                    <p class="text-muted">4 days ago near Alaska, USA</p>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="avatar">
                                                    <img src="../assets/img/user/user5.jpg" alt="" />
                                                </div>
                                                <div class="activity-desk">
                                                    <h5><a href="#">Jacob Ryan</a> <span>was absent office due to sickness</span></h5>
                                                    <p class="text-muted">4 days ago near Alaska, USA</p>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div> --}}
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