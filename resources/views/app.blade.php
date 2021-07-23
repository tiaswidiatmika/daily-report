<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @yield('title')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="shortcut icon" type="image/jpg" href="{{ asset('logo.png') }}"/>
    @yield('additional-styles')
    @yield('jsfiles')
</head>
<body>
    @include('navbar')
    @yield('content')
</body>
</html>