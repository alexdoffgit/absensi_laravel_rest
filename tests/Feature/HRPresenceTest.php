<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
// use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Repository\Employee;
use App\Repository\TimeHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Expr\Empty_;

class HRPresenceTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }


    public function check_if_presence_table_is_filled_based_on_department()
    {
        // arrange
        $deptId = 80;
        $options = ['time' => 'week', 'page' => 1];
        $kehadiran = new Employee(new TimeHelper());
        // act
        $presenceDataByDepartment = $kehadiran->getPresenceFiltered($deptId, $options);
        // assert
        foreach ($presenceDataByDepartment as $data) {
            // Log::info($data);
            $this->assertObjectHasProperty('id', $data);
            $this->assertObjectHasProperty('work_date_start', $data);
            $this->assertObjectHasProperty('work_date_end', $data);
            $this->assertObjectHasProperty('checkin', $data);
            $this->assertObjectHasProperty('checkout', $data);
            $this->assertObjectHasProperty('istirahat_start', $data);
            $this->assertObjectHasProperty('istirahat_end', $data);
            $this->assertObjectHasProperty('istirahat_end', $data);
            $this->assertObjectHasProperty('checkin_schedule', $data);
            $this->assertObjectHasProperty('checkout_schedule', $data);
            $this->assertObjectHasProperty('istirahat_start_schedule', $data);
            $this->assertObjectHasProperty('istirahat_end_schedule', $data);
            $this->assertObjectHasProperty('user_id', $data);
        }
    }

    public function check_employee_presence_per_day()
    {
        // arrange
        $date  = \DateTimeImmutable::createFromFormat('Y-m-d', '2021-09-20');
        $options = [
            'deptId' => 61
        ];
        $kehadiran = new Employee(new TimeHelper());
        // act
        $presensiTable = $kehadiran->getPresencePerDay($date, $options);
        // assert
        foreach ($presensiTable as $data) {
            $this->assertObjectHasProperty('id', $data);
            $this->assertObjectHasProperty('work_date_start', $data);
            $this->assertObjectHasProperty('work_date_end', $data);
            $this->assertObjectHasProperty('checkin', $data);
            $this->assertObjectHasProperty('checkout', $data);
            $this->assertObjectHasProperty('istirahat_start', $data);
            $this->assertObjectHasProperty('istirahat_end', $data);
            $this->assertObjectHasProperty('istirahat_end', $data);
            $this->assertObjectHasProperty('checkin_schedule', $data);
            $this->assertObjectHasProperty('checkout_schedule', $data);
            $this->assertObjectHasProperty('istirahat_start_schedule', $data);
            $this->assertObjectHasProperty('istirahat_end_schedule', $data);
            $this->assertObjectHasProperty('user_id', $data);
        }
    }

    public function should_display_the_structure_of_absence_summary_correctly()
    {
        // arrange
        $timeRange = [
            'start' => \DateTimeImmutable::createFromFormat('Y-m-d', '2021-09-01'),
            'end' => \DateTimeImmutable::createFromFormat('Y-m-d', '2021-09-30')
        ];
        $deptId = 80;
        $options = null;
        $kehadiran = new Employee(new TimeHelper());
        // act
        $summary = $kehadiran->getPresenceSummary($timeRange, $deptId, $options);
        // assert
        $this->assertIsArray($summary);
        $this->assertArrayHasKey('leave_total_count', $summary);
        $this->assertArrayHasKey('sick_total_count', $summary);
        // $this->assertArrayHasKey('total_jam_dinas_luar', $summary);
    }
}
