<!DOCTYPE html>
<html lang="en">

    <head>
        <title>DOST XI</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link href="{{ asset('css/all.css') }}">
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    </head>

    <body data-theme="light" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="default">
        <div data-bs-theme="dark" class="wrapper">

            {{-- SIDEBAR START --}}
            @include('layouts.sidebar')
            {{-- SIDEBAR END --}}



            <div class="main">
                @include('layouts.header')
                <main class="content" style="padding:0.5rem 0.5rem 0.5rem">
                    <div class="container-fluid p-1">
                        <div class="row">
                            <div class="col-12">
                                <div class="card" style="padding-bottom:550px;">
                                    <div class="card-body">




                                        @if ($prospectusdataview[0]->cog_name)
                                            <iframe src="{{ url($prospectusdataview[0]->cog_name) }}" frameborder="0" scrolling="100" height="450%" width="100%" type="application/pdf" onerror="handleError()"></iframe>
                                        @else
                                            {{-- Handle the case where there is no valid URL --}}
                                            <p>No prospectus details available.</p>
                                        @endif

                                    </div>

                                </div>
                            </div>
                        </div>
                </main>
            </div>
        </div>
    </body>
    {{-- SIDEBAR TOGGLING --}}
    <script src="{{ asset('js/all.js') }}"></script>
    <script></script>

</html>
