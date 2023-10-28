<?php 

namespace App\Services\Achievements;

use App\Models\User;
use App\Models\Achievement;
use App\Models\UserAchievement;
use Illuminate\Support\Facades\Log;

class UpdateUserAchievementsService
{
    private Achievement $achievement;
    private UserAchievement $user_achievement;
    public function __construct(private readonly User $user, private readonly string $achievement_type)
    {
        $this->achievement = new Achievement();
        $this->user_achievement = new UserAchievement();
    }

    public function execute(): bool
    {
        // check if user comments meet any achievements
        $achievement = $this->checkIfAchievementExists();

        // return if no achievement exists
        if($achievement->count() == 0) return true;

        // set achievement
        $this->setAchievement($achievement);

        return true;
    }

    protected function checkIfAchievementExists(): ?object
    {
        // get no. user comments
        $no_comments = $this->user->comments()->count();

        // check if achievement exists for the number of comments
        return $this->achievement->where('type', $this->achievement_type)
            ->where('points', $no_comments)
            ->first() ?? (object) [];
    }

    protected function setAchievement(Achievement $achievement) : object
    {   
        try{
            return $this->user_achievement = $this->user_achievement->create([
                'user_id' => $this->user->id,
                'achievement_id' => $achievement->id,
            ]);
        } catch (\Exception $e) {
            Log::info($e->getMessage());

            return (object) [
                'success' => false,
                'message' => $e->getMessage(),
            ];
        }
    }
}