<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Centro Quirúrgico JL Prado @yield('title')</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    {{-- <meta http-equiv="refresh" content="0;URL='http://staff.prado.test'" />  --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicons -->
    {{-- <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon"> --}}

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Muli:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap"
        rel="stylesheet">
    <!-- Vendor CSS Files -->
    <link href="{{ asset('siteFiles/assets/vendor/animate.css/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('siteFiles/assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('siteFiles/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('siteFiles/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('siteFiles/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('siteFiles/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('siteFiles/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('siteFiles/assets/vendor/splide-2.4.21/dist/css/splide.min.css') }}" rel="stylesheet">
    <link href="{{ asset('siteFiles/assets/vendor/splide-2.4.21/dist/css/themes/splide-sea-green.min.css') }}" rel="stylesheet">
    <link href="{{ asset('siteFiles/assets/vendor/sweetalert/sweetalert.css') }}" rel="stylesheet">
    <!-- Magnific PopUp -->
    <link href="{{ asset('staffFiles/assets/plugins/magnific-popup-master/dist/magnific-popup.css') }}" rel="stylesheet">
    <script src="https://cdn.socket.io/4.4.0/socket.io.min.js" integrity="sha384-1fOn6VtTq3PWwfsOrk45LnYcGosJwzMHv+Xh/Jx5303FVOXzEnw0EpLv30mtjmlj" crossorigin="anonymous"></script>
    @yield('styles')

    <!-- Template Main CSS File -->
    <link href="{{ asset('siteFiles/assets/css/style.css') }}" rel="stylesheet">
</head>
<body>

    <!-- ======= Top Bar ======= -->
    {{-- @include('site.commun.topbar') --}}
    <!-- End Top Bar -->
    <!-- ======= Header ======= -->
    {{-- @include('site.commun.header') --}}
    <!-- End Header -->
<code>

</code>
    @yield('content')

    <!-- ======= Back to top ======= -->
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <!-- End Back to top -->

    <!-- ======= Footer ======= -->
    {{-- @include('site.commun.footer') --}}
    <!-- End Footer -->

    <!-- Vendor JS Files -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="{{ asset('siteFiles/assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('siteFiles/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('siteFiles/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('siteFiles/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>{{--
    <script src="{{ asset('siteFiles/assets/vendor/php-email-form/validate.js') }}"></script> --}}
    <!-- counterup -->
    <script src="{{ asset('staffFiles/assets/plugins/counterup/jquery.waypoints.min.js') }}" ></script>
    <script src="{{ asset('staffFiles/assets/plugins/counterup/jquery.counterup.min.js') }}" ></script>
    <script src="{{ asset('siteFiles/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('siteFiles/assets/vendor/waypoints/noframework.waypoints.js') }}"></script>
    <script src="{{ asset('siteFiles/assets/vendor/splide-2.4.21/dist/js/splide.min.js') }}"></script>
    <script src="{{ asset('siteFiles/assets/vendor/sweetalert/sweetalert2.js') }}"></script>
    <!-- Magnific PopUp -->
    <script src="{{ asset('staffFiles/assets/plugins/magnific-popup-master/dist/jquery.magnific-popup.min.js') }}"></script>
    <!-- Template Main JS File -->
    <script src="{{ asset('siteFiles/assets/js/main.js') }}"></script>
    <!-- Socket io-->
    <script src="https://cdn.socket.io/4.4.0/socket.io.min.js" integrity="sha384-1fOn6VtTq3PWwfsOrk45LnYcGosJwzMHv+Xh/Jx5303FVOXzEnw0EpLv30mtjmlj" crossorigin="anonymous"></script>
    <style type="text/css">
        .swal2-title{
            font-size: .8rem!important;
        }
        .debateNotifications li .message p {
            margin-block-start: 0!important;
            margin-inline-start: 0!important;
        }
        .page-header.navbar .top-menu .navbar-nav>li.dropdown-inbox>.dropdown-menu .dropdown-menu-list>li .subject .read {
            font-size: 12px;
            font-weight: 400;
            opacity: .5;
            filter: alpha(opacity=50);
            float: right;
        }
    </style>
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
        const glightbox = GLightbox({
            selector: '.glightbox'
        });
        let ip_address = window.location.hostname;
            let socket_port = '3000';
            let socket = io(ip_address + ':' + socket_port );
        socket.on('connect', function() {
           socket.emit('user_connected', 'anonimous');
        });
        $('.images').magnificPopup({
              delegate: 'a.a',
              type: 'image',
              removalDelay: 500, //delay removal by X to allow out-animation
              callbacks: {
                beforeOpen: function() {
                  // just a hack that adds mfp-anim class to markup
                   this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
                   this.st.mainClass = this.st.el.attr('data-effect');
                }
              },
              closeOnContentClick: true,
              midClick: true // allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source.
        });
    </script>
    @yield('scripts')
</body>

</html>
