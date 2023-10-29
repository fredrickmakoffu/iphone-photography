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

        if (!$badge) return false;

        // return if user has retrieved badge
        if ($badge->id == $this->user->id) return true;

        // set badge
        return $this->setBadge($badge);
    }

    protected function getBadgeFromUserAchievements(): ?object
    {
        // get user achievements
        $user_achievements = $this->user->achievements()->count();

        // get badge from user achievements
        return $this->badge->orderByRaw("abs(points - $user_achievements)")
            ->latest()
            ->first();
    }

    protected function setBadge(Badge $badge): bool
    {
        try {
            $this->user->update([
                'badge_id' => $badge->id,
            ]);
        } catch (\Exception $e) {
            Log::info($e->getMessage()); // if logging errors to the data, we'd log the error here

            return false;
        }

        return true;
    }
}
