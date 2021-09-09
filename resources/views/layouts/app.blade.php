<!doctype html>
<html lang="en">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="{{mix('css/app.css')}}">
@yield('after-styles')
<title>DOSTrack</title>
</head>
<body class="c-app" data-new-gr-c-s-check-loaded="14.1012.0" data-gr-ext-installed="">
    @include('includes.sidebar')

<div class="c-wrapper c-fixed-components">
    @include('includes.header')
    <div class="c-body">
        <main class="c-main">
            @yield('content')
        </main>
        @include('includes.footer')
    </div>
</div>
    
    {{-- <script src="vendors/@coreui/coreui/js/coreui.bundle.min.js"></script>
    <!--[if IE]><!-->
    <script src="vendors/@coreui/icons/js/svgxuse.min.js"></script>
    <!--<![endif]-->
    
    <script src="vendors/@coreui/chartjs/js/coreui-chartjs.bundle.js"></script>
    <script src="vendors/@coreui/utils/js/coreui-utils.js"></script> --}}
    
    </body>
</html>
<script src="{{mix('js/app.js')}}"></script>
<script>
    var APP_URL = "{{ url('/') }}";
</script>
@yield('after-scripts')