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

    public function update_persetujuan_izin()
    {
        $url = '/api/40/atasan/daftar-izin/accept-reject/1';
        $formData = [
            'accrej' => 2
        ];
        $response = $this->put($url, $formData);

        $response->assertStatus(200);
    }

    public function accept_form_data_and_return_the_data_without_file_input()
    {
        $url = '/api/adi/pengajuan-izin';
        $formData = [
            'tanggal_pengajuan' => '2024-01-04',
            'tanggal_mulai' => '2024-01-06',
            'tanggal_selesai' => '2024-01-06',
            'atasan_id' => 20,
            'tipe_izin' => 4,
            'alasan' => 'ngantar anak pulang'
        ];
        
        $response = $this->post($url, $formData);

        $response->assertStatus(200);
        $response->assertJson($formData);
    }
}
