<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Prevent Flash of Incorrect Theme (FOIT) -->
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

    <script src="{{ asset('assets/frontend/js/jquery.js') }}"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('css')
</head>

<body x-data>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('theme', {
                init() {
                    this.current = localStorage.getItem('theme') || 'system';
                    this.updateTheme();

                    // Watch for system preference changes
                    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', e => {
                        if (this.current === 'system') {
                            this.updateTheme();
                        }
                    });
                },
                current: 'system',
                updateTheme() {
                    // Save to localStorage
                    localStorage.setItem('theme', this.current);

                    // Apply dark class based on theme
                    if (this.current === 'system') {
                        const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                        document.documentElement.classList.toggle('dark', systemPrefersDark);
                        document.documentElement.setAttribute('data-theme', systemPrefersDark ? 'dark' : 'light');
                    } else {
                        document.documentElement.classList.toggle('dark', this.current === 'dark');
                        document.documentElement.setAttribute('data-theme', this.current);
                    }
                }
            });
        });
    </script>

    <!-- Theme selector -->
    <div class="p-4">
        <select
            class="theme-toggle px-4 py-2 rounded border bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-700 text-gray-900 dark:text-gray-100"
            x-model="$store.theme.current" 
            @change="$store.theme.updateTheme()">
            <option value="system">System</option>
            <option value="dark">Dark</option>
            <option value="light">Light</option>
        </select>
    </div>

    {{ $slot }}

    @stack('js')
</body>

</html>