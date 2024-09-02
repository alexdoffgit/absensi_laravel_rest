<?php

namespace Tests\Feature;

use App\Options\PresenceOption;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Repository\Database\Attendance;
use Mockery\MockInterface;

class EmployeePresenceTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_fetch_employee_presence_by_id_and_period(): void
    {
        // arrange
        $employeeId = 1;
        $period = [
            'start' => \DateTime::createFromFormat('Y-m-d', '2024-08-05'),
            'end' => \DateTime::createFromFormat('Y-m-d', '2024-08-07')
        ];
        $presenceOption = new PresenceOption($employeeId, $period);
        $presenceRepoMock = $this->setUpPresenceRepositoryMockForFetchingById($presenceOption);
        
        // act
        $presenceService = new PresenceService($presenceRepoMock);
        $presencesData = $presenceService->getEmployeePresences($presenceOption);

        // assert
        foreach ($presencesData as $pd) {
            $this->assertEquals($employeeId, $pd['id']);
        }
    }

    private function setUpPresenceRepositoryMockForFetchingById(PresenceOption $presenceOption)
    {
        return $this->mock(PresenceRepository::class, function(MockInterface $mock) use ($presenceOption) {
            $returnedData = [
                [
                    'id' => 1,
                    'user_id' => 1,
                    'work_date_start' => \DateTime::createFromFormat('Y-m-d', '2024-08-05'),
                    'work_date_end' => \DateTime::createFromFormat('Y-m-d', '2024-08-05'),
                    'checkin_schedule' => \DateTime::createFromFormat('Y-m-d H:i:s', '2024-08-05 06:45'),
                    'checkout_schedule' => \DateTime::createFromFormat('Y-m-d H:i:s', '2024-08-05 14:45'),
                    'checkin' => \DateTime::createFromFormat('Y-m-d H:i:s', '2024-08-05 06:31'),
                    'checkout' => \DateTime::createFromFormat('Y-m-d H:i:s', '2024-08-05 14:51'),
                    'break_start_schedule' => null,
                    'break_end_schedule' => null,
                    'break_start' => null,
                    'break_end' => null
                ],
                [
                    'id' => 2,
                    'user_id' => 1,
                    'work_date_start' => \DateTime::createFromFormat('Y-m-d', '2024-08-06'),
                    'work_date_end' => \DateTime::createFromFormat('Y-m-d', '2024-08-06'),
                    'checkin_schedule' => \DateTime::createFromFormat('Y-m-d H:i:s', '2024-08-06 06:45'),
                    'checkout_schedule' => \DateTime::createFromFormat('Y-m-d H:i:s', '2024-08-06 14:45'),
                    'checkin' => \DateTime::createFromFormat('Y-m-d H:i:s', '2024-08-06 06:22'),
                    'checkout' => \DateTime::createFromFormat('Y-m-d H:i:s', '2024-08-06 14:17'),
                    'break_start_schedule' => null,
                    'break_end_schedule' => null,
                    'break_start' => null,
                    'break_end' => null
                ],
                [
                    'id' => 3,
                    'user_id' => 1,
                    'work_date_start' => \DateTime::createFromFormat('Y-m-d', '2024-08-07'),
                    'work_date_end' => \DateTime::createFromFormat('Y-m-d', '2024-08-07'),
                    'checkin_schedule' => \DateTime::createFromFormat('Y-m-d H:i:s', '2024-08-07 06:45'),
                    'checkout_schedule' => \DateTime::createFromFormat('Y-m-d H:i:s', '2024-08-07 14:45'),
                    'checkin' => \DateTime::createFromFormat('Y-m-d H:i:s', '2024-08-07 06:30'),
                    'checkout' => \DateTime::createFromFormat('Y-m-d H:i:s', '2024-08-07 15:00'),
                    'break_start_schedule' => null,
                    'break_end_schedule' => null,
                    'break_start' => null,
                    'break_end' => null
                ]
            ];

            $mock
                ->shouldReceive('getEmployeePresences')
                ->once()
                ->with($presenceOption)
                ->andReturn($returnedData);
        });
    }

    // public function test_fetch_employee_presence_within_correct_time_period()
    // {
        
    // }
}
