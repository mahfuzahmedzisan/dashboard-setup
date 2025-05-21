<aside
    class="fixed z-40 inset-y-0 min-h-screen h-full max-h-screen overflow-y-auto left-0 transform lg:static transition-transform duration-300 ease-in-out bg-white dark:bg-gray-900 border-r shadow-sm"
    :class="mobile_menu_open ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
    :class="sidebar_expanded ? 'w-64' : 'w-16'">

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
</aside>
