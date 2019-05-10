<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>MediumValley</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content=" {{csrf_token() }}">
        <script>window.Laravel = { csrfToken: '{{ csrf_token() }}'}</script>
        
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
    </body>
</html>
