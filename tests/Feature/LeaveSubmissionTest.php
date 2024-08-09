<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Database\Seeders\UserManagerSeeder;
use Database\Seeders\UserSeeder;

class LeaveSubmissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_leave_request_without_file(): void
    {
        $this->withoutExceptionHandling();
        $this->seed([
            UserSeeder::class,
            UserManagerSeeder::class
        ]);
        $user = User::where('fullname', '=', 'SUHARJO')->first();

        $this->actingAs($user);

        $formData = [
            'request_date' => '2024-08-05',
            'daterange' => '2024-08-08 - 2024-08-08',
            'manager_id' => 10,
            'leave_id' => 4,
            'reason' => 'ngantar anak pulang'
        ];
        
        $response = $this->post('/leave-submission', $formData);

        $response->assertRedirect('/leave-submission');
    }
}
