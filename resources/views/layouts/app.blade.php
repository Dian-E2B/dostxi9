<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <title>DOST XI - SIMS</title>
        <link rel="icon" href="\icons\DOSTLOGOsmall.png" type="image/x-icon" />
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        {{--  <link href="{{ asset('css/fontaws.min.css') }}" rel="stylesheet"> --}}
        @yield('styles')
    </head>

    <body>
        <div id="app">
            @if (Auth::check())
                @include('layouts.headernew') {{-- HEADER START --}}
                @include('layouts.sidebarnew') {{-- SIDEBAR START --}}
            @endif
            <main id="main" class="main">
                @yield('content')
            </main>
        </div>
        @yield('scripts')
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
        <script src="{{ asset('js/app.js') }}"></script>
        {{--   <scri<pt src="{{ asset('js/fontaws.min.js') }}"></script> --}}

    </body>

</html>
