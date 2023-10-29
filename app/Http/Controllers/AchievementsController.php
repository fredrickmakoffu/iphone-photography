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
                'comments' => $this->getNextAchievements($user, 'comment')->description,
                'lessons' => $this->getNextAchievements($user, 'lesson')->description,
            ],
            'current_badge' => $user->badge->description ?? $next_badge->description ?? null, // if user has no badge, next badge will be the beginner badge
            'next_badge' => $next_badge->description ?? null,
            'remaing_to_unlock_next_badge' => $next_badge->points - $user->achievements()->count()
        ]);
    }
}
