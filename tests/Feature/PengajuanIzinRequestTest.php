<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PengajuanIzinRequestTest extends TestCase
{
    public function it_accepts_form_data_without_file_input(): void
    {
        $url = '/api/PONIDI/pengajuan-izin';
        $formData = [
            'tanggal_pengajuan' => '2024-01-04',
            'tanggal_mulai' => '2024-01-06',
            'tanggal_selesai' => '2024-01-06',
            'atasan_id' => 40,
            'tipe_izin' => 4,
            'alasan' => 'ngantar anak pulang'
        ];
        
        $response = $this->post($url, $formData);

        $response->assertStatus(200);
    }

    public function test_it_update_persetujuan_izin()
    {
        $url = '/api/40/atasan/daftar-izin/accept-reject/1';
        $formData = [
            'accrej' => 2
        ];
        $response = $this->put($url, $formData);

        $response->assertStatus(200);
    }

    // public function test_it_accept_form_data_and_return_the_data_without_file_input()
    // {
    //     $url = '/api/adi/pengajuan-izin';
    //     $formData = [
    //         'tanggal_pengajuan' => '2024-01-04',
    //         'tanggal_mulai' => '2024-01-06',
    //         'tanggal_selesai' => '2024-01-06',
    //         'atasan_id' => 20,
    //         'tipe_izin' => 4,
    //         'alasan' => 'ngantar anak pulang'
    //     ];
        
    //     $response = $this->post($url, $formData);

    //     $response->assertStatus(200);
    //     $response->assertJson($formData);
    // }
}
