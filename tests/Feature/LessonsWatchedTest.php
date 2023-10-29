<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class LessonsWatchedTest extends TestCase
{
    //  test comment API

    public function test_user_can_log_lesson_watched(): void
    {
        $user = User::factory()->create();

        // login user and get token
        $token = $this->post('/api/login', [
            'email' => $user->email,
            'password' => 'password',
        ])->json('token');

        // create comment with POST
        $response = $this->post('/api/lessons-watched', [
            "lesson_id" => 1,
            "watched" => true
        ], [
            'Authorization' => "Bearer $token",
        ]);

        $response->assertStatus(200);
    }
}
