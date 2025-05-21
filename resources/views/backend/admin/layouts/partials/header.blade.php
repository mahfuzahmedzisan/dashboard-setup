{{-- <header class="flex items-center w-full justify-between shadow-md">
    <div class="flex items-center space-x-4">
        <!-- Sidebar Toggle Button -->
        <button @click="sidebar_expanded = !sidebar_expanded" class="flex">
            <span class="h-0.5 w-6 bg-gray-600 dark:bg-gray-300"></span>
        </button>
        <button @click="mobile_menu_open = !mobile_menu_open"
            class="lg:hidden text-gray-600 dark:text-gray-300 hover:text-blue-500 transition-colors focus:outline-none">
            <i class='bx bx-menu text-2xl'></i>
        </button>


        <!-- Logo or Title -->
        <h1 class="text-xl font-semibold text-gray-800 dark:text-white">
            Admin Dashboard
        </h1>

        <x-admin.theme-toggle />
    </div>

    <!-- User Profile / Actions -->
    <div class="flex items-center space-x-4">
        <!-- Profile Dropdown (basic display) -->
        <div class="flex items-center space-x-2">
            <img src="https://i.pravatar.cc/32" alt="User" class="w-8 h-8 rounded-full border" />
            <span class="text-sm font-medium text-gray-700 dark:text-gray-200">Admin</span>
        </div>
    </div>
</header> --}}

<header
    class="flex items-center w-full justify-between bg-bg-light-tertiary dark:bg-bg-dark-tertiary shadow px-5 rounded-xl mt-5 transition-all duration-300 ease-linear">
    <nav class="navbar min-h-auto">
        <div class="navbar-start gap-3">
            <button class="flex items-start flex-col justify-start gap-[3px]"
                @click="sidebar_expanded = !sidebar_expanded">
                <span class="h-0.5 bg-gray-600 dark:bg-gray-300 transition-all duration-300 ease-linear"
                    :class="!sidebar_expanded ? 'w-6' : 'w-3'"></span>
                <span class="h-0.5 bg-gray-600 dark:bg-gray-300 transition-all duration-300 ease-linear"
                    :class="!sidebar_expanded ? 'w-6' : 'w-5'"></span>
                <span class="h-0.5 bg-gray-600 dark:bg-gray-300 transition-all duration-300 ease-linear"
                    :class="!sidebar_expanded ? 'w-6' : 'w-4'"></span>
                <span class="h-0.5 w-6 bg-gray-600 dark:bg-gray-300 transition-all duration-300 ease-linear"></span>
            </button>
            <x-admin.search-form />
        </div>

        <div class="navbar-end">
            <x-admin.theme-toggle />
        </div>
    </nav>
</header>
