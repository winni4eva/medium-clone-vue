<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content=" {{csrf_token() }}">
        <script>window.Laravel = { csrfToken: '{{ csrf_token() }}'}</script>
        {{-- <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jodit/3.1.39/jodit.min.css">
        <script src="//cdnjs.cloudflare.com/ajax/libs/jodit/3.1.39/jodit.min.js"></script> --}}
        <title>MediumValley</title>
        
        <!-- Styles -->
        <link href="{{ asset('css/main.css') }}" rel="stylesheet">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <div id="app" class="container my-4 mx-auto px-4">
            <navbar></navbar>
            <router-view></router-view>
        </div>

        <script src="{{ asset('js/app.js') }}"></script>
        {{-- <script>var editor = new Jodit('#editor');</script> --}}
    </body>
</html>
