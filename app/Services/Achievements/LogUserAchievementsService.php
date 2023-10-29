<?php

namespace App\Services\Achievements;

use App\Models\User;
use App\Models\Achievement;
use App\Models\UserAchievement;
use Illuminate\Support\Facades\Log;

class LogUserAchievementsService
{
    private Achievement $achievement;
    private UserAchievement $user_achievement;

    public function __construct(private readonly User $user)
    {
        $this->achievement = new Achievement();
        $this->user_achievement = new UserAchievement();
    }

    public function execute(string $achievement_type): bool
    {
        // check if user comments meet any achievements
        $achievement = $this->checkIfAchievementExists($achievement_type, $this->user);

        //  return if no achievement exists
        if (!$achievement) return false;

        //  set achievement
        return $this->setAchievement($achievement, $this->user);
    }

    public function checkIfAchievementExists(string $achievement_type, User $user): ?object
    {
        // get no. user comments
        $achievement_count = $this->countAchievementByType($achievement_type, $user);

        // check if achievement exists for the number of comments
        return $this->achievement->where('type', $achievement_type)
            ->where('points', $achievement_count)
            ->first();
    }

    public function setAchievement(Achievement $achievement, User $user): bool
    {
        try {
            $this->user_achievement = $this->user_achievement->create([
                'user_id' => $user->id,
                'achievement_id' => $achievement->id,
            ]);
        } catch (\Exception $e) {
            Log::info($e->getMessage()); // if logging errors to the data, we'd log the error here

            return false;
        }

        return true;
    }

    protected function countAchievementByType(string $achievement_type, User $user)
    {
        switch ($achievement_type) {
            case 'comment':
                return $user->comments()->count();
                break;

            case 'lesson':
                return $user->lessons()->count();
                break;

            default:
                return 0;
                break;
        }
    }
}
