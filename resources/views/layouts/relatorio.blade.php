<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <base href="/sgr">
        
        <style>
            body { 
                font-family: Roboto, Arial, sans-serif; 
            }
            .container {
                display: flex; /* or inline-flex */
                flex-direction: row;
                flex-wrap: nowrap;
                justify-content: space-between;
                align-items: center;
            }
            
            .container_row {
                display: flex; /* or inline-flex */
                flex-direction: row;
                flex-wrap: nowrap;
                justify-content: space-between;
                align-items: center;
            }
            
            .container_column {
                display: flex; /* or inline-flex */
                flex-direction: column;
                flex-wrap: nowrap;
                justify-content: space-between;
                align-items: center;
            }
            
            .container_center {
                display: flex; /* or inline-flex */
                flex-wrap: nowrap;
                justify-content: center;
                align-items: center;
            }
            .a4 {
                width: 100%;
            }
            
            table, th, td {
                border: 0px solid black;
                border-collapse: collapse;
            }
            
            th {
                text-align: left;
            }
            
            .page-break {
                page-break-after: always;
            }
            
        </style>
    </head>
    <body>
        <div id="app">            
            @yield('content')
        </div>        
    </body>
</html>





