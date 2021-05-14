<div class="sidebar-container">
    <div class="sidemenu-container navbar-collapse collapse fixed-menu">
        <div id="remove-scroll" class="left-sidemenu">
            <ul class="sidemenu  page-header-fixed slimscroll-style" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
                <li class="sidebar-toggler-wrapper hide">
                    <div class="sidebar-toggler">
                        <span></span>
                    </div>
                </li>
                <li class="sidebar-user-panel">
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="{{ asset('staffFiles/assets/img/dp.jpg') }}" class="img-circle user-img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p> Dr. Emily</p>
                            <small>Admin</small>
                        </div>
                    </div>
                </li>
                <li class="nav-item  ">
                    <a href="{{ route('staff.dashboard') }}" class="nav-link nav-toggle"> <i class="material-icons">dashboard</i>
                        <span class="title">Dashboard</span>
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a href="#" class="nav-link nav-toggle">
                        <i class="material-icons">email</i>
                        <span class="title">Email</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item  ">
                            <a href="email_inbox.html" class="nav-link ">
                                <span class="title">Inbox</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="email_view.html" class="nav-link ">
                                <span class="title">View Mail</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="email_compose.html" class="nav-link ">
                                <span class="title">Compose Mail</span>
                            </a>
                        </li>
                    </ul>
                </li> --}}
                <li class="nav-item  ">
                    <a href="#" class="nav-link nav-toggle"><i class="material-icons">assignment</i>
                    <span class="title">Appointment</span><span class="arrow"></span></a>
                    <ul class="sub-menu">
                        <li class="nav-item  ">
                            <a href="" class="nav-link "> <span class="title">Doctor Schedule</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="book_appointment.html" class="nav-link "> <span class="title">Book Appointment</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="book_appointment_material.html" class="nav-link "> <span class="title">Book Appointment Material</span>
                            </a>
                        </li>
                         <li class="nav-item  ">
                            <a href="edit_appointment.html" class="nav-link "> <span class="title">Edit Appointment</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="view_appointment.html" class="nav-link "> <span class="title">View All Appointment</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item  ">
                    <a href="#" class="nav-link nav-toggle"> <i class="material-icons">person</i>
                        <span class="title">Doctors</span> <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item  ">
                            <a href="all_doctors.html" class="nav-link "> <span class="title">All Doctor</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="add_doctor.html" class="nav-link "> <span class="title">Add Doctor</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="add_doctor_material.html" class="nav-link "> <span class="title">Add Doctor Material</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="edit_doctor.html" class="nav-link "> <span class="title">Edit Doctor</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="doctor_profile.html" class="nav-link "> <span class="title">About Doctor</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item  ">
                    <a href="#" class="nav-link nav-toggle"> <i class="material-icons">group</i>
                        <span class="title">Other Staff</span> <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item  ">
                            <a href="all_staffs.html" class="nav-link "> <span class="title">All Staff</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="add_staff.html" class="nav-link "> <span class="title">Add Staff</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="add_staff_material.html" class="nav-link "> <span class="title">Add Staff Material</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="edit_staff.html" class="nav-link "> <span class="title">Edit Staff</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="staff_profile.html" class="nav-link "> <span class="title">Staff Profile</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item  ">
                    <a href="#" class="nav-link nav-toggle"> <i class="material-icons">accessible</i>
                        <span class="title">Patients</span> <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item  ">
                            <a href="all_patients.html" class="nav-link "> <span class="title">All Patients</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="add_patient.html" class="nav-link "> <span class="title">Add Patient</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="add_patient_material.html" class="nav-link "> <span class="title">Add Patient Material</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="edit_patient.html" class="nav-link "> <span class="title">Edit Patient</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="patient_profile.html" class="nav-link "> <span class="title">Patient Profile</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item  ">
                    <a href="#" class="nav-link nav-toggle"> <i class="material-icons">hotel</i>
                        <span class="title">Room Allotment</span> <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item  ">
                            <a href="room_allotment.html" class="nav-link "> <span class="title">Alloted Rooms</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="add_room_allotment.html" class="nav-link "> <span class="title">New Allotment</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="add_room_allotment_material.html" class="nav-link "> <span class="title">New Allotment Material</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="edit_room_allotment.html" class="nav-link "> <span class="title">Edit Allotment</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item  ">
                    <a href="#" class="nav-link nav-toggle"> <i class="material-icons">monetization_on</i>
                        <span class="title">Payments</span> <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item  ">
                            <a href="payments.html" class="nav-link "> <span class="title">Payments</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="add_payment.html" class="nav-link "> <span class="title">Add Payments</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="invoice_payment.html" class="nav-link "> <span class="title">Patient Invoice</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item  ">
                    <a href="{{ route('staff.dashboard') }}" class="nav-link nav-toggle"> <i class="material-icons">extension</i>
                        <span class="title">Configuration</span>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a href="{{ route('staff.dashboard') }}" class="nav-link nav-toggle"> <i class="material-icons">widgets</i>
                        <span class="title">Widget</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>