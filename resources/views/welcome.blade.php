<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body
    class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-[#FDFDFC] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
    <div>
        <h1 class="text-4xl font-bold">Welcome to Laravel</h1>

        <p class="mt-4 text-lg font-semibold text-center">Auth Routes</p>
        <div class="flex items-center justify-center mt-4 gap-4">
            @auth('web')
                <a href="{{ url('/dashboard') }}" class="btn btn-accent">Dashboard</a>
            @else
                <a href="{{ url('/login') }}" class="btn btn-neutral">Login</a>
                <a href="{{ url('/register') }}" class="btn btn-primary">Register</a>
            @endauth
            @auth('admin')
                <a href="" class="btn btn-info">Admin Dashboard</a>
            @else
                <a href="" class="btn btn-secondary">Login</a>
            @endauth
        </div>
    </div>
</body>

</html>
