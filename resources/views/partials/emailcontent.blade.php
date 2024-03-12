<!doctype html>
<html lang="en">

    <head>
        <title>DOST XI</title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>

    <body>

        {!! $mailData['title'] !!}
        {!! $mailData['message'] !!}
        {{-- <div id="editor"> --}}
        {{-- {!! $content->content !!} --}}
        {{--    <!-- Your Quill editor content here --> --}}
        {{-- </div> --}}
    </body>
    <script src="{{ asset('js/app.js') }}"></script>

</html>
