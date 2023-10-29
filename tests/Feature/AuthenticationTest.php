<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Support\Facades\Log;


class AuthenticationTest extends TestCase
{
    public function test_users_can_authenticate_with_valid_password(): void
    {
        $user = User::factory()->create();

        $response = $this->post('/api/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        // assert status code is 200 and token is returned and token is not empty
        $response->assertStatus(200) && $response->assertJsonStructure(['token']) && !empty($response->json('token'));
    }

    public function test_users_can_not_authenticate_with_invalid_password(): void
    {
        $user = User::factory()->create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }

    // test sending request without password receives validation error
    public function test_login_requires_password(): void
    {
        $user = User::factory()->create();

        $response = $this->post('/api/login', [
            'email' => $user->email,
        ]);

        $response->assertSessionHasErrors('password');
    }

    // test sending request without email receives validation error
    public function test_login_requires_email(): void
    {
        $user = User::factory()->create();

        $response = $this->post('/api/login', [
            'password' => 'password',
        ]);

        $response->assertSessionHasErrors('email');
    }
}
