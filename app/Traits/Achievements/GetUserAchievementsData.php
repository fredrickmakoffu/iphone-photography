<?php

namespace App\Traits\Achievements;

use App\Models\User;
use App\Models\Achievement;
use App\Models\UserAchievement;
use Illuminate\Support\Facades\Log;

trait GetUserAchievementsData
{
    protected function getNextAchievements(User $user, string $achievement_type): ?object
    {
        $latest_achievement = $this->getLatestAchievement($user, $achievement_type);

        return Achievement::where('type', $achievement_type)
            ->where('id', '>', $latest_achievement)
            ->orderBy('points', 'asc') // in case achievements were not created in order,
            ->first();
    }

    protected function getLatestAchievement(User $user, string $achievement_type): int
    {
        return UserAchievement::where('user_id', $user->id)
            ->join('achievements', 'achievements.id', '=', 'user_achievements.achievement_id')
            ->where('achievements.type', $achievement_type)
            ->orderBy('user_achievements.created_at', 'desc')
            ->first()->id ?? 0;
    }
}
