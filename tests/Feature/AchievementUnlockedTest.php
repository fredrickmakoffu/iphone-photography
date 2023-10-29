<?php

namespace Tests\Feature;

use App\Models\User;
// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AchievementUnlockedTest extends TestCase
{
    /**
     * Test if a new user, after adding one comment and watching one lesson, has two achievements.
     */
    public function test_achievements_unlock_correctly(): void
    {
        $user = User::factory()->create();

        // login user and get token
        $token = $this->post('/api/login', [
            'email' => $user->email,
            'password' => 'password',
        ])->json('token');

        // create comment with POST
        $this->post('/api/comment', [
            'body' => 'This is a comments'
        ], [
            'Authorization' => "Bearer $token",
        ]);

        // We expect the user to have unlocked the "First Comment" achievement
        $unlocked_achievements = $this->get("/users/{$user->id}/achievements")->json('unlocked_achievements');

        // if we don't have the "First Comment" achievement, the test fails
        $this->assertContains('First Comment Written', $unlocked_achievements);

        // create comment with POST
        $this->post('/api/lessons-watched', [
            "lesson_id" => 1,
            "watched" => true
        ], [
            'Authorization' => "Bearer $token",
        ]);

        // We expect the user to have unlocked the "First Lesson Watched" achievement
        $unlocked_achievements = $this->get("/users/{$user->id}/achievements")->json('unlocked_achievements');

        // if we don't have the "First Lesson" achievement, the test fails
        $this->assertContains('First Lesson Watched', $unlocked_achievements);
    }
}
