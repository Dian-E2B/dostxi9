<!DOCTYPE html>
<html lang="en">

    <head>
        <title>DOST XI</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link href="{{ asset('css/all.css') }}">

        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
        {{-- <script>
            function resizeIframe(obj) {
                obj.style.height = obj.contentWindow.document.documentElement.scrollHeight + 'px';
            }
        </script> --}}

    </head>
    <style>
        body,
        html {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
        }


        .sidebar-toggle {
            display: none;
        }

        .nav-link {
            display: none;
        }
    </style>

    <body data-theme="light" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="default">
        <div data-bs-theme="dark" class="wrapper">
            <div class="main">
                @include('layouts.header')

                @if ($Requestdocsview[0]->document_details)
                    <iframe id="ifrm" src="{{ url($Requestdocsview[0]->document_details) }}" frameborder="0" scrolling="no" height="100%" width="100%" type="application/pdf" onload="resizeIframe(this)"></iframe>
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
