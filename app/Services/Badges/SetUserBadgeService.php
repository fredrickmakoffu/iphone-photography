<?php

namespace App\Services\Badges;

use App\Models\Badge;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SetUserBadgeService
{
    private Badge $badge;
    public function __construct(private readonly User $user)
    {
        $this->badge = new Badge();
    }

    public function execute(): bool
    {
        // get badge
        $badge = $this->getBadgeFromUserAchievements();

        // return if user has retrieved badge
        if($badge->id == $this->user->id) return true;

        // set badge
        $this->setBadge($badge);

        return true;
    }

    protected function getBadgeFromUserAchievements() : ?object
    {
        // get user achievements
        $user_achievements = $this->user->achievements()->count();

        // get badge from user achievements
        return $this->badge->orderByRaw("abs(points - $user_achievements)")
            ->latest()
            ->first();
    }

    protected function setBadge(Badge $badge) : object
    {   
        try{
            $this->user->update([
                'badge_id' => $badge->id,
            ]);
        } catch (\Exception $e) {
            return (object) [
                'success' => false,
                'message' => $e->getMessage(),
            ];
        }

        return (object) [
            'success' => true,
            'message' => 'Badge set successfully',
        ];
    }
}