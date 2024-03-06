<!DOCTYPE html>
<html lang="en">

    <head>
        <title>DOST XI</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link href="{{ asset('css/all.css') }}">
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
        <style>
            body,
            html {
                width: 100%;
                height: 100%;
                margin: 0;
                padding: 0;
            }
        </style>
    </head>

    <body data-theme="light" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="default">
        <div data-bs-theme="dark" class="wrapper">

            {{-- SIDEBAR START --}}
            @include('layouts.sidebar')
            {{-- SIDEBAR END --}}



            <div class="main">
                @include('layouts.header')

                @if ($prospectusdataview[0]->cog_name)
                    <iframe src="{{ url($prospectusdataview[0]->cog_name) }}" frameborder="0" scrolling="100" height="450%" width="100%" type="application/pdf" onerror="handleError()"></iframe>
                @else
                    {{-- Handle the case where there is no valid URL --}}
                    <p>No prospectus details available.</p>
                @endif

            </div>
        </div>
    </body>
    {{-- SIDEBAR TOGGLING --}}
    <script src="{{ asset('js/all.js') }}"></script>
    <script></script>

</html>
