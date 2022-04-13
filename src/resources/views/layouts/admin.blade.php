<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'GetPrice') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Option Theme Style -->
    @include('partials.admin.head')

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div id="app" class="wrapper">
    <main class="py-4">
        @yield('content')
    </main>
</div>
<!-- ./wrapper -->
@include('partials.admin.scripts')
@include('partials.admin.footer')
</body>
</html>
