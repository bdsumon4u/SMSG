<?php

namespace App\Providers;

use App\Sidebar\MainSidebar;
use App\View\Composers\SidebarCreator;
use Hotash\Sidebar\SidebarManager;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
    public function boot(SidebarManager $sidebar): void
    {
        $sidebar->register(MainSidebar::class);

        View::creator('components.sidebar.secondary', SidebarCreator::class);
    }
}
