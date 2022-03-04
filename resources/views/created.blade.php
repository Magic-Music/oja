<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>User created</title>

        <!-- JS -->
        <script src='{{ asset('js/bootstrap.bundle.min.js') }}'></script>
        <script src='{{ asset('js/jquery.js') }}'></script>

        <!-- Styles -->
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    </head>

    <body>
        <div class="container">
            <div class="row mt-4">
                <div class="col-3"></div>
                <div class="col-6">
                    <div class="card">
                        <div class="card-header card-header-created-background h5 text-center">
                            Your details have been registered!
                        </div>
                    </div>
                </div>
                <div class="col-3"></div>
            </div>
        </div>
    </body>
</html>
