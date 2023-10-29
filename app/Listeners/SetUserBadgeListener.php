<?php

namespace App\Listeners;

use App\Events\BadgeUnlocked;
use App\Services\Badges\SetUserBadgeService;

class SetUserBadgeListener
{
    /**
     * Handle the event.
     */
    public function handle(BadgeUnlocked $event): void
    {
        (new SetUserBadgeService($event->user))->execute();
    }
}
