<?php

namespace Tests\Feature;

use App\Repository\Employee;
use Database\Seeders\DepartmentSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HREmployeeManagementTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed([
            DepartmentSeeder::class,
            UserSeeder::class,
        ]);
    }

    public function test_get_employees_data(): void
    {
        $expectedExistingKeys = [
            'user_id',
            'badgenumber',
            'fullname',
            'ssn',
            'department_name'
        ];

        $repository = new Employee();

        $result = $repository->findAllForHR();

        $this->assertIsArray($result);

        foreach ($result as $item) {
            $this->assertIsArray($item);
            foreach ($expectedExistingKeys as $key) {
                $this->assertArrayHasKey($key, $item);
            }
        }
    }
}
