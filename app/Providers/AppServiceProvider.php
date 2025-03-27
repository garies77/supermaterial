<?php

namespace App\Providers;

use App\Models\WebInformation;
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
    public function boot(): void
    {
        // Share webInfo with all views
        View::composer('*', function ($view) {
            $webInfo = WebInformation::first() ?? new WebInformation();
            $view->with('webInfo', $webInfo);
        });
    }
}
