<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
class RegisterTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_user_can_register()
    {
        $response = $this->post('/api/register', [
            'first_name' => 'seyyed',
            'last_name' => 'bagheri',
            'email' => 'seyyedbagheri@example.com',
            'password' => Hash::make(rand(111111,999999)),
        ]);

        $response->assertRedirect('/');
        $this->assertAuthenticated();
    }
}
