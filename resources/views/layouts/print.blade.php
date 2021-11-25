<!doctype html>
<html lang="en">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="{{ mix('css/app.css') }}">
<link rel="stylesheet" href="{{ url('css/custom.css') }}">
<link rel="stylesheet" href="{{ url('css/jquery-ui.multidatespicker') }}">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" href="http://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
<link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">

@yield('after-styles')
<title>DOSTrack</title>
</head>
<body class="c-app" data-new-gr-c-s-check-loaded="14.1012.0" data-gr-ext-installed="">
   

<div class="c-wrapper c-fixed-components">
    <div class="c-body">
        <main class="c-main">
            @yield('content')
        </main>
        @include('includes.footer')
    </div>
</div>


</body>
@yield('before-scripts')
</html>

<script src="{{mix('js/app.js')}}"></script>
<script>
    var APP_URL = "{{ url('/') }}";
</script>

<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-multidatespicker/1.6.6/jquery-ui.multidatespicker.js" integrity="sha512-shDVoXhqpazAEKzSzJQTn5mAtynJ5eIl8pNX2Ah25/GZvZWDEJ/EKiVwfu7DGo8HnIwxlbu4xPi+C0SsHWCCNw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
@yield('after-scripts')