<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Home') | {{ config('app.name') }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('partials.css')
</head>
<body class="hold-transition sidebar-mini layout-fixed text-sm">
<div class="wrapper" id="app">
    @include('partials.navbar')
    @include('partials.sidebar')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                @yield('header')
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </section>
    </div>
    @include('partials.footer')
    {{--    <aside class="control-sidebar control-sidebar-dark">--}}
    {{--        <!-- Control sidebar content goes here -->--}}
    {{--    </aside>--}}
</div>
@include('partials.script')
@include('sweetalert::alert')
@stack('scripts')
</body>
</html>
