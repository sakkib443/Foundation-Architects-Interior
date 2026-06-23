<?php

namespace App\Providers;

use App\Support\Settings;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(Settings::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Share the settings repository with every view. The object is shared
        // lazily — it only hits the database when a view actually reads a value,
        // so this is safe during migrations/console before the table exists.
        View::share('settings', $this->app->make(Settings::class));
    }
}
