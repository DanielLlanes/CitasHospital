<div class="page-header navbar navbar-fixed-top">
    <div class="page-header-inner ">
        <!-- logo start -->
        <div class="page-logo">
            <a href="{{ route('staff.dashboards') }}">
                {{-- <img alt="" src="{{ asset('staffFiles/assets/img/logo.png') }}"> --}}
                <span class="logo-default" >{{ str_replace('_', " ", config('app.name', 'Laravel')) }}</span>
            </a>
        </div>
        <!-- logo end -->
        <ul class="nav navbar-nav navbar-left in">
            <li><a href="#" class="menu-toggler sidebar-toggler font-size-20"><i class="fa fa-exchange" aria-hidden="true"></i></a></li>
        </ul>

         {{-- <ul class="nav navbar-nav navbar-left in">
            <li class="dropdown dropdown-extended dropdown-notification" >
                    <a href="javascript:;" class="dropdown-toggle app-list-icon font-size-20" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <i class="fa fa-th" aria-hidden="true"></i>
                    </a>
                    <ul class="dropdown-menu app-icon">
                        <li class="app-dropdown-header">
                            <p><span class="bold">Applications</span></p>
                        </li>
                        <li>
                            <ul class="dropdown-menu-list app-icon-dropdown" data-handle-color="#637283">
                                <li>
                                    <a href="add_patient.html" class="patient-icon">
                                    <i class="material-icons">local_hotel</i>
                                    <span class="block">Add Patient</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="email_inbox.html" class="email-icon">
                                    <i class="material-icons">drafts</i>
                                    <span class="block">Email</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="view_appointment.html" class="appoint-icon">
                                    <i class="material-icons">assignment</i>
                                    <span class="block">Appointment</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="all_doctors.html" class="doctor-icon">
                                    <i class="material-icons">people</i>
                                    <span class="block">Doctors</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="google_maps.html" class="map-icon">
                                    <i class="material-icons">map</i>
                                    <span class="block">Map</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="payments.html" class="payment-icon">
                                    <i class="material-icons">monetization_on</i>
                                    <span class="block">Payments</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
        </ul> --}}
        <ul class="nav navbar-nav navbar-left in">
            <!-- start full screen button -->
            <li><a href="javascript:;" class="fullscreen-click font-size-20"><i class="fa fa-arrows-alt"></i></a></li>
            <!-- end full screen button -->
        </ul>
        <!-- start mobile menu -->
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
            <span></span>
        </a>
       <!-- end mobile menu -->
        <!-- start header menu -->
        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">
                <!-- start notification dropdown -->
                <li class="dropdown dropdown-extended dropdown-notification" >
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <i class="material-icons f-left">flag</i>
                        <span class="notify"></span>
                        <span class="heartbeat"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="external">
                            <h3><span class="bold">@lang('select Language')</span></h3>
                            {{-- <span class="notification-label purple-bgcolor">New 6</span> --}}
                        </li>
                        <li>
                            <ul class="dropdown-menu-list small-slimscroll-style" data-handle-color="#637283" style="height: auto;">
                                <li>
                                    <a href="{{ Auth::guard('staff')->user()->lang == 'es' ? 'javascript:;' : route("staff.lang.update", "es")}}">
                                        <span class="details">
                                            <img src="{{ asset('staffFiles/assets/img/flags/mexico.png') }}" alt="">
                                            <b class="pl-4 {{ Auth::guard('staff')->user()->lang == 'es' ? 'bold' : ''}}">@lang('Spanish').</b>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ Auth::guard('staff')->user()->lang == 'en' ? 'javascript:;' : route('staff.lang.update', 'en') }}">
                                        <span class="details">
                                        <img src="{{ asset('staffFiles/assets/img/flags/estados-unidos.png') }}" alt="">
                                            <b class="pl-4 {{ Auth::guard('staff')->user()->lang == 'en' ? 'bold' : ''}}">@lang('English').</b>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="dropdown dropdown-extended dropdown-notification" >
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <i class="material-icons">notifications</i>
                        <span class="notify"></span>
                        <span class="heartbeat"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="external">
                            <h3><span class="bold">Notifications</span></h3>
                            <span class="notification-label purple-bgcolor">New 6</span>
                        </li>
                        <li>
                            <ul class="dropdown-menu-list small-slimscroll-style" data-handle-color="#637283">
                                <li>
                                    <a href="javascript:;">
                                        <span class="time">just now</span>
                                        <span class="details">
                                        <span class="notification-icon circle deepPink-bgcolor"><i class="fa fa-check"></i></span> Congratulations!. </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:;">
                                        <span class="time">3 mins</span>
                                        <span class="details">
                                        <span class="notification-icon circle purple-bgcolor"><i class="fa fa-user o"></i></span>
                                        <b>John Micle </b>is now following you. </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:;">
                                        <span class="time">7 mins</span>
                                        <span class="details">
                                        <span class="notification-icon circle blue-bgcolor"><i class="fa fa-comments-o"></i></span>
                                        <b>Sneha Jogi </b>sent you a message. </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:;">
                                        <span class="time">12 mins</span>
                                        <span class="details">
                                        <span class="notification-icon circle pink"><i class="fa fa-heart"></i></span>
                                        <b>Ravi Patel </b>like your photo. </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:;">
                                        <span class="time">15 mins</span>
                                        <span class="details">
                                        <span class="notification-icon circle yellow"><i class="fa fa-warning"></i></span> Warning! </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:;">
                                        <span class="time">10 hrs</span>
                                        <span class="details">
                                        <span class="notification-icon circle red"><i class="fa fa-times"></i></span> Application error. </span>
                                    </a>
                                </li>
                            </ul>
                            <div class="dropdown-menu-footer">
                                <a href="javascript:void(0)"> All notifications </a>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- end notification dropdown -->
                <!-- start message dropdown -->
                <li class="dropdown dropdown-extended dropdown-inbox" id="header_inbox_bar">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <i class="material-icons">question_answer</i>
                        <span class="notify"></span>
                        <span class="heartbeat"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="external">
                            <h3><span class="bold">Messages</span></h3>
                            <span class="notification-label cyan-bgcolor">New 2</span>
                        </li>
                        <li>
                            <ul class="dropdown-menu-list small-slimscroll-style" data-handle-color="#637283">
                                <li>
                                    <a href="#">
                                        <span class="photo">
                                            <img src="{{ asset('staffFiles/assets/img/doc/doc2.jpg') }}" class="img-circle" alt=""> </span>
                                        <span class="subject">
                                            <span class="from"> Sarah Smith </span>
                                            <span class="time">Just Now </span>
                                        </span>
                                        <span class="message"> Jatin I found you on LinkedIn... </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="photo">
                                            <img src="{{ asset('staffFiles/assets/img/doc/doc3.jpg') }}" class="img-circle" alt=""> </span>
                                        <span class="subject">
                                            <span class="from"> John Deo </span>
                                            <span class="time">16 mins </span>
                                        </span>
                                        <span class="message"> Fwd: Important Notice Regarding Your Domain Name... </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="photo">
                                            <img src="{{ asset('staffFiles/assets/img/doc/doc1.jpg') }}" class="img-circle" alt=""> </span>
                                        <span class="subject">
                                            <span class="from"> Rajesh </span>
                                            <span class="time">2 hrs </span>
                                        </span>
                                        <span class="message"> pls take a print of attachments. </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="photo">
                                            <img src="{{ asset('staffFiles/assets/img/doc/doc8.jpg') }}" class="img-circle" alt=""> </span>
                                        <span class="subject">
                                            <span class="from"> Lina Smith </span>
                                            <span class="time">40 mins </span>
                                        </span>
                                        <span class="message"> Apply for Ortho Surgeon </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="photo">
                                            <img src="{{ asset('staffFiles/assets/img/doc/doc5.jpg') }}" class="img-circle" alt=""> </span>
                                        <span class="subject">
                                            <span class="from"> Jacob Ryan </span>
                                            <span class="time">46 mins </span>
                                        </span>
                                        <span class="message"> Request for leave application. </span>
                                    </a>
                                </li>
                            </ul>
                            <div class="dropdown-menu-footer">
                                <a href="#"> All Messages </a>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- end message dropdown -->
                <!-- start manage user dropdown -->
                <li class="dropdown dropdown-user">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <img alt="" class="img-circle " src="{{ asset( auth()->guard('staff')->user()->avatar )}}" />
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default">
                        <li>
                            <a href="{{ route('staff.profile.profile') }}">
                                <i class="fa fa-user"></i> @lang('Profile') </a>
                        </li>
                        {{-- <li>
                            <a href="#">
                                <i class="fa fa-cogs"></i> Settings
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-question-circle"></i> Help
                            </a>
                        </li>
                        <li class="divider"> </li>
                        <li>
                            <a href="lock_screen.html">
                                <i class="fa fa-lock"></i> Lock
                            </a>
                        </li> --}}
                        <li>
                            <a href="{{ route('staff.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out"></i> @lang('Log Out')
                            </a>
                        </li>
                    </ul>
                </li>
                <form id="logout-form" action="{{ route('staff.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <!-- end manage user dropdown -->
                <li class="dropdown dropdown-quick-sidebar-toggler">
                     <a id="headerSettingButton" class="mdl-button mdl-js-button mdl-button--icon pull-right" data-upgraded=",MaterialButton">
                       <i class="material-icons">settings</i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
