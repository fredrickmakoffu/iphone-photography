<?php

namespace Tests\Unit\Achievements;

use App\Models\Achievement;
use App\Services\Achievements\LogUserAchievementsService;
use Tests\TestCase;
use App\Models\User;
use App\Models\UserAchievement;
use App\Models\Comment;
use Illuminate\Support\Facades\Log;

class AchievementsUnlockUnitTest extends TestCase
{
    // test checkIfAchievementExists function in LogUserAchievementsService
    public function test_checking_if_achievement_exists()
    {
        $user = User::factory()->create();

        // create a achievement, type comment
        $achievement = Achievement::factory()->create([
            'type' => 'comment',
            'points' => 1,
        ]);

        // create single comment
        Comment::factory()->create(['user_id' => $user->id]);

        // check if achievement exists for a single comment
        $achievement = (new LogUserAchievementsService($user))->checkIfAchievementExists($achievement->type, $user);

        // assert that the achievement exists
        $this->assertNotNull($achievement);
    }

    public function test_set_user_achievement()
    {
        $user = User::factory()->create();

        // create an achievement
        $achievement = Achievement::factory()->create();

        // set achievement
        $user_achievement = (new LogUserAchievementsService($user))->setAchievement($achievement, $user);

        // assert that the achievement was set
        $this->assertTrue($user_achievement);
    }
}
