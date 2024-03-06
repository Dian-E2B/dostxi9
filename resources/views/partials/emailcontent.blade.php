<!doctype html>
<html lang="en">

    <head>
        <title>DOST XI</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body>

        {!! $mailData['title'] !!}
        {!! $mailData['message'] !!}
        {{-- <div id="editor"> --}}
        {{-- {!! $content->content !!} --}}
        {{--    <!-- Your Quill editor content here --> --}}
        {{-- </div> --}}
    </body>
    <script></script>

</html>
