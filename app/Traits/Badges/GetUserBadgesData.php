<?php

namespace App\Traits\Badges;

use App\Models\User;
use App\Models\Badge;

trait GetUserBadgesData
{
    protected function getNextBadge(User $user): ?object
    {
        return Badge::where('points', '>', $user->badge->points)->first();
    }

    protected function getPointsToNextBadge(User $user, Badge $next_badge): int
    {
        return $next_badge->points - $user->achievements()->count();
    }
}
