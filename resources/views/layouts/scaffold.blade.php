<!DOCTYPE html>
<html lang="en">

<head>
    <title>DOST XI</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="{{ asset('css/all.css') }}">
</head>

<body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="default">
    <div class="wrapper">

        {{-- SIDEBAR START --}}
        @include('layouts.sidebar')
        {{-- SIDEBAR END --}}



        <div class="main">
            @include('layouts.header')

            <main style="padding: 0.5rem 0.5rem 0.5rem 0.5rem" class="content">
                <div class="container-fluid p-0">





                </div>
            </main>
        </div>
    </div>
</body>
{{-- SIDEBAR TOGGLING --}}
<script src="{{ asset('js/all.js') }}"></script>
<script></script>

</html>
