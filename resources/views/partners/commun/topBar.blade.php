<div class="page-header navbar navbar-fixed-top">
    <div class="page-header-inner ">
        <!-- logo start -->
        <div class="page-logo">
            <a href="{{ route('partners.dashboard') }}">
                {{-- <img alt="" src="{{ asset('partnerFiles/assets/img/logo.png') }}"> --}}
                <span class="logo-default" >J.L. Partners</span>
            </a>
        </div>
        <!-- logo end -->
        <ul class="nav navbar-nav navbar-left in">
            <li><a href="#" class="menu-toggler sidebar-toggler font-size-20"><i class="fa fa-exchange" aria-hidden="true"></i></a></li>
        </ul>
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
                <li class="dropdown dropdown-user">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <img alt="{{ auth()->guard('partners')->user()->name }}" class="img-circle " src="{{ asset( getAvatarCached(auth()->guard('partners')->user(), 'avatar') ) }}" />
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default">
                       {{--  <li>
                            <a href="{{ route('partners.profile.profile') }}">
                                <i class="fa fa-user"></i> @lang('Profile') </a>
                        </li> --}}
                        <li>
                            <a href="{{ route('partners.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out"></i> @lang('Log Out')
                            </a>
                        </li>
                    </ul>
                </li>
                <form id="logout-form" action="{{ route('partners.logout') }}" method="POST" style="display: none;">
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
