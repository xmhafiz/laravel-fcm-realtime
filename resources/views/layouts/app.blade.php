<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- keep refresh every 1 hour to prevent form idle -->
        <meta http-equiv="refresh" content="3600" />

        <link rel="icon" href="#">

        <title>{{ env('APP_NAME', 'Laravel') }}</title>
        <!-- Bootstrap core CSS -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <!-- Custom styles for this template -->
        <style type="text/css">
            body {
                background-color: #2196F3;
                color: #fff;
            }
        </style>
    </head>

    <body>
        <div class="container-fluid">
            @yield('content')
        </div>
        <script src="{{ asset('js/jquery.js') }}"></script>
        <script src="{{ asset('js/app.js') }}"></script>
        @yield('scripts')
    </body>
</html>