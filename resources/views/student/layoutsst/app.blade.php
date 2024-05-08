<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <title>DOST XI - SIMS</title>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>{{-- SWEETALERT --}}
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <link rel="icon" href="\icons\DOSTLOGOsmall.png" type="image/x-icon" />
        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

    </head>

    <body style="background-color: rgb(235, 235, 235) !important">
        <div id="app">
            @include('student.layoutsst.sidebar')
            @include('student.layoutsst.header')
            <main id="main" class="main">
                @yield('content')
            </main>
        </div>

        <script src="{{ asset('js/app.js') }}"></script>
    </body>

</html>
