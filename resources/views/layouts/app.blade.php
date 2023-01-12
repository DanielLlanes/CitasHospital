<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ str_replace("_", ' ', config('app.name', 'Laravel')) }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
</head>
<body>
    <div id="app">
        <main class="py-4">
            holaaaaaaaaaaaaaaaaaaaaaa
            @yield('content')
        </main>
    </div>
    <script>
        let handleStateChange = () => {
                    var timeBadge = new Date().toTimeString().split(' ')[0];
                    var newState = "";
                    var state = navigator.onLine ? 'online' : 'offline';
                    newState.innerHTML += '' + timeBadge + ' Connection state changed to ' + state + '.';
                    log(newState)
                }
        ononline = (handleStateChange) => {
                    connStatus.style.display = "none";
                    location.reload()
                };
    </script>
</body>
</html>
