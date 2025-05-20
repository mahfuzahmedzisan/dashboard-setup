<x-frontend-layout>
    <div
        class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-[#FDFDFC] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
        <div>
            <h1 class="text-4xl font-bold">Welcome to {{ config('app.name', 'Dashboard') }}</h1>

            <p class="mt-4 text-lg font-semibold text-center">Auth Routes</p>
            <div class="flex items-center justify-center mt-4 gap-4">
                @auth('web')
                    <a href="{{ url('/dashboard') }}" class="btn btn-accent">Dashboard</a>
                @else
                    <a href="{{ url('/login') }}" class="btn btn-neutral">Login</a>
                    <a href="{{ url('/register') }}" class="btn btn-primary">Register</a>
                @endauth
                @auth('admin')
                    <a href="{{ url('/admin/dashboard') }}" class="btn btn-info">Admin Dashboard</a>
                @else
                    <a href="{{ url('/admin/login') }}" class="btn btn-secondary">Login</a>
                @endauth
            </div>
        </div>
    </div>
</x-frontend-layout>
