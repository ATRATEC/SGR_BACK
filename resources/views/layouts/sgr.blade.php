<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
		<link rel="shortcut icon" href="{{ asset('assets/imagens/sgr.ico') }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <base href="/sgr">
<!--        <base href="/js">-->

        
        


        <!-- Styles -->
        <link href="{{ asset('css/styles.bundle.css') }}" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <style>body { font-family: Roboto, Arial, sans-serif; }</style>
    </head>
    <body class="mat-app-background">
        <div id="app">            
            @yield('content')
        </div>

        <!-- Scripts -->
        <!--<script src="{{ asset('js/app.js') }}"></script>-->
        <script src="https://use.fontawesome.com/3b068da376.js"></script>
        <script type="text/javascript" src="{{ asset('js/inline.bundle.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/polyfills.bundle.js') }}"></script>
        <!--<script type="text/javascript" src="{{ asset('js/styles.bundle.js') }}"></script>-->
        <script type="text/javascript" src="{{ asset('js/vendor.bundle.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/scripts.bundle.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/main.bundle.js') }}"></script>
    </body>
</html>





