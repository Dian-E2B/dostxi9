<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <title>DOST XI - SIMS</title>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>{{-- SWEETALERT --}}
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <link rel="icon" href="\icons\DOSTLOGOsmall.png" type="image/x-icon" />
        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/fontaws.css') }}" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    </head>

    <body style="background-color: rgb(235, 235, 235) !important">
        <div id="app">
            <main id="main" class="main" style="padding: 1.5rem 0.5rem 0.5rem; !important;">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </main>
        </div>

        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/fontaws.js') }}"></script>
    </body>

</html>
