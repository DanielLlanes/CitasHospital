<div class="page-header navbar navbar-fixed-top">
    <div class="page-header-inner ">
        <!-- logo start -->
        <div class="page-logo">
            <a href="{{ route('staff.dashboard') }}">
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
                                    <a href="{{ Auth::guard('staff')->user()->lang == 'es' ? 'javascript:;' : route("staff.lang.lang", "es")}}">
                                        <span class="details">
                                            <img src="{{ asset('staffFiles/assets/img/flags/mexico.png') }}" alt="">
                                            <b class="pl-4 {{ Auth::guard('staff')->user()->lang == 'es' ? 'bold' : ''}}">@lang('Spanish').</b>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ Auth::guard('staff')->user()->lang == 'en' ? 'javascript:;' : route('staff.lang.lang', 'en') }}">
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
                            <ul class="dropdown-menu-list small-slimscroll-style notyNotifications" data-handle-color="#637283">
                                @if (count($notifications) > 0)
                                    @foreach ($notifications as $element)
                                        <li>
                                            <a href="javascript:;">
                                                <span class="time">{{ $element->created_at->diffForHumans() }}</span>
                                                <span class="details">
                                                <span class="notification-icon circle deepPink-bgcolor"><i class="fa fa-check"></i></span> {{ $element->message }} </span>
                                            </a>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                            <div class="dropdown-menu-footer">
                                <a href="javascript:void(0)"> All notifications </a>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- end notification dropdown -->
                <!-- start message dropdown -->

                @foreach ($debateMessages as $element)
                    
                @endforeach
                <li class="dropdown dropdown-extended dropdown-inbox" id="header_inbox_bar">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <i class="material-icons">question_answer</i>
                        {{-- <span class="notify"></span> --}}
                        {{-- <span class="heartbeat"></span> --}}
                    </a>
                    <ul class="dropdown-menu">
                        <li class="external">
                            <h3><span class="bold">Messages</span></h3>
                            <span class="notification-label cyan-bgcolor">
                                New 
                                <span id="new-messages-span">

                                </span>
                            </span>
                        </li>
                        <li>
                            <ul class="dropdown-menu-list small-slimscroll-style debateNotifications" data-handle-color="#637283">
                                @if (count($debateMessages) > 0)
                                   @foreach ($debateMessages as $message)
                                        <li>
                                            <a href="#" id="">
                                                <span class="photo">
                                                    <img src="{{ asset(getAvatar($message->debateInverseMessages->staffDebate)) }}" class="img-circle" alt=""> </span>
                                                <span class="subject">
                                                    <span class="from"> {{ $message->debateInverseMessages->staffDebate->name }} </span>
                                                    <span class="time">{{ $message->debateInverseMessages->created_at->diffForHumans() }} </span>
                                                    <br>
                                                    @if ($message->readed == 0)
                                                        <span class="read" id="msgRead"><i class="fa fa-circle text-primary" aria-hidden="true"></i> </span>
                                                    @endif
                                                    
                                                </span>
                                                <span class="message"> {!! $message->debateInverseMessages->message !!} </span>
                                            </a>
                                        </li>
                                   @endforeach
                                @endif
                            </ul>
                            <div class="dropdown-menu-footer">
                                <a href="#"> {{-- All Messages --}} </a>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- end message dropdown -->
                <!-- start manage user dropdown -->
                <li class="dropdown dropdown-user">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <img alt="{{ auth()->guard('staff')->user()->name }}" class="img-circle " src="{{ asset( getAvatar(auth()->guard('staff')->user()) ) }}" />
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
