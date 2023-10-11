<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
\Laravel\Sanctum\Sanctum::ignoreMigrations();  //ignore create_personal_access_tokens_table during artisan migrate

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
        //
    }
}
