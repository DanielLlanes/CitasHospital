
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
                            <img src="{{ asset( getAvatarCached(auth()->guard('staff')->user(), 'avatar') ) }}" class="img-circle user-img-circle" alt="{{ auth()->guard('staff')->user()->name }}" />
                        </div>
                        <div class="pull-left info">
                            <p> {{ auth()->guard('staff')->user()->name }}</p>
                            @php
                                $roles = Auth::guard('staff')->user()->roles
                            @endphp
                            @foreach($roles as $rol)
                               <small>{{ Auth::guard('staff')->user()->lang == 'es' ? $rol->name_es : $rol->name_en }}</small>
                            @endforeach
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="{{ route('staff.dashboard') }}" class="nav-link nav-toggle"> <i class="material-icons">dashboard</i>
                        <span class="title">@lang('Dashboard')</span>
                    </a>
                </li>
                @can('applications.list')
                    <li class="nav-item">
                        <a href="{{ route('staff.applications.application') }}" class="nav-link nav-toggle"> <i class="material-icons">view_list</i>
                            <span class="title">@lang('Applications')</span>
                        </a>
                    </li>
                @endcan
                @can('treatment.list')  
                    <li class="nav-item  ">
                        <a href="{{ route('staff.treatments.treatments') }}" class="nav-link nav-toggle"> <i class="material-icons">shopping_cart</i>
                            <span class="title">@lang('Treatment')</span>
                        </a>
                    </li>
                @endcan
                @can('calendar.list')  
                    <li class="nav-item  ">
                        <a href="{{ route('staff.events.events') }}" class="nav-link nav-toggle"> <i class="material-icons">event_available</i>
                            <span class="title">@lang('Calendar')</span>
                        </a>
                    </li>
                @endcan
                <li class="nav-item  ">
                    <a href="#" class="nav-link nav-toggle"> <i class="material-icons">group</i>
                        <span class="title">@lang('Staff') </span> <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        @if (Auth::guard('staff')->user()->can('staff.list.admins') || Auth::guard('staff')->user()->can('staff.list'))

                            <li class="nav-item  ">
                                <a href="{{ route('staff.staff.staff') }}" class="nav-link "> <span class="title">@lang('All Staff') </span>
                                </a>
                            </li>
                        @endif
                        @if (Auth::guard('staff')->user()->can('staff.create.admins') || Auth::guard('staff')->user()->can('staff.create'))
                            <li class="nav-item  ">
                                <a href="{{ route('staff.staff.add') }}" class="nav-link "> <span class="title">@lang('Add Staff') </span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link nav-toggle"> <i class="material-icons">accessible</i>
                        <span class="title">@lang('Patients') </span> <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        @can('patient.list')
                            <li class="nav-item  ">
                                <a href="{{ route('staff.patients.patient') }}" class="nav-link "> <span class="title">@lang('All Patients') </span>
                                </a>
                            </li>
                        @endcan
                        @can('patient.edit')
                            <li class="nav-item  ">
                                <a href="{{ route('staff.patients.add') }}" class="nav-link "> <span class="title">@lang('Add Patient') </span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link nav-toggle"> <i class="material-icons">attach_money</i>
                        <span class="title">@lang("Payments") </span> <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                    @can('payments.list')
                        <li class="nav-item  ">
                            <a href="{{ route('staff.payments.payments') }}"  class="nav-link "> <span class="title">@lang("All Payments") </span>
                            </a>
                        </li>
                    @endcan
                    </ul>
                </li>

                <li class="nav-item master-menu">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="material-icons">settings</i>
                        <span class="title">Configuration</span>
                        <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-product-hunt"></i> Treatments
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                @can('brand.list')
                                    <li class="nav-item">
                                        <a href="{{ route('staff.treatments.configuration.brand') }}" class="nav-link">
                                            <i class="ml-3"></i> Brand</a>
                                    </li>
                                @endcan
                                @can('services.list')
                                    <li class="nav-item">
                                        <a href="{{ route('staff.treatments.configuration.service') }}" class="nav-link">
                                            <i class="ml-3"></i> Services</a>
                                    </li>
                                @endcan
                                @can('procedures.list')
                                    <li class="nav-item">
                                        <a href="{{ route('staff.treatments.configuration.procedure') }}" class="nav-link">
                                            <i class="ml-3"></i> Procedures
                                         </a>
                                    </li>
                                @endcan
                                @can('packages.list')
                                    <li class="nav-item">
                                        <a href="{{ route('staff.treatments.configuration.package') }}" class="nav-link">
                                            <i class="ml-3"></i> Packages
                                         </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-cogs"></i> Roles & Permissions
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                @can('roles.list')
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="ml-3"></i> Roles</a>
                                    </li>
                                @endcan
                                @can('permission.list')
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="ml-3"></i> Permissions</a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    </ul>
                </li>

                <li class="nav-item master-menu">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="material-icons">settings</i>
                        <span class="title">Settings</span>
                        <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-product-hunt"></i> Public page
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                @can('brand.list')
                                    <li class="nav-item">
                                        <a href="{{ route('staff.public_page.slider') }}" class="nav-link">
                                            <i class="ml-3"></i> Slider
                                        </a>
                                    </li>
                                @endcan
                                {{-- @can('services.list')
                                    <li class="nav-item">
                                        <a href="{{ route('staff.treatments.configuration.service') }}" class="nav-link">
                                            <i class="ml-3"></i> Services</a>
                                    </li>
                                @endcan
                                @can('procedures.list')
                                    <li class="nav-item">
                                        <a href="{{ route('staff.treatments.configuration.procedure') }}" class="nav-link">
                                            <i class="ml-3"></i> Procedures
                                         </a>
                                    </li>
                                @endcan
                                @can('packages.list')
                                    <li class="nav-item">
                                        <a href="{{ route('staff.treatments.configuration.package') }}" class="nav-link">
                                            <i class="ml-3"></i> Packages
                                         </a>
                                    </li>
                                @endcan --}}
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
