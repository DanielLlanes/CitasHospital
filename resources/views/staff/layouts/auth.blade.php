<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta name="description" content="Responsive Admin Template" />
    <meta name="author" content="RedstarHospital" />
    <title>{{ config('app.name', 'Laravel') }} | @yield('title')</title>
     <!-- google font -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet" type="text/css" />
    <!-- icons -->
    <link href="{{ asset('staffFiles/fonts/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css"/>
    <!-- <link rel="stylesheet" href="../assets/plugins/iconic/css/material-design-iconic-font.min.css"> -->
    <link rel="stylesheet" href="{{ asset('staffFiles/cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css') }}">
    <!-- bootstrap -->
    <link href="{{ asset('staffFiles/assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- style -->
    <link rel="stylesheet" href="{{ asset('staffFiles/assets/css/pages/extra_pages.css') }}">
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