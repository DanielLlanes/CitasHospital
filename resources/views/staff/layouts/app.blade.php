<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta name="description" content="Responsive Admin Template" />
    <meta name="author" content="Sunray" />
    <title>{{ str_replace('_', " ", config('app.name', 'Laravel')) }} | @yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- google font -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet" type="text/css" />
    <!-- icons -->
    <link rel="stylesheet" href="{{ asset('staffFiles/assets/plugins/font-awesome/css/font-awesome.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <!--bootstrap -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('staffFiles/assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Material Design Lite CSS -->
    <link href="{{ asset('staffFiles/assets/plugins/material/material.min.css') }}" rel="stylesheet" >
    <link href="{{ asset('staffFiles/assets/css/material_style.css') }}" rel="stylesheet">
    <!-- morris chart -->
    <link href="{{ asset('staffFiles/assets/plugins/morris/morris.css') }}" rel="stylesheet" type="text/css" />
    <!-- Theme Styles -->
    <link href="{{ asset('staffFiles/assets/css/style.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('staffFiles/assets/css/plugins.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('staffFiles/assets/css/responsive.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('staffFiles/assets/css/theme-color.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('staffFiles/assets/plugins/sweetalert/sweetalert.css') }}">
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
        <div class="page-header navbar navbar-fixed-top" style="border: 1px solid red">
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
        {{-- <script src="{{ asset('staffFiles/assets/js/pages/chart/morris/morris-home-data.js') }}" ></script> --}}
        <!-- end js include path -->
        {{-- plugins Langs --}}
        <script>
            var dataTablesLangEs =  "{{ asset('/lang/datatable-es.json') }}"
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
      </body>
</body>
</html>