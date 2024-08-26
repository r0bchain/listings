<?php

namespace App\Providers;

use App\Policies\ListingPolicy;
use App\Policies\NotificationPolicy;
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
        Gate::define('view-listing', [ListingPolicy::class, 'view']);
        Gate::define('update-listing', [ListingPolicy::class, 'update']);
        Gate::define('delete-listing', [ListingPolicy::class, 'delete']);
        Gate::define('update-accepted', [ListingPolicy::class, 'update-accepted']);
        Gate::define('mark-as-read', [NotificationPolicy::class, 'update']);


        

    }
}
