<!DOCTYPE html>
<html >
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title', 'Auth') | {{ config('app.name', 'Laravel') }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('auth.partials.css')
</head>
<body class="hold-transition login-page">
<div class="login-box" id="app">
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Welcome to <b class="text-capitalize">{{ config('app.name') }}</b></p>
            @yield('content')
{{--            <div class="social-auth-links text-center mb-3">--}}
{{--                <p>- OR -</p>--}}
{{--                <a href="#" class="btn btn-block btn-primary">--}}
{{--                    <i class="fab fa-facebook mr-2"></i> Sign in using Facebook--}}
{{--                </a>--}}
{{--                <a href="#" class="btn btn-block btn-danger">--}}
{{--                    <i class="fab fa-google-plus mr-2"></i> Sign in using Google+--}}
{{--                </a>--}}
{{--            </div>--}}
{{--            <p class="mb-1">--}}
{{--                <a href="#">I forgot my password</a>--}}
{{--            </p>--}}
{{--            <p class="mb-0">--}}
{{--                <a href="#" class="text-center">Register a new membership</a>--}}
{{--            </p>--}}
        </div>
    </div>
</div>
@include('auth.partials.script')
</body>
</html>
