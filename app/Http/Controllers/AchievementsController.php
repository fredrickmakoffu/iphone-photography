<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use App\Traits\Achievements\GetUserAchievementsData;
use App\Traits\Badges\GetUserBadgesData;

class AchievementsController extends Controller
{
    use GetUserAchievementsData, GetUserBadgesData;

    public function index(User $user): JsonResponse
    {
        $next_badge = $this->getNextBadge($user);

        return response()->json([
            'unlocked_achievements' => $user->achievements()->pluck('description')->toArray(),
            'next_available_achievements' => [
                'comments' => $this->getNextAchievements($user, 'comment')->description ?? 'No more achievements to unlock',
                'lessons' => $this->getNextAchievements($user, 'lesson')->description ?? 'No more achievements to unlock',
            ],
            'current_badge' => $user->badge->description, // if user has no badge, next badge will be the beginner badge
            'next_badge' => $next_badge->description ?? "No more badges to unlock",
            'remaing_to_unlock_next_badge' => isset($next_badge->points)
                ? $next_badge->points - $user->achievements()->count()
                : 0,
        ]);
    }
}
