<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Repository\Kehadiran;
use App\Repository\TimeHelper;

class HRAbsenceTest extends TestCase
{
    public function fetch_correct_data_from_absence_table(): void
    {
        $date = \DateTimeImmutable::createFromFormat('Y-m-d', '2024-01-16');
        $deptId = 80;
        $options = [
            'userId' => 60
        ];
        // arrange
        $k = new Kehadiran(new TimeHelper());
        // act
        $absenceTable = $k->getAbsencePerDay($date, $deptId, $options);
        // assert
        $this->assertIsArray($absenceTable);
        if(count($absenceTable) > 0) {
            foreach ($absenceTable as $data) {
                $this->assertObjectHasProperty('id', $data);
                $this->assertObjectHasProperty('user_id', $data);
                $this->assertObjectHasProperty('tanggal_pengajuan', $data);
                $this->assertObjectHasProperty('tanggal_mulai', $data);
                $this->assertObjectHasProperty('tanggal_selesai', $data);
                $this->assertObjectHasProperty('alasan', $data);
                $this->assertObjectHasProperty('dokumen_pendukung', $data);
                $this->assertObjectHasProperty('tipe_absen', $data);
            }
        }
    }
}
