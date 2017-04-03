<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="{{asset('admin/dist/css/main.css')}}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
    <div id="app">
            @yield('content')
    </div>

    <!-- Javascripts-->
    <script src="{{asset('admin/dist/js/jquery-2.1.4.min.js')}}"></script>
    <script src="{{asset('admin/dist/js/essential-plugins.js')}}"></script>
    <script src="{{asset('admin/dist/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('admin/dist/js/plugins/pace.min.js')}}"></script>
    <script src="{{asset('admin/dist/js/main.js')}}"></script>
</body>
</html>
