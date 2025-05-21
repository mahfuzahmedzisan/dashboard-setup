<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        {{ isset($title) ? $title . ' - ' : '' }}
        {{ config('app.name', 'Dashboard Setup') }}
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
    {{-- <link href=" https://cdn.jsdelivr.net/npm/phosphor-icons@1.4.2/src/css/icons.min.css " rel="stylesheet"> --}}
    {{-- BoxIcons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/css/boxicons.min.css" />

    {{-- <script src="{{ asset('assets/frontend/js/jquery.js') }}"></script> --}}
    @vite(['resources/css/admin-dashboard.css', 'resources/js/app.js'])

    @stack('css')
</head>

<body x-data="{
    sidebar_expanded: true,
    mobile_menu_open: false,
    mobile: false,
    init() {
        // Check the initial width and update `mobile` state
        this.updateMobileState();

        // Listen to window resize events
        window.addEventListener('resize', () => {
            this.updateMobileState();
        });
    },
    updateMobileState() {
        this.mobile = window.innerWidth <= 768;
    },
}" class="bg-gradient-theme">

    <!-- Custom Cursor -->
    <div class="cursor-wrapper">
        <div class="custom-cursor"></div>
    </div>

    <div class="flex">
        <x-admin::side-bar :active="$page_slug" />
        <div class="w-full px-4">
            <x-admin::header />
            <main class="flex-1 p-4">
                {{ $slot }}
            </main>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const $cursorWrapper = $('.cursor-wrapper');
            const $cursor = $('.custom-cursor');

            // Initialize position off-screen
            $cursorWrapper.css('transform', 'translate(-100%, -100%)');

            // Move the cursor with the mouse
            $(document).on('mousemove', function(e) {
                const x = e.clientX;
                const y = e.clientY;
                $cursorWrapper.css('transform',
                    `translate(${x}px, ${y}px) translate(-50%, -50%)`);


                // Optional: Occasionally generate star
                if (Math.random() < 0.2) {
                    createStar(e.clientX, e.clientY);
                }
            });

            // Click animation
            $(document).on('mousedown', function() {
                $cursor.addClass('click');
            });
            $(document).on('mouseup', function() {
                $cursor.removeClass('click');
            });

            // Pulse on hover over links/buttons
            $('a, button').hover(
                function() {
                    $cursor.addClass('animate-scalePulse');
                },
                function() {
                    $cursor.removeClass('animate-scalePulse');
                }
            );

            // Optional star effect (uncomment to enable)
            function createStar(x, y) {
                const $star = $('<div class="star"></div>');

                // Add random colors
                const colors = ['#FF5733', '#33FF57', '#5733FF', '#FFFF33', '#33FFFF'];
                const color = colors[Math.floor(Math.random() * colors.length)];
                $star.css('background', `radial-gradient(circle, ${color}, transparent)`);

                // Position the star
                const offsetX = 0;
                const offsetY = 0;
                $star.css({
                    position: 'absolute',
                    left: `${x + offsetX}px`,
                    top: `${y + offsetY}px`,
                });

                // Append to body and remove after animation
                $('body').append($star);
                $star.on('animationend webkitAnimationEnd oAnimationEnd MSAnimationEnd', function() {
                    $(this).remove();
                });
            }
        });
    </script>

    {{-- Lucide Icons --}}
    <script src="{{ asset('assets/js/lucide-icon.js') }}"></script>
    <script>
        lucide.createIcons();
    </script>

</body>

</html>
