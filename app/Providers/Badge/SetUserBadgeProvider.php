<?php

namespace App\Providers\Badge;

use Illuminate\Support\ServiceProvider;
use App\Services\Badges\SetUserBadgeService;

class SetUserBadgeProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(SetUserBadgeService::class, function ($app) {
            return new SetUserBadgeService(request()->user());
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
