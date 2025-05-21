<aside class="bg-transparent sticky top-0 left-0 h-screen z-10 p-3 pr-0 transition-all duration-300 ease-linear"
    :class="mobile_menu_open ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
    :class="sidebar_expanded ? 'w-64' : 'w-16'">

    <div class="bg-white dark:bg-gray-800 h-full shadow-lg rounded-lg transition-all duration-300 ease-linear">
        <!-- Logo (Collapsed/Expanded) -->
        <div class="flex items-center justify-center py-4">
            <i class="bx bxs-dashboard text-3xl text-blue-600"></i>
        </div>

        <!-- Nav Items -->
        <nav class="flex flex-col px-2 space-y-2">
            <a href="#"
                class="flex items-center space-x-3 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 p-2 rounded transition-all"
                :class="!sidebar_expanded && 'justify-center'">
                <i class='bx bx-home text-xl'></i>
                <span x-show="sidebar_expanded" class="text-sm font-medium">Dashboard</span>
            </a>

            <a href="#"
                class="flex items-center space-x-3 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 p-2 rounded transition-all"
                :class="!sidebar_expanded && 'justify-center'">
                <i class='bx bx-package text-xl'></i>
                <span x-show="sidebar_expanded" class="text-sm font-medium">Products</span>
            </a>

            <a href="#"
                class="flex items-center space-x-3 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 p-2 rounded transition-all"
                :class="!sidebar_expanded && 'justify-center'">
                <i class='bx bx-user text-xl'></i>
                <span x-show="sidebar_expanded" class="text-sm font-medium">Users</span>
            </a>
        </nav>

        <!-- Footer Toggle (Optional) -->
        <div class="mt-auto p-2">
            <button @click="sidebar_expanded = !sidebar_expanded"
                class="w-full text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 p-2 rounded transition-all flex items-center justify-center">
                <i class='bx bx-chevrons-left text-xl' x-show="sidebar_expanded"></i>
                <i class='bx bx-chevrons-right text-xl' x-show="!sidebar_expanded"></i>
            </button>
        </div>
    </div>
</aside>
