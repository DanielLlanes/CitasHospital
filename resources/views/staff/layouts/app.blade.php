<!DOCTYPE html>
@php
    \App::setLocale(Auth::guard('staff')->user()->lang);
@endphp
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta name="description" content="Staff JlPrado" />
    <meta name="author" content="Sunray" />
    <title>{{ str_replace('_', " ", config('app.name', 'Laravel')) }} | @yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- google font -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet" type="text/css" />
    <!-- icons -->
    <link href="{{ asset('staffFiles/assets/plugins/font-awesome/css/font-awesome.css') }}" rel="stylesheet" >
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css" />
    <!--bootstrap -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('staffFiles/assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('staffFiles/assets/css/pages/formlayout.css') }}" rel="stylesheet" >
    <!-- Material Design Lite CSS -->
    <link href="{{ asset('staffFiles/assets/plugins/material/material.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('staffFiles/assets/css/material_style.css') }}" rel="stylesheet" type="text/css" />
    <!-- morris chart -->
    <link href="{{ asset('staffFiles/assets/plugins/morris/morris.css') }}" rel="stylesheet" type="text/css" />
    <!-- Drppify -->
    <link href="{{ asset('staffFiles/assets/plugins/dropify/dist/css/dropify.min.css') }}" rel="stylesheet" type="text/css">
    <!-- Theme Styles -->
    <link href="{{ asset('staffFiles/assets/css/style.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('staffFiles/assets/css/plugins.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('staffFiles/assets/css/responsive.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('staffFiles/assets/css/theme-color.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('staffFiles/assets/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('staffFiles/assets/css/tableButtons.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('staffFiles/assets/plugins/dropify/dist/css/dropify.min.css') }}" rel="stylesheet">

    <style type="text/css">
        .swal2-title{
            font-size: .8rem!important;
        }
    </style>
    @yield('styles')

    <!-- favicon -->
</head>
<body class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white dark-color logo-dark">
    <div class="page-wrapper">
        <!-- start header -->
        <div class="page-header navbar navbar-fixed-top" style="">
            @include('staff.commun.topBar')
        </div>
        <!-- end header -->
        <!-- start page container -->
        <div class="page-container">
            <!-- start sidebar menu -->
            @include('staff.commun.aside')
             <!-- end sidebar menu -->
            <!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-content">
                    @yield('content')
                </div>
            </div>
            <!-- end page content -->
            <!-- start chat sidebar -->
            <div class="chat-sidebar-container" data-close-on-body-click="false">
                @include('staff.commun.configPanel')
            </div>
            <!-- end chat sidebar -->
        </div>
        <!-- end page container -->
        <!-- start footer -->
        <div class="page-footer">
            @include('staff.commun.footer')
        </div>
        <!-- end footer -->
    </div>
        <!-- start js include path -->
        <script src="{{ asset('staffFiles/assets/plugins/jquery/jquery.min.js') }}" ></script>
        <!-- <script src="{{ asset('staffFiles/assets/plugins/popper/popper.min.js') }}" ></script> -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="{{ asset('staffFiles/assets/plugins/jquery-blockui/jquery.blockui.min.js') }}" ></script>
        <script src="{{ asset('staffFiles/assets/plugins/jquery-slimscroll/jquery.slimscroll.js') }}"></script>
        <!-- bootstrap -->
        <script src="{{ asset('staffFiles/assets/plugins/bootstrap/js/bootstrap.min.js') }}" ></script>

        <!-- counterup -->
        <script src="{{ asset('staffFiles/assets/plugins/counterup/jquery.waypoints.min.js') }}" ></script>
        <script src="{{ asset('staffFiles/assets/plugins/counterup/jquery.counterup.min.js') }}" ></script>
        <!-- Common js-->
        <script src="{{ asset('staffFiles/assets/js/app.js') }}" ></script>
        <script src="{{ asset('staffFiles/assets/js/layout.js') }}" ></script>
        <script src="{{ asset('staffFiles/assets/js/theme-color.js') }}" ></script>
        <!-- material -->
        <script src="{{ asset('staffFiles/assets/plugins/material/material.min.js') }}"></script>
        <!-- morris chart -->
        <script src="{{ asset('staffFiles/assets/plugins/morris/morris.min.js') }}" ></script>
        <script src="{{ asset('staffFiles/assets/plugins/morris/raphael-min.js') }}" ></script>
        <script src="{{ asset('staffFiles/assets/plugins/sweetalert/sweetalert2.js') }}"></script>
        <!-- Drppify -->
        <script src="{{ asset('staffFiles/assets/plugins/dropify/dist/js/dropify.min.js') }}"></script>
        {{-- <script src="{{ asset('staffFiles/assets/js/pages/chart/morris/morris-home-data.js') }}" ></script> --}}
        <!-- end js include path -->
        {{-- plugins Langs --}}
        <script>
            var dataTablesLangEs;
            var lang = '{{\Auth::guard('staff')->user()->lang}}'
            if (lang == 'es') {
                dataTablesLangEs =  "{{ asset('/lang/datatable-es.json') }}"
            }
        </script>
        <script>
            const Toast = Swal.mixin({
              toast: true,
              position: 'top-end',
              showConfirmButton: false,
              timer: 3000,
              timerProgressBar: true,
              didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
              }
            })
        </script>
        @yield('scripts')
        <script type="text/javascript">
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })
            var url = window.location;
            $('.sidemenu .nav-item a').each( function(index, val) {
                if (this.href === url.href || url.href.indexOf(this.href) === 0) {
                    $(this).parent().addClass('active open');
                    $(this).parents('.nav-item').addClass('active open')
                }
            });
            var sub = $('.sub-menu')
            $.each(sub, function(index, val) {
                let len = $(this).find('.nav-item').length;
                if (len == 0) {
                    $(this).parent().remove()
                }
            });
        </script>

      </body>
</body>
</html>
