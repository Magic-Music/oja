<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Register</title>

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
                <div class="card-header card-header-background h5 text-center">
                    Welcome new user!
                </div>

                <div class="card-body card-background">
                    <form method='POST' action='user/create'>
                        @csrf

                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control"
                                   name="email" id="email" value='{{ old('email') }}'
                                   aria-describedby="emailHelp" placeholder="Enter email">
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                                else.</small>
                            @error('email')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control"
                                   name="password" id="password"
                                   aria-describedby="passwordHelp" placeholder="Enter password">
                            <small id="passwordHelp" class="form-text text-muted">Minimum 8 characeters, must contain
                                upper and lowercase letters and digits.</small>
                            @error('password')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control"
                                   name="name" id="name" value='{{ old('name') }}'
                                   placeholder="Enter name (optional)">
                            @error('name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="postcode">Name</label>
                            <input type="text" class="form-control"
                                   name="postcode" id="postcode" value='{{ old('postcode') }}'
                                   placeholder="Enter postcode (optional)">
                            @error('postcode')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-3"></div>
    </div>
</div>
</body>
</html>
