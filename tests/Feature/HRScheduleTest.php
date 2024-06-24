<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Repository\Schedule;
use Illuminate\Support\Facades\DB;

class HRScheduleTest extends TestCase
{
    public function list_summary_contain_correct_column_name()
    {
        // arrange
            $r = new Schedule();
        // act
            $tableLike = $r->listSummary();
        // assert
            foreach ($tableLike as $key => $row) {
                $this->assertArrayHasKey('id', $row);
                $this->assertArrayHasKey('schedule_name', $row);
                $this->assertArrayHasKey('time_start', $row);
                $this->assertArrayHasKey('time_end', $row);
            }
    }

    public function repo_can_insert_new_data()
    {
        // arrange
            $newData = [
                'schedule_name' => 'FM13_01',
                'time_start' => '09:00',
                'time_end' => '14:00'
            ];
            $r = new Schedule();
        // act
            $r->create($newData);
        // assert
            $insertedData = DB::table('schclass')
                ->where('SCHNAME', '=', $newData['schedule_name'])
                ->first();
            $this->assertNotNull($insertedData);
        // clean (most likely this shouldn't be here??)
            DB::table('schclass')
                ->where('SCHNAME', '=', $newData['schedule_name'])
                ->delete();
    }

    public function repo_can_delete_data_based_on_id()
    {
        // arrange
        // act
        // assert
    }
}
