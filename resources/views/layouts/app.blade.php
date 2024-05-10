<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <title>DOST XI - SIMS</title>
        <link rel="icon" href="\icons\DOSTLOGOsmall.png" type="image/x-icon" />
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        @livewireStyles
        {{-- Datatables css --}}
        <link href="https://cdn.datatables.net/v/bs5/dt-1.13.8/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/date-1.5.1/fc-4.3.0/fh-3.4.0/r-2.5.0/sc-2.3.0/sp-2.2.0/sl-1.7.0/datatables.min.css" rel="stylesheet">

        {{-- Sweetalert cdn - --}}
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
        {{--  <link href="{{ asset('css/fontaws.min.css') }}" rel="stylesheet"> --}}
        <x-livewire-alert::scripts />
        <x-livewire-alert::flash />
        @yield('styles')
    </head>

    <body style="font-family: 'Inter', sans-serif !important;">

        <div id="app">
            @if (Auth::check())
                @include('layouts.headernew') {{-- HEADER START --}}
                @include('layouts.sidebarnew') {{-- SIDEBAR START --}}
            @endif
            <main id="main" class="main">
                @yield('content')
            </main>
        </div>



        {{--   <scri<pt src="{{ asset('js/fontaws.min.js') }}"></script> --}}
        @livewireScripts
        <script src="{{ asset('js/app.js') }}"></script>
        @yield('scripts')
    </body>



</html>
