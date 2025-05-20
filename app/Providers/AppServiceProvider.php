<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use App\View\Components\Backend\Admin\Layout as AdminLayout;
use App\View\Components\Backend\User\Layout as UserLayout;
use Illuminate\Support\Facades\Request;

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
        if (Request::is('admin/*') && (!Request::is('admin/login', 'admin/logout'))) {
            Blade::component('admin-layout', AdminLayout::class);
        }
        if (Request::is('user/*') || Request::is('dashboard')) {
            Blade::component('user-layout', UserLayout::class);
        }
    }
}
