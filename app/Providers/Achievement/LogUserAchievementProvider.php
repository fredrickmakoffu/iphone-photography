<?php

namespace App\Providers\Achievement;

use Illuminate\Support\ServiceProvider;
use App\Services\Achievements\LogUserAchievementsService;

class LogUserAchievementProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(LogUserAchievementsService::class, function ($app) {
            return new LogUserAchievementsService(request()->user(), 'comment');
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
