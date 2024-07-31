<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Laravel\Sanctum\Sanctum;

class AuthControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    public function test_user_can_register_with_valid_credentials()
    {
        $response = $this->postJson('/api/register', [
            'name' => 'Ata',
            'email' => 'ata@gmail.com',
            'password' => '123456'
        ]);
        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Register Success',
            ]);
    }

    public function test_user_can_register_with_invalid_credentials()
    {
        $response = $this->postJson('/api/register', [
            'name' => 'Ata',
            'email' => 'ata@gmail.com',
            'password' => '123' //Password min 6
        ]);
        $response->assertStatus(401)
            ->assertJson([
                'success' => false,
                'message' => 'Register Failed',
            ]);
    }

    public function test_user_can_login_with_valid_credentials()
    {
        $response = $this->postJson('/api/login', [
            'email' => 'ata@gmail.com',
            'password' => '123456'
        ]);
        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Login Success',
            ]);
    }

    public function test_user_can_login_with_invalid_credentials()
    {
        $response = $this->postJson('/api/login', [
            'email' => 'ata@gmail.com',
            'password' => '123'
        ]);
        $response->assertStatus(401)
            ->assertJson([
                'success' => false,
                'message' => 'Login Failed',
            ]);
    }
}
