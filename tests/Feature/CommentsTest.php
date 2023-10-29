<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class CommentsTest extends TestCase
{
    //  test comment API

    public function test_user_can_create_comment(): void
    {
        $user = User::factory()->create();

        // login user and get token
        $token = $this->post('/api/login', [
            'email' => $user->email,
            'password' => 'password',
        ])->json('token');

        // create comment with POST
        $response = $this->post('/api/comment', [
            'body' => 'This is a comment'
        ], [
            'Authorization' => "Bearer $token",
        ]);

        $response->assertStatus(200);
    }
}
