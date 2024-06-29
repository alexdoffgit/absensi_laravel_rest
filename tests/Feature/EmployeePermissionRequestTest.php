<?php

namespace Tests\Feature;

use App\Repository\PengajuanIzin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class EmployeePermissionRequestTest extends TestCase
{
    public function test_can_submit_permission()
    {
        // arrange
        $requestData = [
            'alasan' => null,
            'tipe_izin' => 8,
            'tanggal_pengajuan' => \DateTime::createFromFormat('Y-m-d', '2024-06-29'),
            'tanggal_mulai' => \DateTime::createFromFormat('Y-m-d', '2024-07-01'),
            'tanggal_selesai' => \DateTime::createFromFormat('Y-m-d', '2024-07-01'),
            'atasan_id' => 2288,
            'dokumen_pendukung' => UploadedFile::fake()->create('izinku.pdf', 5120, 'pdf') 
        ];
        $p = new PengajuanIzin();
        // act
        $p->create(2283, $requestData);
        // assert
        $this->expectNotToPerformAssertions();
    }

    
}
