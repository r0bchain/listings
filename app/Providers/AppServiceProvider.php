<?php

namespace App\Providers;

use App\Policies\ListingPolicy;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

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
        Gate::define('update-listing', [ListingPolicy::class, 'update']);
        Gate::define('delete-listing', [ListingPolicy::class, 'delete']);

        

    }
}
