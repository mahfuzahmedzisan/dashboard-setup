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
    @vite(['resources/css/admin-dashboard.css', 'resources/js/app.js'])
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }

        /* Modern gradient backgrounds */
        .bg-gradient-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .bg-gradient-dark {
            background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
        }

        /* Custom scrollbar */
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 3px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 3px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.5);
        }

        /* Sidebar hover effects */
        .sidebar-item {
            position: relative;
            overflow: hidden;
        }

        .sidebar-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 3px;
            background: linear-gradient(to bottom, #3b82f6, #8b5cf6);
            transform: scaleY(0);
            transition: transform 0.2s ease;
        }

        .sidebar-item:hover::before,
        .sidebar-item.active::before {
            transform: scaleY(1);
        }

        /* Glass morphism effect */
        .glass {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .glass-dark {
            background: rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Animated background */
        .animated-bg {
            background: linear-gradient(-45deg, #667eea, #764ba2, #f093fb, #f5576c);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
        }

        @keyframes gradientBG {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        /* Floating animation */
        .float {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        /* Pulse animation */
        .pulse-slow {
            animation: pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        /* Notification badge */
        .notification-badge {
            animation: bounce 2s infinite;
        }

        /* Modern button styles */
        .btn-modern {
            background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-modern::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn-modern:hover::before {
            left: 100%;
        }

        /* Card hover effects */
        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        /* Progress bar animation */
        .progress-bar {
            animation: progressLoad 2s ease-out;
        }

        @keyframes progressLoad {
            0% {
                width: 0%;
            }
        }

        /* Shimmer effect */
        .shimmer {
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            background-size: 200% 100%;
            animation: shimmer 2s infinite;
        }

        @keyframes shimmer {
            0% {
                background-position: -200% 0;
            }

            100% {
                background-position: 200% 0;
            }
        }

        /* Interactive elements */
        .interactive-card {
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .interactive-card:hover {
            transform: scale(1.02);
        }

        .interactive-card:active {
            transform: scale(0.98);
        }

        /* Tooltip styles */
        /* .tooltip {
            position: relative;
        }

        .tooltip::after {
            content: attr(data-tooltip);
            position: absolute;
            bottom: 100%;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 8px 12px;
            border-radius: 8px;
            font-size: 12px;
            white-space: nowrap;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s;
            margin-bottom: 8px;
        }

        .tooltip:hover::after {
            opacity: 1;
        } */
    </style>
</head>

<body x-data="dashboardData()" class="animated-bg min-h-screen">

    <!-- Mobile/Tablet Overlay -->
    <div x-show="mobile_menu_open && !desktop" x-transition:enter="transition-all duration-300 ease-out"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition-all duration-300 ease-in" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0" @click="closeMobileMenu()" class="fixed inset-0 z-40 glass-dark lg:hidden">
    </div>

    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="transition-all duration-300 ease-in-out z-50 max-h-screen overflow-y-auto custom-scrollbar"
            :class="{
                'relative': desktop,
                'w-72': desktop && sidebar_expanded,
                'w-20': desktop && !sidebar_expanded,
                'fixed top-0 left-0 h-full': !desktop,
                'w-72 translate-x-0': !desktop && mobile_menu_open,
                'w-72 -translate-x-full': !desktop && !mobile_menu_open,
            }">

            <div class="glass h-full shadow-2xl border-r border-white/20 custom-scrollbar overflow-y-auto">
                <!-- Sidebar Header -->
                <div class="p-6 border-b border-white/10">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 btn-modern rounded-xl flex items-center justify-center shadow-lg">
                            <i data-lucide="zap" class="w-6 h-6 text-white"></i>
                        </div>
                        <div x-show="(desktop && sidebar_expanded) || (!desktop && mobile_menu_open)"
                            x-transition:enter="transition-all duration-300 delay-75"
                            x-transition:enter-start="opacity-0 translate-x-4"
                            x-transition:enter-end="opacity-100 translate-x-0"
                            x-transition:leave="transition-all duration-200"
                            x-transition:leave-start="opacity-100 translate-x-0"
                            x-transition:leave-end="opacity-0 -translate-x-4">
                            <h1 class="text-xl font-bold text-white">ModernUI</h1>
                            <p class="text-white/60 text-sm">Dashboard Pro</p>
                        </div>
                    </div>
                </div>

                <!-- Quick Stats (Collapsed Sidebar) -->
                <div x-show="desktop && !sidebar_expanded" x-transition:enter="transition-all duration-300 delay-100"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    class="p-4 border-b border-white/10">
                    <div class="space-y-3">
                        <div class="w-8 h-8 bg-green-500/20 rounded-lg flex items-center justify-center relative "
                            data-tooltip="Active Users">
                            <i data-lucide="activity" class="w-4 h-4 text-green-400"></i>
                            <div class="absolute -top-1 -right-1 w-3 h-3 bg-green-400 rounded-full notification-badge">
                            </div>
                        </div>
                        <div class="w-8 h-8 bg-blue-500/20 rounded-lg flex items-center justify-center "
                            data-tooltip="Total Users">
                            <i data-lucide="users" class="w-4 h-4 text-blue-400"></i>
                        </div>
                        <div class="w-8 h-8 bg-purple-500/20 rounded-lg flex items-center justify-center "
                            data-tooltip="Revenue">
                            <i data-lucide="trending-up" class="w-4 h-4 text-purple-400"></i>
                        </div>
                    </div>
                </div>

                <!-- Navigation Menu -->
                <nav class="p-4 space-y-2">
                    <!-- Dashboard -->
                    <a href="#" @click="setActiveTab('dashboard')"
                        :class="{ 'active': activeTab === 'dashboard' }"
                        class="sidebar-item flex items-center gap-4 p-3 rounded-xl hover:bg-white/10 text-white transition-all duration-200 group">
                        <div
                            class="w-8 h-8 bg-blue-500/20 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                            <i data-lucide="layout-dashboard" class="w-5 h-5 text-blue-400 flex-shrink-0"></i>
                        </div>
                        <span x-show="(desktop && sidebar_expanded) || (!desktop && mobile_menu_open)"
                            x-transition:enter="transition-all duration-300 delay-75"
                            x-transition:enter-start="opacity-0 translate-x-4"
                            x-transition:enter-end="opacity-100 translate-x-0"
                            x-transition:leave="transition-all duration-200"
                            x-transition:leave-start="opacity-100 translate-x-0"
                            x-transition:leave-end="opacity-0 -translate-x-4" class="font-medium">Dashboard</span>
                        <div x-show="(desktop && sidebar_expanded) || (!desktop && mobile_menu_open)" class="ml-auto">
                            <div class="w-2 h-2 bg-blue-400 rounded-full pulse-slow"></div>
                        </div>
                    </a>

                    <!-- Analytics -->
                    <a href="#" @click="setActiveTab('analytics')"
                        :class="{ 'active': activeTab === 'analytics' }"
                        class="sidebar-item flex items-center gap-4 p-3 rounded-xl hover:bg-white/10 text-white transition-all duration-200 group">
                        <div
                            class="w-8 h-8 bg-green-500/20 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform relative">
                            <i data-lucide="bar-chart-3" class="w-5 h-5 text-green-400 flex-shrink-0"></i>
                            <div class="absolute -top-1 -right-1 w-3 h-3 bg-red-400 rounded-full notification-badge">
                            </div>
                        </div>
                        <span x-show="(desktop && sidebar_expanded) || (!desktop && mobile_menu_open)"
                            x-transition:enter="transition-all duration-300 delay-75"
                            x-transition:enter-start="opacity-0 translate-x-4"
                            x-transition:enter-end="opacity-100 translate-x-0"
                            x-transition:leave="transition-all duration-200"
                            x-transition:leave-start="opacity-100 translate-x-0"
                            x-transition:leave-end="opacity-0 -translate-x-4" class="font-medium">Analytics</span>
                        <div x-show="(desktop && sidebar_expanded) || (!desktop && mobile_menu_open)"
                            class="ml-auto bg-red-500 text-white text-xs px-2 py-1 rounded-full">New</div>
                    </a>

                    <!-- Users -->
                    <a href="#" @click="setActiveTab('users')" :class="{ 'active': activeTab === 'users' }"
                        class="sidebar-item flex items-center gap-4 p-3 rounded-xl hover:bg-white/10 text-white transition-all duration-200 group">
                        <div
                            class="w-8 h-8 bg-purple-500/20 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                            <i data-lucide="users" class="w-5 h-5 text-purple-400 flex-shrink-0"></i>
                        </div>
                        <span x-show="(desktop && sidebar_expanded) || (!desktop && mobile_menu_open)"
                            x-transition:enter="transition-all duration-300 delay-75"
                            x-transition:enter-start="opacity-0 translate-x-4"
                            x-transition:enter-end="opacity-100 translate-x-0"
                            x-transition:leave="transition-all duration-200"
                            x-transition:leave-start="opacity-100 translate-x-0"
                            x-transition:leave-end="opacity-0 -translate-x-4" class="font-medium">Users</span>
                        <div x-show="(desktop && sidebar_expanded) || (!desktop && mobile_menu_open)"
                            class="ml-auto text-white/60 text-sm">1.2k</div>
                    </a>

                    <!-- Projects -->
                    <a href="#" @click="setActiveTab('projects')"
                        :class="{ 'active': activeTab === 'projects' }"
                        class="sidebar-item flex items-center gap-4 p-3 rounded-xl hover:bg-white/10 text-white transition-all duration-200 group">
                        <div
                            class="w-8 h-8 bg-yellow-500/20 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                            <i data-lucide="folder" class="w-5 h-5 text-yellow-400 flex-shrink-0"></i>
                        </div>
                        <span x-show="(desktop && sidebar_expanded) || (!desktop && mobile_menu_open)"
                            x-transition:enter="transition-all duration-300 delay-75"
                            x-transition:enter-start="opacity-0 translate-x-4"
                            x-transition:enter-end="opacity-100 translate-x-0"
                            x-transition:leave="transition-all duration-200"
                            x-transition:leave-start="opacity-100 translate-x-0"
                            x-transition:leave-end="opacity-0 -translate-x-4" class="font-medium">Projects</span>
                    </a>

                    <!-- Messages -->
                    <a href="#" @click="setActiveTab('messages')"
                        :class="{ 'active': activeTab === 'messages' }"
                        class="sidebar-item flex items-center gap-4 p-3 rounded-xl hover:bg-white/10 text-white transition-all duration-200 group">
                        <div
                            class="w-8 h-8 bg-pink-500/20 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform relative">
                            <i data-lucide="message-circle" class="w-5 h-5 text-pink-400 flex-shrink-0"></i>
                            <div class="absolute -top-1 -right-1 w-3 h-3 bg-pink-400 rounded-full notification-badge">
                            </div>
                        </div>
                        <span x-show="(desktop && sidebar_expanded) || (!desktop && mobile_menu_open)"
                            x-transition:enter="transition-all duration-300 delay-75"
                            x-transition:enter-start="opacity-0 translate-x-4"
                            x-transition:enter-end="opacity-100 translate-x-0"
                            x-transition:leave="transition-all duration-200"
                            x-transition:leave-start="opacity-100 translate-x-0"
                            x-transition:leave-end="opacity-0 -translate-x-4" class="font-medium">Messages</span>
                        <div x-show="(desktop && sidebar_expanded) || (!desktop && mobile_menu_open)"
                            class="ml-auto bg-pink-500 text-white text-xs px-2 py-1 rounded-full">3</div>
                    </a>

                    <!-- Divider -->
                    <div class="my-4 border-t border-white/10"></div>

                    <!-- Settings -->
                    <a href="#"
                        class="sidebar-item flex items-center gap-4 p-3 rounded-xl hover:bg-white/10 text-white transition-all duration-200 group">
                        <div
                            class="w-8 h-8 bg-gray-500/20 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                            <i data-lucide="settings" class="w-5 h-5 text-gray-400 flex-shrink-0"></i>
                        </div>
                        <span x-show="(desktop && sidebar_expanded) || (!desktop && mobile_menu_open)"
                            x-transition:enter="transition-all duration-300 delay-75"
                            x-transition:enter-start="opacity-0 translate-x-4"
                            x-transition:enter-end="opacity-100 translate-x-0"
                            x-transition:leave="transition-all duration-200"
                            x-transition:leave-start="opacity-100 translate-x-0"
                            x-transition:leave-end="opacity-0 -translate-x-4" class="font-medium">Settings</span>
                    </a>

                    <!-- Help -->
                    <a href="#"
                        class="sidebar-item flex items-center gap-4 p-3 rounded-xl hover:bg-white/10 text-white transition-all duration-200 group">
                        <div
                            class="w-8 h-8 bg-indigo-500/20 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                            <i data-lucide="help-circle" class="w-5 h-5 text-indigo-400 flex-shrink-0"></i>
                        </div>
                        <span x-show="(desktop && sidebar_expanded) || (!desktop && mobile_menu_open)"
                            x-transition:enter="transition-all duration-300 delay-75"
                            x-transition:enter-start="opacity-0 translate-x-4"
                            x-transition:enter-end="opacity-100 translate-x-0"
                            x-transition:leave="transition-all duration-200"
                            x-transition:leave-start="opacity-100 translate-x-0"
                            x-transition:leave-end="opacity-0 -translate-x-4" class="font-medium">Help &
                            Support</span>
                    </a>
                </nav>

                <!-- User Profile - Bottom -->
                <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-white/10 glass">
                    <div class="flex items-center gap-3">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=40&h=40&fit=crop&crop=face&auto=format"
                                alt="Profile" class="w-10 h-10 rounded-xl object-cover ring-2 ring-white/20">
                            <div
                                class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-400 rounded-full border-2 border-white/20">
                            </div>
                        </div>
                        <div x-show="(desktop && sidebar_expanded) || (!desktop && mobile_menu_open)"
                            x-transition:enter="transition-all duration-300 delay-75"
                            x-transition:enter-start="opacity-0 translate-x-4"
                            x-transition:enter-end="opacity-100 translate-x-0"
                            x-transition:leave="transition-all duration-200"
                            x-transition:leave-start="opacity-100 translate-x-0"
                            x-transition:leave-end="opacity-0 -translate-x-4" class="flex-1">
                            <p class="text-white text-sm font-medium">Alex Johnson</p>
                            <p class="text-white/60 text-xs">Product Manager</p>
                        </div>
                        <button x-show="(desktop && sidebar_expanded) || (!desktop && mobile_menu_open)"
                            class="w-8 h-8 rounded-lg hover:bg-white/10 flex items-center justify-center transition-colors">
                            <i data-lucide="more-horizontal" class="w-4 h-4 text-white/60"></i>
                        </button>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col min-h-screen">
            <!-- Header -->
            <header class="glass border-b border-white/20 sticky top-0 z-30">
                <div class="flex items-center justify-between p-4 lg:p-6">
                    <div class="flex items-center gap-4">
                        <!-- Menu Toggle Button -->
                        <button @click="toggleSidebar()"
                            class="p-2 rounded-xl hover:bg-white/10 text-white transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-white/20 group"
                            :aria-label="desktop ? (sidebar_expanded ? 'Collapse sidebar' : 'Expand sidebar') : (mobile_menu_open ?
                                'Close menu' : 'Open menu')">
                            <i data-lucide="menu" class="w-5 h-5 group-hover:scale-110 transition-transform"></i>
                        </button>

                        <div class="hidden sm:block">
                            <h1 class="text-xl lg:text-2xl font-bold text-white">Good morning, Alex!</h1>
                            <p class="text-white/60 text-sm">Here's what's happening today</p>
                        </div>
                    </div>

                    <!-- Header Actions -->
                    <div class="flex items-center gap-3">
                        <!-- Search -->
                        <div
                            class="hidden md:flex items-center gap-2 bg-white/10 rounded-xl px-4 py-2 border border-white/20">
                            <i data-lucide="search" class="w-4 h-4 text-white/60"></i>
                            <input type="text" placeholder="Search..." x-model="searchQuery"
                                @input="handleSearch()"
                                class="bg-transparent text-white placeholder-white/60 text-sm outline-none w-32 lg:w-48">
                            <kbd class="bg-white/10 text-white/60 text-xs px-2 py-1 rounded">⌘K</kbd>
                        </div>

                        <!-- Theme Toggle -->
                        <button @click="toggleTheme()"
                            class="p-2 rounded-xl hover:bg-white/10 transition-colors "
                            data-tooltip="Toggle theme">
                            <i data-lucide="sun" x-show="!darkMode" class="w-5 h-5 text-white"></i>
                            <i data-lucide="moon" x-show="darkMode" class="w-5 h-5 text-white"></i>
                        </button>

                        <!-- Notifications -->
                        <button @click="toggleNotifications()"
                            class="relative p-2 rounded-xl hover:bg-white/10 transition-colors">
                            <i data-lucide="bell" class="w-5 h-5 text-white"></i>
                            <div x-show="notifications.length > 0"
                                class="absolute top-1 right-1 w-2 h-2 bg-red-400 rounded-full notification-badge">
                            </div>
                        </button>

                        <!-- Profile -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open"
                                class="flex items-center gap-2 p-1 rounded-xl hover:bg-white/10 transition-colors">
                                <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=32&h=32&fit=crop&crop=face&auto=format"
                                    alt="Profile" class="w-8 h-8 rounded-lg object-cover">
                            </button>

                            <!-- Profile Dropdown -->
                            <div x-show="open" @click.away="open = false"
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 scale-95"
                                x-transition:enter-end="opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="opacity-100 scale-100"
                                x-transition:leave-end="opacity-0 scale-95"
                                class="absolute right-0 mt-2 w-48 glass rounded-xl shadow-lg py-2 z-50">
                                <a href="#"
                                    class="block px-4 py-2 text-white hover:bg-white/10 transition-colors">Profile</a>
                                <a href="#"
                                    class="block px-4 py-2 text-white hover:bg-white/10 transition-colors">Settings</a>
                                <div class="border-t border-white/10 my-2"></div>
                                <a href="#"
                                    class="block px-4 py-2 text-white hover:bg-white/10 transition-colors">Sign out</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Breadcrumb -->
                <div class="px-4 lg:px-6 pb-4">
                    <nav class="flex items-center gap-2 text-sm text-white/60">
                        <a href="#" class="hover:text-white transition-colors">Dashboard</a>
                        <i data-lucide="chevron-right" class="w-4 h-4"></i>
                        <span class="text-white capitalize" x-text="activeTab"></span>
                    </nav>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="flex-1 p-4 lg:p-6 custom-scrollbar overflow-y-auto">
                <div class="max-w-7xl mx-auto space-y-6">
                    <!-- Stats Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6"
                        x-show="activeTab === 'dashboard'" x-transition:enter="transition-all duration-500"
                        x-transition:enter-start="opacity-0 translate-y-8"
                        x-transition:enter-end="opacity-100 translate-y-0">

                        <div class="glass rounded-2xl p-6 card-hover float interactive-card"
                            style="animation-delay: 0s;" @click="showDetails('users')">
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-12 h-12 bg-blue-500/20 rounded-xl flex items-center justify-center">
                                    <i data-lucide="users" class="w-6 h-6 text-blue-400"></i>
                                </div>
                                <div class="text-green-400 text-sm font-medium flex items-center gap-1">
                                    <i data-lucide="trending-up" class="w-3 h-3"></i>
                                    +12%
                                </div>
                            </div>
                            <h3 class="text-2xl font-bold text-white mb-1" x-text="stats.users.toLocaleString()">
                                12,384</h3>
                            <p class="text-white/60 text-sm">Total Users</p>
                            <div class="mt-4 h-1 bg-white/10 rounded-full overflow-hidden">
                                <div class="h-full bg-gradient-to-r from-blue-400 to-blue-600 rounded-full progress-bar"
                                    style="width: 75%;"></div>
                            </div>
                        </div>

                        <div class="glass rounded-2xl p-6 card-hover float interactive-card"
                            style="animation-delay: 0.2s;" @click="showDetails('revenue')">
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-12 h-12 bg-green-500/20 rounded-xl flex items-center justify-center">
                                    <i data-lucide="trending-up" class="w-6 h-6 text-green-400"></i>
                                </div>
                                <div class="text-green-400 text-sm font-medium flex items-center gap-1">
                                    <i data-lucide="trending-up" class="w-3 h-3"></i>
                                    +23%
                                </div>
                            </div>
                            <h3 class="text-2xl font-bold text-white mb-1">$<span
                                    x-text="stats.revenue.toLocaleString()">48,392</span></h3>
                            <p class="text-white/60 text-sm">Total Revenue</p>
                            <div class="mt-4 h-1 bg-white/10 rounded-full overflow-hidden">
                                <div class="h-full bg-gradient-to-r from-green-400 to-green-600 rounded-full progress-bar"
                                    style="width: 60%;"></div>
                            </div>
                        </div>

                        <div class="glass rounded-2xl p-6 card-hover float interactive-card"
                            style="animation-delay: 0.4s;" @click="showDetails('orders')">
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-12 h-12 bg-purple-500/20 rounded-xl flex items-center justify-center">
                                    <i data-lucide="shopping-bag" class="w-6 h-6 text-purple-400"></i>
                                </div>
                                <div class="text-red-400 text-sm font-medium flex items-center gap-1">
                                    <i data-lucide="trending-down" class="w-3 h-3"></i>
                                    -5%
                                </div>
                            </div>
                            <h3 class="text-2xl font-bold text-white mb-1" x-text="stats.orders.toLocaleString()">
                                2,847</h3>
                            <p class="text-white/60 text-sm">Total Orders</p>
                            <div class="mt-4 h-1 bg-white/10 rounded-full overflow-hidden">
                                <div class="h-full bg-gradient-to-r from-purple-400 to-purple-600 rounded-full progress-bar"
                                    style="width: 45%;"></div>
                            </div>
                        </div>

                        <div class="glass rounded-2xl p-6 card-hover float interactive-card"
                            style="animation-delay: 0.6s;" @click="showDetails('active')">
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-12 h-12 bg-yellow-500/20 rounded-xl flex items-center justify-center">
                                    <i data-lucide="activity" class="w-6 h-6 text-yellow-400"></i>
                                </div>
                                <div class="text-yellow-400 text-sm font-medium flex items-center gap-1">
                                    <div class="w-2 h-2 bg-yellow-400 rounded-full animate-pulse"></div>
                                    Live
                                </div>
                            </div>
                            <h3 class="text-2xl font-bold text-white mb-1"
                                x-text="stats.activeUsers.toLocaleString()">847</h3>
                            <p class="text-white/60 text-sm">Active Users</p>
                            <div class="mt-4 h-1 bg-white/10 rounded-full overflow-hidden">
                                <div class="h-full bg-gradient-to-r from-yellow-400 to-yellow-600 rounded-full pulse-slow progress-bar"
                                    style="width: 85%;"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Charts Section -->
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6" x-show="activeTab === 'dashboard'"
                        x-transition:enter="transition-all duration-500 delay-200"
                        x-transition:enter-start="opacity-0 translate-y-8"
                        x-transition:enter-end="opacity-100 translate-y-0">

                        <!-- Main Chart -->
                        <div class="lg:col-span-2 glass rounded-2xl p-6 card-hover">
                            <div class="flex items-center justify-between mb-6">
                                <div>
                                    <h3 class="text-xl font-bold text-white mb-1">Revenue Analytics</h3>
                                    <p class="text-white/60 text-sm">Monthly revenue breakdown</p>
                                </div>
                                <div class="flex items-center gap-2">
                                    <select
                                        class="bg-white/10 text-white text-sm px-3 py-2 rounded-lg border border-white/20 outline-none">
                                        <option value="monthly">Monthly</option>
                                        <option value="weekly">Weekly</option>
                                        <option value="daily">Daily</option>
                                    </select>
                                    <button
                                        class="btn-modern text-white text-sm px-4 py-2 rounded-xl flex items-center gap-2">
                                        <i data-lucide="download" class="w-4 h-4"></i>
                                        Export
                                    </button>
                                </div>
                            </div>
                            <div class="h-64 relative">
                                <canvas id="revenueChart" class="w-full h-full"></canvas>
                            </div>
                        </div>

                        <!-- Quick Stats -->
                        <div class="space-y-6">
                            <!-- Recent Activity -->
                            <div class="glass rounded-2xl p-6">
                                <div class="flex items-center justify-between mb-4">
                                    <h3 class="text-lg font-bold text-white">Recent Activity</h3>
                                    <button class="text-white/60 hover:text-white transition-colors">
                                        <i data-lucide="more-horizontal" class="w-5 h-5"></i>
                                    </button>
                                </div>
                                <div class="space-y-4">
                                    <template x-for="activity in recentActivity" :key="activity.id">
                                        <div
                                            class="flex items-center gap-3 p-3 rounded-xl hover:bg-white/5 transition-colors">
                                            <div class="w-8 h-8 rounded-lg flex items-center justify-center"
                                                :class="activity.iconBg">
                                                <i :data-lucide="activity.icon" class="w-4 h-4"
                                                    :class="activity.iconColor"></i>
                                            </div>
                                            <div class="flex-1">
                                                <p class="text-white text-sm font-medium" x-text="activity.title"></p>
                                                <p class="text-white/60 text-xs" x-text="activity.time"></p>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </div>

                            <!-- Quick Actions -->
                            <div class="glass rounded-2xl p-6">
                                <h3 class="text-lg font-bold text-white mb-4">Quick Actions</h3>
                                <div class="grid grid-cols-2 gap-3">
                                    <button
                                        class="btn-modern p-3 rounded-xl text-white text-sm font-medium flex items-center justify-center gap-2 hover:scale-105 transition-transform">
                                        <i data-lucide="plus" class="w-4 h-4"></i>
                                        Add User
                                    </button>
                                    <button
                                        class="bg-white/10 hover:bg-white/20 p-3 rounded-xl text-white text-sm font-medium flex items-center justify-center gap-2 border border-white/20 hover:scale-105 transition-all">
                                        <i data-lucide="mail" class="w-4 h-4"></i>
                                        Send Mail
                                    </button>
                                    <button
                                        class="bg-white/10 hover:bg-white/20 p-3 rounded-xl text-white text-sm font-medium flex items-center justify-center gap-2 border border-white/20 hover:scale-105 transition-all">
                                        <i data-lucide="file-text" class="w-4 h-4"></i>
                                        Reports
                                    </button>
                                    <button
                                        class="bg-white/10 hover:bg-white/20 p-3 rounded-xl text-white text-sm font-medium flex items-center justify-center gap-2 border border-white/20 hover:scale-105 transition-all">
                                        <i data-lucide="settings" class="w-4 h-4"></i>
                                        Settings
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Analytics Tab Content -->
                    <div x-show="activeTab === 'analytics'" x-transition:enter="transition-all duration-500"
                        x-transition:enter-start="opacity-0 translate-y-8"
                        x-transition:enter-end="opacity-100 translate-y-0" class="space-y-6">

                        <div class="glass rounded-2xl p-6">
                            <h2 class="text-2xl font-bold text-white mb-6">Analytics Dashboard</h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                <div class="bg-white/5 rounded-xl p-4 hover:bg-white/10 transition-colors">
                                    <div class="flex items-center gap-3 mb-3">
                                        <div
                                            class="w-10 h-10 bg-blue-500/20 rounded-lg flex items-center justify-center">
                                            <i data-lucide="eye" class="w-5 h-5 text-blue-400"></i>
                                        </div>
                                        <div>
                                            <h4 class="text-white font-medium">Page Views</h4>
                                            <p class="text-white/60 text-sm">Last 30 days</p>
                                        </div>
                                    </div>
                                    <div class="text-2xl font-bold text-white mb-2">1,234,567</div>
                                    <div class="flex items-center gap-2 text-sm">
                                        <span class="text-green-400">+15.3%</span>
                                        <span class="text-white/60">vs last month</span>
                                    </div>
                                </div>

                                <div class="bg-white/5 rounded-xl p-4 hover:bg-white/10 transition-colors">
                                    <div class="flex items-center gap-3 mb-3">
                                        <div
                                            class="w-10 h-10 bg-green-500/20 rounded-lg flex items-center justify-center">
                                            <i data-lucide="mouse-pointer-click" class="w-5 h-5 text-green-400"></i>
                                        </div>
                                        <div>
                                            <h4 class="text-white font-medium">Click Rate</h4>
                                            <p class="text-white/60 text-sm">Average CTR</p>
                                        </div>
                                    </div>
                                    <div class="text-2xl font-bold text-white mb-2">3.42%</div>
                                    <div class="flex items-center gap-2 text-sm">
                                        <span class="text-green-400">+0.8%</span>
                                        <span class="text-white/60">vs last month</span>
                                    </div>
                                </div>

                                <div class="bg-white/5 rounded-xl p-4 hover:bg-white/10 transition-colors">
                                    <div class="flex items-center gap-3 mb-3">
                                        <div
                                            class="w-10 h-10 bg-purple-500/20 rounded-lg flex items-center justify-center">
                                            <i data-lucide="clock" class="w-5 h-5 text-purple-400"></i>
                                        </div>
                                        <div>
                                            <h4 class="text-white font-medium">Avg. Session</h4>
                                            <p class="text-white/60 text-sm">Duration</p>
                                        </div>
                                    </div>
                                    <div class="text-2xl font-bold text-white mb-2">4m 32s</div>
                                    <div class="flex items-center gap-2 text-sm">
                                        <span class="text-red-400">-12s</span>
                                        <span class="text-white/60">vs last month</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Users Tab Content -->
                    <div x-show="activeTab === 'users'" x-transition:enter="transition-all duration-500"
                        x-transition:enter-start="opacity-0 translate-y-8"
                        x-transition:enter-end="opacity-100 translate-y-0" class="space-y-6">

                        <div class="glass rounded-2xl p-6">
                            <div class="flex items-center justify-between mb-6">
                                <h2 class="text-2xl font-bold text-white">User Management</h2>
                                <button class="btn-modern px-4 py-2 rounded-xl text-white flex items-center gap-2">
                                    <i data-lucide="user-plus" class="w-4 h-4"></i>
                                    Add User
                                </button>
                            </div>

                            <!-- User Table -->
                            <div class="overflow-x-auto">
                                <table class="w-full">
                                    <thead>
                                        <tr class="border-b border-white/10">
                                            <th class="text-left text-white/60 font-medium py-3 px-4">User</th>
                                            <th class="text-left text-white/60 font-medium py-3 px-4">Email</th>
                                            <th class="text-left text-white/60 font-medium py-3 px-4">Role</th>
                                            <th class="text-left text-white/60 font-medium py-3 px-4">Status</th>
                                            <th class="text-left text-white/60 font-medium py-3 px-4">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <template x-for="user in users" :key="user.id">
                                            <tr class="border-b border-white/5 hover:bg-white/5 transition-colors">
                                                <td class="py-4 px-4">
                                                    <div class="flex items-center gap-3">
                                                        <img :src="user.avatar" :alt="user.name"
                                                            class="w-10 h-10 rounded-xl object-cover">
                                                        <div>
                                                            <div class="text-white font-medium" x-text="user.name">
                                                            </div>
                                                            <div class="text-white/60 text-sm" x-text="user.username">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="py-4 px-4 text-white/80" x-text="user.email"></td>
                                                <td class="py-4 px-4">
                                                    <span class="px-3 py-1 rounded-full text-xs font-medium"
                                                        :class="user.role === 'admin' ? 'bg-red-500/20 text-red-400' : user
                                                            .role === 'manager' ? 'bg-blue-500/20 text-blue-400' :
                                                            'bg-gray-500/20 text-gray-400'"
                                                        x-text="user.role"></span>
                                                </td>
                                                <td class="py-4 px-4">
                                                    <span class="px-3 py-1 rounded-full text-xs font-medium"
                                                        :class="user.status === 'active' ? 'bg-green-500/20 text-green-400' :
                                                            'bg-red-500/20 text-red-400'"
                                                        x-text="user.status"></span>
                                                </td>
                                                <td class="py-4 px-4">
                                                    <div class="flex items-center gap-2">
                                                        <button
                                                            class="p-2 rounded-lg hover:bg-white/10 transition-colors">
                                                            <i data-lucide="edit" class="w-4 h-4 text-white/60"></i>
                                                        </button>
                                                        <button
                                                            class="p-2 rounded-lg hover:bg-white/10 transition-colors">
                                                            <i data-lucide="trash-2" class="w-4 h-4 text-red-400"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </template>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Projects Tab Content -->
                    <div x-show="activeTab === 'projects'" x-transition:enter="transition-all duration-500"
                        x-transition:enter-start="opacity-0 translate-y-8"
                        x-transition:enter-end="opacity-100 translate-y-0" class="space-y-6">

                        <div class="glass rounded-2xl p-6">
                            <div class="flex items-center justify-between mb-6">
                                <h2 class="text-2xl font-bold text-white">Projects</h2>
                                <button class="btn-modern px-4 py-2 rounded-xl text-white flex items-center gap-2">
                                    <i data-lucide="folder-plus" class="w-4 h-4"></i>
                                    New Project
                                </button>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                <template x-for="project in projects" :key="project.id">
                                    <div
                                        class="bg-white/5 rounded-xl p-6 hover:bg-white/10 transition-all hover:scale-105 cursor-pointer">
                                        <div class="flex items-center justify-between mb-4">
                                            <div class="w-12 h-12 rounded-xl flex items-center justify-center"
                                                :class="project.iconBg">
                                                <i :data-lucide="project.icon" class="w-6 h-6"
                                                    :class="project.iconColor"></i>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <div
                                                    class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center">
                                                    <span class="text-white text-xs font-medium"
                                                        x-text="project.team"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <h3 class="text-white font-bold text-lg mb-2" x-text="project.name"></h3>
                                        <p class="text-white/60 text-sm mb-4" x-text="project.description"></p>
                                        <div class="flex items-center justify-between mb-3">
                                            <span class="text-white/60 text-sm">Progress</span>
                                            <span class="text-white text-sm font-medium"
                                                x-text="project.progress + '%'"></span>
                                        </div>
                                        <div class="h-2 bg-white/10 rounded-full overflow-hidden">
                                            <div class="h-full bg-gradient-to-r from-blue-400 to-purple-500 rounded-full transition-all duration-1000"
                                                :style="'width: ' + project.progress + '%'"></div>
                                        </div>
                                        <div class="flex items-center justify-between mt-4">
                                            <span class="px-3 py-1 rounded-full text-xs font-medium"
                                                :class="project.status === 'active' ? 'bg-green-500/20 text-green-400' :
                                                    project.status === 'pending' ?
                                                    'bg-yellow-500/20 text-yellow-400' : 'bg-red-500/20 text-red-400'"
                                                x-text="project.status"></span>
                                            <span class="text-white/60 text-sm" x-text="project.deadline"></span>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>

                    <!-- Messages Tab Content -->
                    <div x-show="activeTab === 'messages'" x-transition:enter="transition-all duration-500"
                        x-transition:enter-start="opacity-0 translate-y-8"
                        x-transition:enter-end="opacity-100 translate-y-0" class="space-y-6">

                        <div class="glass rounded-2xl p-6">
                            <h2 class="text-2xl font-bold text-white mb-6">Messages</h2>
                            <div class="space-y-4">
                                <template x-for="message in messages" :key="message.id">
                                    <div
                                        class="flex items-start gap-4 p-4 rounded-xl hover:bg-white/5 transition-colors cursor-pointer">
                                        <img :src="message.avatar" :alt="message.sender"
                                            class="w-12 h-12 rounded-xl object-cover">
                                        <div class="flex-1">
                                            <div class="flex items-center justify-between mb-2">
                                                <h4 class="text-white font-medium" x-text="message.sender"></h4>
                                                <span class="text-white/60 text-sm" x-text="message.time"></span>
                                            </div>
                                            <p class="text-white/80 text-sm mb-2" x-text="message.subject"></p>
                                            <p class="text-white/60 text-sm" x-text="message.preview"></p>
                                        </div>
                                        <div x-show="!message.read" class="w-3 h-3 bg-blue-400 rounded-full"></div>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Notification Panel -->
    <div x-show="showNotifications" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-x-full" x-transition:enter-end="opacity-100 translate-x-0"
        x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 translate-x-0"
        x-transition:leave-end="opacity-0 translate-x-full"
        class="fixed right-0 top-0 h-full w-80 glass z-50 p-6 overflow-y-auto custom-scrollbar">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-bold text-white">Notifications</h3>
            <button @click="toggleNotifications()" class="p-2 rounded-lg hover:bg-white/10 transition-colors">
                <i data-lucide="x" class="w-5 h-5 text-white"></i>
            </button>
        </div>
        <div class="space-y-4">
            <template x-for="notification in notifications" :key="notification.id">
                <div class="p-4 rounded-xl bg-white/5 hover:bg-white/10 transition-colors">
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center" :class="notification.iconBg">
                            <i :data-lucide="notification.icon" class="w-4 h-4" :class="notification.iconColor"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-white text-sm font-medium mb-1" x-text="notification.title"></p>
                            <p class="text-white/60 text-xs" x-text="notification.message"></p>
                            <span class="text-white/40 text-xs" x-text="notification.time"></span>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>

    <script src="{{ asset('assets/js/lucide-icon.js') }}"></script>
    <script>
        lucide.createIcons();
    </script>

    <script>
        function dashboardData() {
            return {
                // Responsive state
                desktop: window.innerWidth >= 1024,
                sidebar_expanded: window.innerWidth >= 1024,
                mobile_menu_open: false,

                // App state
                activeTab: 'dashboard',
                searchQuery: '',
                darkMode: true,
                showNotifications: false,

                // Data
                stats: {
                    users: 12384,
                    revenue: 48392,
                    orders: 2847,
                    activeUsers: 847
                },

                recentActivity: [{
                        id: 1,
                        title: 'New user registered',
                        time: '2 minutes ago',
                        icon: 'user-plus',
                        iconBg: 'bg-green-500/20',
                        iconColor: 'text-green-400'
                    },
                    {
                        id: 2,
                        title: 'Payment received',
                        time: '5 minutes ago',
                        icon: 'credit-card',
                        iconBg: 'bg-blue-500/20',
                        iconColor: 'text-blue-400'
                    },
                    {
                        id: 3,
                        title: 'Order completed',
                        time: '10 minutes ago',
                        icon: 'check-circle',
                        iconBg: 'bg-purple-500/20',
                        iconColor: 'text-purple-400'
                    },
                    {
                        id: 4,
                        title: 'New message received',
                        time: '15 minutes ago',
                        icon: 'mail',
                        iconBg: 'bg-yellow-500/20',
                        iconColor: 'text-yellow-400'
                    }
                ],

                users: [{
                        id: 1,
                        name: 'John Doe',
                        username: '@johndoe',
                        email: 'john@example.com',
                        role: 'admin',
                        status: 'active',
                        avatar: 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=40&h=40&fit=crop&crop=face&auto=format'
                    },
                    {
                        id: 2,
                        name: 'Jane Smith',
                        username: '@janesmith',
                        email: 'jane@example.com',
                        role: 'manager',
                        status: 'active',
                        avatar: 'https://images.unsplash.com/photo-1494790108755-2616b612b786?w=40&h=40&fit=crop&crop=face&auto=format'
                    },
                    {
                        id: 3,
                        name: 'Mike Johnson',
                        username: '@mikej',
                        email: 'mike@example.com',
                        role: 'user',
                        status: 'inactive',
                        avatar: 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=40&h=40&fit=crop&crop=face&auto=format'
                    },
                    {
                        id: 4,
                        name: 'Sarah Wilson',
                        username: '@sarahw',
                        email: 'sarah@example.com',
                        role: 'manager',
                        status: 'active',
                        avatar: 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=40&h=40&fit=crop&crop=face&auto=format'
                    },
                    {
                        id: 5,
                        name: 'David Brown',
                        username: '@davidb',
                        email: 'david@example.com',
                        role: 'user',
                        status: 'active',
                        avatar: 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=40&h=40&fit=crop&crop=face&auto=format'
                    }
                ],

                projects: [{
                        id: 1,
                        name: 'Website Redesign',
                        description: 'Complete overhaul of company website with modern design',
                        progress: 75,
                        status: 'active',
                        deadline: 'Dec 31, 2024',
                        team: '5',
                        icon: 'globe',
                        iconBg: 'bg-blue-500/20',
                        iconColor: 'text-blue-400'
                    },
                    {
                        id: 2,
                        name: 'Mobile App',
                        description: 'Native iOS and Android application development',
                        progress: 45,
                        status: 'active',
                        deadline: 'Feb 15, 2025',
                        team: '8',
                        icon: 'smartphone',
                        iconBg: 'bg-green-500/20',
                        iconColor: 'text-green-400'
                    },
                    {
                        id: 3,
                        name: 'API Integration',
                        description: 'Third-party service integration and optimization',
                        progress: 90,
                        status: 'pending',
                        deadline: 'Nov 30, 2024',
                        team: '3',
                        icon: 'zap',
                        iconBg: 'bg-purple-500/20',
                        iconColor: 'text-purple-400'
                    },
                    {
                        id: 4,
                        name: 'Database Migration',
                        description: 'Migrate legacy database to new infrastructure',
                        progress: 20,
                        status: 'active',
                        deadline: 'Jan 20, 2025',
                        team: '4',
                        icon: 'database',
                        iconBg: 'bg-yellow-500/20',
                        iconColor: 'text-yellow-400'
                    },
                    {
                        id: 5,
                        name: 'Security Audit',
                        description: 'Comprehensive security review and improvements',
                        progress: 60,
                        status: 'active',
                        deadline: 'Dec 15, 2024',
                        team: '2',
                        icon: 'shield',
                        iconBg: 'bg-red-500/20',
                        iconColor: 'text-red-400'
                    },
                    {
                        id: 6,
                        name: 'Performance Optimization',
                        description: 'Optimize application performance and loading times',
                        progress: 35,
                        status: 'pending',
                        deadline: 'Mar 10, 2025',
                        team: '6',
                        icon: 'activity',
                        iconBg: 'bg-indigo-500/20',
                        iconColor: 'text-indigo-400'
                    }
                ],

                messages: [{
                        id: 1,
                        sender: 'Alice Johnson',
                        subject: 'Project Update Required',
                        preview: 'Hi there! Can you please provide an update on the current project status...',
                        time: '2 hours ago',
                        read: false,
                        avatar: 'https://images.unsplash.com/photo-1494790108755-2616b612b786?w=40&h=40&fit=crop&crop=face&auto=format'
                    },
                    {
                        id: 2,
                        sender: 'Mark Thompson',
                        subject: 'Budget Approval Needed',
                        preview: 'The Q4 budget proposal is ready for your review and approval...',
                        time: '4 hours ago',
                        read: false,
                        avatar: 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=40&h=40&fit=crop&crop=face&auto=format'
                    },
                    {
                        id: 3,
                        sender: 'Lisa Chen',
                        subject: 'Team Meeting Scheduled',
                        preview: 'Our weekly team meeting has been scheduled for tomorrow at 10 AM...',
                        time: '6 hours ago',
                        read: true,
                        avatar: 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=40&h=40&fit=crop&crop=face&auto=format'
                    },
                    {
                        id: 4,
                        sender: 'Robert Davis',
                        subject: 'New Feature Request',
                        preview: 'We have received a new feature request from our premium customers...',
                        time: '1 day ago',
                        read: true,
                        avatar: 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=40&h=40&fit=crop&crop=face&auto=format'
                    },
                    {
                        id: 5,
                        sender: 'Emma Wilson',
                        subject: 'Performance Report',
                        preview: 'The monthly performance report is now available for review...',
                        time: '2 days ago',
                        read: true,
                        avatar: 'https://images.unsplash.com/photo-1517841905240-472988babdf9?w=40&h=40&fit=crop&crop=face&auto=format'
                    }
                ],

                notifications: [{
                        id: 1,
                        title: 'System Update',
                        message: 'System maintenance scheduled for tonight',
                        time: '5 minutes ago',
                        icon: 'settings',
                        iconBg: 'bg-blue-500/20',
                        iconColor: 'text-blue-400'
                    },
                    {
                        id: 2,
                        title: 'New Comment',
                        message: 'Someone commented on your post',
                        time: '10 minutes ago',
                        icon: 'message-circle',
                        iconBg: 'bg-green-500/20',
                        iconColor: 'text-green-400'
                    },
                    {
                        id: 3,
                        title: 'Security Alert',
                        message: 'New login from unknown device',
                        time: '1 hour ago',
                        icon: 'shield-alert',
                        iconBg: 'bg-red-500/20',
                        iconColor: 'text-red-400'
                    }
                ],

                // Methods
                init() {
                    this.handleResize();
                    this.initChart();
                    window.addEventListener('resize', () => this.handleResize());

                    // Keyboard shortcuts
                    document.addEventListener('keydown', (e) => {
                        if ((e.metaKey || e.ctrlKey) && e.key === 'k') {
                            e.preventDefault();
                            this.focusSearch();
                        }
                    });
                },

                handleResize() {
                    this.desktop = window.innerWidth >= 1024;
                    if (this.desktop) {
                        this.mobile_menu_open = false;
                        this.sidebar_expanded = true;
                    } else {
                        this.sidebar_expanded = false;
                    }
                },

                toggleSidebar() {
                    if (this.desktop) {
                        this.sidebar_expanded = !this.sidebar_expanded;
                    } else {
                        this.mobile_menu_open = !this.mobile_menu_open;
                    }
                },

                closeMobileMenu() {
                    if (!this.desktop) {
                        this.mobile_menu_open = false;
                    }
                },

                setActiveTab(tab) {
                    this.activeTab = tab;
                    this.closeMobileMenu();

                    // Reinitialize chart if switching to dashboard
                    if (tab === 'dashboard') {
                        this.$nextTick(() => {
                            this.initChart();
                        });
                    }
                },

                toggleTheme() {
                    this.darkMode = !this.darkMode;
                    // Add theme switching logic here
                    console.log('Theme toggled:', this.darkMode ? 'dark' : 'light');
                },

                toggleNotifications() {
                    this.showNotifications = !this.showNotifications;
                },

                handleSearch() {
                    if (this.searchQuery.length > 0) {
                        console.log('Searching for:', this.searchQuery);
                        // Add search logic here
                    }
                },

                focusSearch() {
                    const searchInput = document.querySelector('input[type="text"]');
                    if (searchInput) {
                        searchInput.focus();
                    }
                },

                showDetails(type) {
                    console.log('Showing details for:', type);
                    // Add modal or detailed view logic here
                },

                initChart() {
                    this.$nextTick(() => {
                        const canvas = document.getElementById('revenueChart');
                        if (!canvas) return;

                        const ctx = canvas.getContext('2d');

                        // Destroy existing chart if it exists
                        if (window.revenueChart instanceof Chart) {
                            window.revenueChart.destroy();
                        }

                        // Create gradient
                        const gradient = ctx.createLinearGradient(0, 0, 0, 300);
                        gradient.addColorStop(0, 'rgba(102, 126, 234, 0.8)');
                        gradient.addColorStop(1, 'rgba(118, 75, 162, 0.1)');

                        window.revenueChart = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep',
                                    'Oct', 'Nov', 'Dec'
                                ],
                                datasets: [{
                                    label: 'Revenue',
                                    data: [12000, 19000, 15000, 25000, 22000, 30000, 28000, 35000,
                                        32000, 38000, 42000, 48000
                                    ],
                                    borderColor: '#667eea',
                                    backgroundColor: gradient,
                                    borderWidth: 3,
                                    fill: true,
                                    tension: 0.4,
                                    pointBackgroundColor: '#667eea',
                                    pointBorderColor: '#ffffff',
                                    pointBorderWidth: 2,
                                    pointRadius: 6,
                                    pointHoverRadius: 8
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                plugins: {
                                    legend: {
                                        display: false
                                    }
                                },
                                scales: {
                                    x: {
                                        grid: {
                                            display: false
                                        },
                                        ticks: {
                                            color: 'rgba(255, 255, 255, 0.6)'
                                        }
                                    },
                                    y: {
                                        grid: {
                                            color: 'rgba(255, 255, 255, 0.1)'
                                        },
                                        ticks: {
                                            color: 'rgba(255, 255, 255, 0.6)',
                                            callback: function(value) {
                                                return '$' + value.toLocaleString();
                                            }
                                        }
                                    }
                                },
                                interaction: {
                                    intersect: false,
                                    mode: 'index'
                                },
                                elements: {
                                    point: {
                                        hoverBackgroundColor: '#ffffff'
                                    }
                                }
                            }
                        });
                    });
                }
            }
        }

        // Initialize Lucide icons after DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        });

        // Smooth scrolling for anchor links
        document.addEventListener('click', function(e) {
            if (e.target.matches('a[href^="#"]')) {
                e.preventDefault();
                const target = document.querySelector(e.target.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            }
        });

        // Add loading states for interactive elements
        document.addEventListener('click', function(e) {
            if (e.target.matches('.btn-modern') || e.target.closest('.btn-modern')) {
                const btn = e.target.matches('.btn-modern') ? e.target : e.target.closest('.btn-modern');
                btn.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    btn.style.transform = '';
                }, 150);
            }
        });

        // Add ripple effect to interactive cards
        document.addEventListener('click', function(e) {
            if (e.target.matches('.interactive-card') || e.target.closest('.interactive-card')) {
                const card = e.target.matches('.interactive-card') ? e.target : e.target.closest(
                    '.interactive-card');
                const rect = card.getBoundingClientRect();
                const ripple = document.createElement('span');
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;

                ripple.style.cssText = `
    position: absolute;
    width: ${size}px;
    height: ${size}px;
    left: ${x}px;
    top: ${y}px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    transform: scale(0);
    animation: ripple 0.6s ease-out;
    pointer-events: none;
    `;

                card.style.position = 'relative';
                card.style.overflow = 'hidden';
                card.appendChild(ripple);

                setTimeout(() => {
                    ripple.remove();
                }, 600);
            }
        });

        // Add CSS for ripple animation
        const style = document.createElement('style');
        style.textContent = `
    @keyframes ripple {
    to {
    transform: scale(2);
    opacity: 0;
    }
    }
    `;
        document.head.appendChild(style);
    </script>

</body>

</html>
