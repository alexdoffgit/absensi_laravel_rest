<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Database\Seeders\UserSeeder;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(UserSeeder::class);
    }

    /**
     * A basic feature test example.
     */
    public function test_hr_can_login(): void
    {
        $response = $this->post('/login', [
            'username' => 'BACHROAN', 
            'passwd' => '0000420'
        ]);

        $response->assertRedirect('/attendance/analysis');
    }

    public function test_redirect_if_data_invalid()
    {
        $response = $this->post('/login', [
            'username' => 'Nulu',
            'passwd' => 'huh'
        ]);

        $response->assertRedirect('/');
    }
}
