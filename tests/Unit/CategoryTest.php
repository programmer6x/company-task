<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Str;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    private array $headers;

    public function __construct(string $name)
    {
        parent::__construct($name);

        $this->headers = [
            "Authorization" => "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwMDAvYXBpL2F1dGgvbG9naW4iLCJpYXQiOjE2OTgxMzQzMTgsImV4cCI6MTY5ODEzNzkxOCwibmJmIjoxNjk4MTM0MzE4LCJqdGkiOiJWSjNnUjdGTlZIWUw2aFhLIiwic3ViIjoiNjUiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.jMfwrp2B_3nNy-svwQbshU-WERIsoqfji5yUkKl88J0",
            "Accept" => "application/json",
            "User-Agent" => "PostmanRuntime/7.34.0",
            "Cache-Control" => "no-cache",
            "Postman-Token" => "55b60c58-47be-4caa-a66e-3533c6b7f7a8",
            "Accept-Encoding" => "gzip, deflate, br",
            "Connection" => "keep-alive",
            "Content-Length" => "0",
        ];
    }

    /**
     * A basic feature test example.
     */
    public function test_is_an_user_can_access_categories_table(): void
    {
        $user = User::find(1);
        $response = $this->actingAs($user)->get('/api/categories');
        $response->assertStatus(200);
    }

    public function test_is_categories_table_is_not_empty(): void
    {

        $response = $this->withHeaders($this->headers)->get('api/categories');

        $response->assertDontSee('empty');

        $response->assertStatus(200);
    }

    public function test_is_categories_table_is_empty()
    {
        $response = $this->withHeaders($this->headers)->get('api/categories');

        $response->assertSee('empty');

        $response->assertStatus(200);
    }

    public function test_is_an_user_will_be_redirected_after_registration()
    {
        $user = [
            'first_name' => Str::random(7),
            'last_name' => Str::random(7),
            'email' => 'shapoor@test.com',
            'password' => bcrypt(rand(111111, 999999))
        ];

        $this->withHeaders($this->headers)->post('/api/auth/register', $user)->assertRedirect('/api/categories');
    }

    public function test_is_an_unauthenticated_user_cannot_access_categories_table()
    {
        $response = $this->withHeaders($this->headers)->get('api/categories')->assertUnauthorized();
        $response->assertRedirect('api/auth/register');
    }


}
