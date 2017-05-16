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
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <style type="text/css">

            /* submit report - google map input */

            .controls {
                margin-top: 10px;
                border: 1px solid transparent;
                border-radius: 2px 0 0 2px;
                box-sizing: border-box;
                -moz-box-sizing: border-box;
                height: 32px;
                outline: none;
                box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
            }

            #pac-input {
                background-color: #fff;
                font-size: 15px;
                font-weight: 300;
                margin-left: 12px;
                padding: 10 11px 10 13px;
                text-overflow: ellipsis;
                min-width: 300px;
            }
        </style>
    </head>

    <body>
        <div class="container">
            @yield('content')
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
        @yield('scripts')
    </body>
</html>