<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <title>DOST XI</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>{{-- SWEETALERT --}}
        <link rel="icon" href="\icons\DOSTLOGOsmall.png" type="image/x-icon" />
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

        @livewireStyles
        <x-livewire-alert::scripts />
        <x-livewire-alert::flash />
        @yield('styles')
    </head>

    @php
        $replyStatusId = \App\Models\Replyslips::where('scholar_id', auth()->user()->scholar_id)->value('replyslip_status_id');
    @endphp
    @if ($replyStatusId == 5)
        @include('student.layoutsst.sidebar')
        @include('student.layoutsst.header')
    @endif

    <body style="background-color: rgb(235, 235, 235) !important; font-family: 'Inter', sans-serif !important;" class="{{ $replyStatusId == 5 ? '' : 'toggle-sidebar' }}">
        <div id="app">
            <main id="main" class="main">
                @yield('content')
            </main>
        </div>
        @livewireScripts
        <script src="{{ asset('js/app.js') }}"></script>
        @yield('scripts')
    </body>


</html>
