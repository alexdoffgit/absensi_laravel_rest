<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
// use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Repository\Kehadiran;
use App\Repository\TimeHelper;
use Illuminate\Support\Facades\DB;

class HRPresenceTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function test_check_if_presence_table_is_filled()
    {
        // arrange
        $kehadiran = new Kehadiran(new TimeHelper());
        // act
        $presenceData = $kehadiran->getAllEmployeePresence();
        // assert
        foreach ($presenceData as $data) {
            $this->assertArrayHasKey('id', $data);
            $this->assertArrayHasKey('work_date', $data);
            $this->assertArrayHasKey('checkin', $data);
            $this->assertArrayHasKey('checkout', $data);
            $this->assertArrayHasKey('istirahat_start', $data);
            $this->assertArrayHasKey('istirahat_end', $data);
            $this->assertArrayHasKey('istirahat_end', $data);
            $this->assertArrayHasKey('checkin_schedule', $data);
            $this->assertArrayHasKey('checkout_schedule', $data);
            $this->assertArrayHasKey('istirahat_start_schedule', $data);
            $this->assertArrayHasKey('istirahat_end_schedule', $data);
            $this->assertArrayHasKey('user_id', $data);
        }
    }

    // public function tearDown(): void
    // {
    //     DB::table('presensi')->truncate();
    //     parent::tearDown();
    // }
}
