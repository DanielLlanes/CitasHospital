
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
                        <span class="title">@lang('aside.Dashboard')</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link nav-toggle"><i class="material-icons">assignment</i>
                    <span class="title">@lang('aside.Appointment') </span><span class="arrow"></span></a>
                    <ul class="sub-menu">
                        @can('calendar.list')
                            <li class="nav-item">
                                <a href="{{ route('staff.events.events') }}" class="nav-link "> <span class="title">@lang('aside.Doctor Schedule') </span>
                                </a>
                            </li>
                        @endcan
                        {{-- <li class="nav-item  ">
                            <a href="book_appointment.html" class="nav-link "> <span class="title">@lang('aside.Book Appointment') </span>
                            </a>
                        </li>
                         <li class="nav-item  ">
                            <a href="edit_appointment.html" class="nav-link "> <span class="title">@lang('aside.Edit Appointment') </span>
                            </a>
                        </li> --}}
                        <li class="nav-item  ">
                            <a href="view_appointment.html" class="nav-link "> <span class="title">@lang('aside.View All my Appointments') </span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item  ">
                    <a href="#" class="nav-link nav-toggle"> <i class="material-icons">group</i>
                        <span class="title">@lang('aside.Staff') </span> <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        @can('staff.list')
                            <li class="nav-item  ">
                                <a href="{{ route('staff.staff.staff') }}" class="nav-link "> <span class="title">@lang('aside.All Staff') </span>
                                </a>
                            </li>
                        @endcan
                        @can('staff.create')
                            <li class="nav-item  ">
                                <a href="{{ route('staff.staff.add') }}" class="nav-link "> <span class="title">@lang('aside.Add Staff') </span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link nav-toggle"> <i class="material-icons">accessible</i>
                        <span class="title">@lang('aside.Patients') </span> <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item  ">
                            <a href="all_patients.html" class="nav-link "> <span class="title">@lang('aside.All Patients') </span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="add_patient.html" class="nav-link "> <span class="title">@lang('aside.Add Patient') </span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="edit_patient.html" class="nav-link "> <span class="title">@lang('aside.Edit Patient') </span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="patient_profile.html" class="nav-link "> <span class="title">@lang('aside.Patient Profile') </span>
                            </a>
                        </li>
                    </ul>
                </li>
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
                <li class="nav-item">
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
                </li>

                <li class="nav-item">
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
                </li>
                <li class="nav-item  ">
                    <a href="#" class="nav-link nav-toggle"> <i class="material-icons">widgets</i>
                        <span class="title">@lang("Widget") </span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
