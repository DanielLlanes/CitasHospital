
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
                            <img src="{{ asset( auth()->guard('staff')->user()->avatar )}}" class="img-circle user-img-circle" alt="User Image" />
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
                <li class="nav-item">
                    <a href="#" class="nav-link nav-toggle"><i class="material-icons">assignment</i>
                    <span class="title">@lang('Appointment') </span><span class="arrow"></span></a>
                    <ul class="sub-menu">
                        @can('calendar.list')
                            <li class="nav-item">
                                <a href="{{ route('staff.events.events') }}" class="nav-link "> <span class="title">@lang('Doctor Schedule') </span>
                                </a>
                            </li>
                        @endcan
                        <li class="nav-item  ">
                            <a href="view_appointment.html" class="nav-link "> <span class="title">@lang('View All my Appointments') </span>
                            </a>
                        </li>
                    </ul>
                </li>
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

                {{-- <li class="nav-item">
                    <a href="#" class="nav-link nav-toggle"> <i class="material-icons">accessible</i>
                        <span class="title">@lang('Patients') </span> <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item  ">
                            <a href="all_patients.html" class="nav-link "> <span class="title">@lang('All Patients') </span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="add_patient.html" class="nav-link "> <span class="title">@lang('Add Patient') </span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="edit_patient.html" class="nav-link "> <span class="title">@lang('Edit Patient') </span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="patient_profile.html" class="nav-link "> <span class="title">@lang('Patient Profile') </span>
                            </a>
                        </li>
                    </ul>
                </li> --}}

                {{-- <li class="nav-item  ">
                    <a href="#" class="nav-link nav-toggle"> <i class="material-icons">hotel</i>
                        <span class="title">@lang("Room Allotment") </span> <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item  ">
                            <a href="room_allotment.html" class="nav-link "> <span class="title">@lang("Alloted Rooms") </span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="add_room_allotment.html" class="nav-link "> <span class="title">@lang("New Allotment") </span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="edit_room_allotment.html" class="nav-link "> <span class="title">@lang("Edit Allotment") </span>
                            </a>
                        </li>
                    </ul>
                </li> --}}

                {{-- <li class="nav-item">
                    <a href="#" class="nav-link nav-toggle"> <i class="material-icons">local_parking</i>
                        <span class="title">@lang("Products") </span> <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item  ">
                            <a href="{{ route('staff.products.brand') }}" class="nav-link "> <span class="title">@lang("Brand") </span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="{{ route('staff.products.service') }}" class="nav-link "> <span class="title">@lang("Services") </span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="{{ route('staff.products.procedure') }}" class="nav-link "> <span class="title">@lang("Procedures") </span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="{{ route('staff.products.package') }}" class="nav-link "> <span class="title">@lang("Packages") </span>
                            </a>
                        </li>
                    </ul>
                </li> --}}
                <li class="nav-item  ">
                    <a href="{{ route('staff.products.products') }}" class="nav-link nav-toggle"> <i class="material-icons">shopping_cart</i>
                        <span class="title">Products</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="material-icons">settings</i>
                        <span class="title">Configuration</span>
                        <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu">
                        {{-- <li class="nav-item">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-university"></i> Item 1
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item">
                                    <a href="javascript:;" class="nav-link nav-toggle">
                                        <i class="fa fa-bell-o"></i> Arrow Toggle
                                        <span class="arrow "></span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="nav-item">
                                            <a href="javascript:;" class="nav-link">
                                                <i class="fa fa-calculator"></i> Sample Link 1</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="fa fa-clone"></i> Sample Link 2</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="fa fa-cogs"></i> Sample Link 3</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="fa fa-file-pdf-o"></i> Sample Link 1</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="fa fa-rss"></i> Sample Link 2</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="fa fa-hdd-o"></i> Sample Link 3</a>
                                </li>
                            </ul>
                        </li> --}}
                        <li class="nav-item">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-product-hunt"></i> Products
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item">
                                    <a href="{{ route('staff.products.configuration.brand') }}" class="nav-link">
                                        <i class="ml-3"></i> Brand</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('staff.products.configuration.service') }}" class="nav-link">
                                        <i class="ml-3"></i> Services</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('staff.products.configuration.procedure') }}" class="nav-link">
                                        <i class="ml-3"></i> Procedures
                                     </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('staff.products.configuration.package') }}" class="nav-link">
                                        <i class="ml-3"></i> Packages
                                     </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fa fa-volume-up"></i> Item 3 </a>
                        </li>
                    </ul>
                </li>

                {{-- <li class="nav-item">
                    <a href="#" class="nav-link nav-toggle"> <i class="material-icons">monetization_on</i>
                        <span class="title">@lang("Payments") </span> <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item  ">
                            <a href="payments.html" class="nav-link "> <span class="title">@lang("Payments") </span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="add_payment.html" class="nav-link "> <span class="title">@lang("Add Payments") </span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="invoice_payment.html" class="nav-link "> <span class="title">@lang("Patient Invoice") </span>
                            </a>
                        </li>
                    </ul>
                </li> --}}

                {{-- <li class="nav-item">
                    <a href="#" class="nav-link nav-toggle"> <i class="material-icons">extension</i>
                        <span class="title">@lang("Configuration") </span> <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item  ">
                            <a href="payments.html" class="nav-link "> <span class="title">Pasarelas de pago </span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="invoice_payment.html" class="nav-link "> <span class="title">Roles </span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="invoice_payment.html" class="nav-link "> <span class="title">Permisos </span>
                            </a>
                        </li>
                    </ul>
                </li> --}}

                {{-- <li class="nav-item  ">
                    <a href="#" class="nav-link nav-toggle"> <i class="material-icons">widgets</i>
                        <span class="title">@lang("Widget") </span>
                    </a>
                </li> --}}

            </ul>
        </div>
    </div>
