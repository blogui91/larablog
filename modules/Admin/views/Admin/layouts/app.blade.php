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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
    <div id="app">
        <!-- Navbar-->
        @include('Admin.partials.navbar')
        
        
        <!-- Side-Nav-->
        @include('Admin.partials.sidenav')
        

        <div class="wrapper">
          <div class="content-wrapper">
            <div class="page-title">
              <div>
                <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
                <p> admin template</p>
              </div>
              <div>
                <ul class="breadcrumb">
                  <li><i class="fa fa-home fa-lg"></i></li>
                  <li><a href="#">Dashboard</a></li>
                </ul>
              </div>
            </div>
            @yield('content')
          </div>
        </div>

    </div>

    {{-- Scripts --}}
    @yield('scripts')
    @yield('navbar-scripts')
    

    <!-- Javascripts-->
    <script src="{{asset('admin/dist/js/jquery-2.1.4.min.js')}}"></script>
    <script src="{{mix('libs/manifest.js')}}"></script>
    <script src="{{mix('libs/vendors.js')}}"></script>
    <script src="{{mix('admin/js/app.js')}}"></script>
    <script src="{{asset('admin/dist/js/essential-plugins.js')}}"></script>
    <script src="{{asset('admin/dist/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('admin/dist/js/plugins/pace.min.js')}}"></script>
    <script src="{{asset('admin/dist/js/main.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/dist/js/plugins/chart.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/dist/js/plugins/jquery.vmap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/dist/js/plugins/jquery.vmap.world.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/dist/js/plugins/jquery.vmap.sampledata.js')}}"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        var data = {
            labels: ["January", "February", "March", "April", "May"],
            datasets: [
                {
                    label: "My First dataset",
                    fillColor: "rgba(220,220,220,0.2)",
                    strokeColor: "rgba(220,220,220,1)",
                    pointColor: "rgba(220,220,220,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(220,220,220,1)",
                    data: [65, 59, 80, 81, 56]
                },
                {
                    label: "My Second dataset",
                    fillColor: "rgba(151,187,205,0.2)",
                    strokeColor: "rgba(151,187,205,1)",
                    pointColor: "rgba(151,187,205,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(151,187,205,1)",
                    data: [28, 48, 40, 19, 86]
                }
            ]
        };
        var ctxl = $("#lineChartDemo").get(0).getContext("2d");
        var lineChart = new Chart(ctxl).Line(data);
      
        var map = $('#demo-map');
        map.vectorMap({
            map: 'world_en',
            backgroundColor: '#fff',
            color: '#333',
            hoverOpacity: 0.7,
            selectedColor: '#666666',
            enableZoom: true,
            showTooltip: true,
            scaleColors: ['#C8EEFF', '#006491'],
            values: sample_data,
            normalizeFunction: 'polynomial'
        });
      });
    </script>

    <script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
    



</body>
</html>
