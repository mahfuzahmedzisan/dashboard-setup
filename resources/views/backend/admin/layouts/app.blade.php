<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        {{ isset($title) ? $title . ' - ' : '' }}
        {{ config('app.name', 'Ecommerce') }}
    </title>

    {{-- Theme selector && Theme store --}}
    <script>
        // On page load, immediately apply theme from localStorage to prevent flash
        (function() {
            let theme = localStorage.getItem('theme') || 'system';

            // Apply theme immediately
            if (theme === 'system') {
                const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                document.documentElement.classList.toggle('dark', systemPrefersDark);
                document.documentElement.setAttribute('data-theme', systemPrefersDark ? 'dark' : 'light');
            } else {
                document.documentElement.classList.toggle('dark', theme === 'dark');
                document.documentElement.setAttribute('data-theme', theme);
            }
        })();
    </script>
    <script src="{{ asset('assets/js/theme-toggle.js') }}"></script>

    {{-- End theme selector && Theme store --}}


    {{-- Icons --}}
    {{-- Phosphor Icon --}}
    <link href=" https://cdn.jsdelivr.net/npm/phosphor-icons@1.4.2/src/css/icons.min.css " rel="stylesheet">
    {{-- BoxIcons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/css/boxicons.min.css" />


    {{-- <script src="{{ asset('assets/frontend/js/jquery.js') }}"></script> --}}
    @vite(['resources/css/admin-dashboard.css', 'resources/js/app.js'])

    @stack('css')
</head>

<body x-data="{ sidebar_expanded: true, mobile_menu_open: false }" class="bg-gradient-theme">
    <div class="flex">
        <x-admin::side-bar :active="$page_slug" />
        <div class="w-full px-4">
            <x-admin::header />
            <main class="flex-1 p-4">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>

</html>
