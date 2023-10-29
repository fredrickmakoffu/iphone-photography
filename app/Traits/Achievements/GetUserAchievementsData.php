<?php

namespace App\Traits\Achievements;

use App\Models\User;
use App\Models\Achievement;

trait GetUserAchievementsData
{
    protected function getNextAchievements(User $user, string $achievement_type): ?object
    {
        return Achievement::where('type', $achievement_type)
            ->where('points', '>', $user->achievements()->count())
            ->first();
    }
}
