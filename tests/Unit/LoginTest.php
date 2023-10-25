<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
class LoginTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_user_can_login()
    {
        $user = User::factory()->create();

        $response = $this->post('/api/login', [
            'email' => $user->email,
            'password' => Hash::make(rand(111111,999999)),
        ]);

        $response->assertRedirect('/');
        $this->assertAuthenticatedAs($user);
    }

}
