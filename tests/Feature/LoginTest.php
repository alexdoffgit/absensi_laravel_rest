<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    // use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_hr_can_login(): void
    {
        $this->withoutExceptionHandling();
        $response = $this->post('/login', [
            'username' => 'BACHROAN', 
            'passwd' => '0000420'
        ]);

        $response->assertRedirect('/attendance/analysis');
    }
}
