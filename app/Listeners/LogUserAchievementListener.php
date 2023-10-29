<?php

namespace App\Listeners;

use App\Events\AchievementUnlocked;
use App\Services\Achievements\LogUserAchievementsService;

class LogUserAchievementListener
{
    /**
     * Handle the event.
     */
    public function handle(AchievementUnlocked $event): void
    {
        (new LogUserAchievementsService($event->user))->execute($event->achievement_type);
    }
}
