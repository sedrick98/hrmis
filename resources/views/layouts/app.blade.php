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

<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    
    </body>
</html>

@yield('before-scripts')

<script src="{{mix('js/app.js')}}"></script>
<script>
    var APP_URL = "{{ url('/') }}";
</script>
@yield('after-scripts')