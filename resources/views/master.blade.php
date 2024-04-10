<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    {{-- <link rel="stylesheet" href="{{ asset('build/assets/app-D7gzYuJc.css') }}" class="rel"> --}}

    @vite(['resources/css/app.css', 'resources/js/app.js','resources/sass/app.scss'])
</head>
<body style="min-height: 100vh;">
    <div id="app">
        @yield('menu-vertical')
    </div>
    
    {{-- @yield('content') --}}
    {{-- <script src="{{ asset('build/assets/app-DZ6z3Mrk.js') }}"></script> --}}
</body>
</html>