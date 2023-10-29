<?php

namespace Tests\Unit\Badges;

use App\Models\Badge;
use Tests\TestCase;
use App\Models\User;
use App\Services\Badges\SetUserBadgeService;

class BadgesUnlockedUnitTest extends TestCase
{
    public function test_setting_user_badge()
    {
        $user = User::factory()->create();

        // pick an achievement
        $badge = Badge::find(1);

        // set achievement for user
        $assigned_badge = (new SetUserBadgeService($user))->setBadge($badge, $user);

        // assert that the achievement was set
        $this->assertTrue($user->badge_id == $badge->id);
    }
}
