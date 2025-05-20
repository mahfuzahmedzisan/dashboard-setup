<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use App\View\Components\Backend\Admin\Layout as AdminLayout;
use App\View\Components\Backend\User\Layout as UserLayout;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use App\View\Components\Frontend\Layout as FrontendLayout;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $routeName = Route::currentRouteName();

        if ($routeName && str_starts_with($routeName, 'admin.')) {
            Blade::component('admin-layout', AdminLayout::class);
        }
        if ($routeName && str_starts_with($routeName, 'user.')) {
            Blade::component('user-layout', UserLayout::class);
        }
        if ($routeName && str_starts_with($routeName, 'f.')) {
            Blade::component('frontend-layout', FrontendLayout::class);
        }
    }
}
