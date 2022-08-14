
    <div class="sidemenu-container navbar-collapse collapse fixed-menu">
        <div id="remove-scroll" class="left-sidemenu">
            <ul class="sidemenu page-header-fixed slimscroll-style" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
                <li class="sidebar-toggler-wrapper hide">
                    <div class="sidebar-toggler">
                        <span></span>
                    </div>
                </li>
                <li class="sidebar-user-panel">
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="{{ asset( getAvatarCached(auth()->guard('partners')->user(), 'avatar') ) }}" class="img-circle user-img-circle" alt="{{ auth()->guard('partners')->user()->name }}" />
                        </div>
                        <div class="pull-left info">
                            <p> {{ auth()->guard('partners')->user()->name }}</p>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="{{ route('partners.dashboard') }}" class="nav-link nav-toggle"> <i class="material-icons">dashboard</i>
                        <span class="title">@lang('Dashboard')</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
