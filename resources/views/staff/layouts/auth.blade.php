<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta name="description" content="Responsive Admin Template" />
    <meta name="author" content="RedstarHospital" />
    <title>{{ str_replace('_', " ", config('app.name', 'Laravel')) }} | @yield('title')</title>
     <!-- google font -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet" type="text/css" />
    <!-- icons -->
    <link rel="stylesheet" href="{{ asset('staffFiles/assets/plugins/font-awesome/css/font-awesome.css') }}">
    <!-- <link rel="stylesheet" href="../assets/plugins/iconic/css/material-design-iconic-font.min.css"> -->
    <link rel="stylesheet" href="{{ asset('staffFiles/cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css') }}">
    <!-- bootstrap -->
    <link href="{{ asset('staffFiles/assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- style -->
    <link rel="stylesheet" href="{{ asset('staffFiles/assets/css/pages/extra_pages.css') }}">
    <style>
        input:-internal-autofill-selected {
            appearance: menulist-button;
            background-color: red !important;
            background-image: none !important;
            color: -internal-light-dark(black, white) !important;
        }
        input:-webkit-autofill,
        input:-webkit-autofill:hover,
        input:-webkit-autofill:focus,
        input:-webkit-autofill:active {
            -webkit-animation: autofill 0s forwards;
            animation: autofill 0s forwards;
        }

        @keyframes autofill {
            100% {
                background: transparent;
                color: inherit;
            }
        }

        @-webkit-keyframes autofill {
            100% {
                background: transparent;
                color: inherit;
            }
        }
    </style>
</head>
<body>
    @yield('content')
    <!-- start js include path -->
     <script src="{{ asset('staffFiles/assets/plugins/jquery/jquery.min.js') }}" ></script>
    <!-- bootstrap -->
    <script src="{{ asset('staffFiles/assets/plugins/bootstrap/js/bootstrap.min.js') }}" ></script>
    <script src="{{ asset('staffFiles/assets/js/pages/extra_pages/extra_pages.js') }}"></script>
    <!-- end js include path -->
</body>
</html>