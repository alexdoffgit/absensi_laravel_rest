<?php

namespace Tests\Feature;

use App\Repository\Kehadiran;
use App\Repository\TimeHelper;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EmployeeAttendanceTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_get_employee_attendance_by_id_and_time_range_in_data(): void
    {
        // arrange
        $uid = 3;
        $timeRange = [
            'start' => \DateTimeImmutable::createFromFormat('Y-m-d', '2022-09-01'),
            'end' => \DateTimeImmutable::createFromFormat('Y-m-d', '2022-09-30')
        ];
        $attendance = new Kehadiran(new TimeHelper());
        // act
        $attendanceMultiple = $attendance->getEmployeeAttendanceByIdAndTimeRange($uid, $timeRange);
        // assert
        $this->assertIsArray($attendanceMultiple);
        foreach ($attendanceMultiple as $value) {
            $this->assertArrayHasKey('start', $value);
            $this->assertArrayHasKey('end', $value);
            $this->assertArrayHasKey('color', $value);
            $this->assertArrayHasKey('display', $value);
        }
    }
}
