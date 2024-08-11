<?php

namespace Tests\Feature;

use App\Exceptions\InvalidPasswordException;
use App\Repository\Employee;
use Database\Seeders\DepartmentSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
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

    public function test_create_new_employee_backend(): void
    {
        $formData = [
            'badgenumber' => '28019800',
            'ssn' => '28019800',
            'fullname' => 'ARYA SETYA',
            'text_password' => '28019800',
            'department_id' => 80,
        ];

        $repository = new Employee();

        $user = $repository->insertEmployee($formData);

        $this->assertEquals($formData['badgenumber'], $user->Badgenumber);
        $this->assertEquals($formData['ssn'], $user->SSN);
        $this->assertEquals($formData['fullname'], $user->fullname);
        $this->assertTrue(Hash::check($formData['text_password'], $user->password));
        $this->assertEquals($formData['department_id'], $user->DEFAULTDEPTID);
    }

    public function test_update_existing_employee_name_backend(): void
    {
        $employeeData = [
            'id' => 10,
            'badgenumber' => null,
            'ssn' => null,
            'fullname' => 'ARYA SETYA',
            'text_password' => null,
            'department_id' => null,
        ];

        $repository = new Employee();

        $user = $repository->updateEmployee($employeeData);

        $this->assertEquals($employeeData['fullname'], $user->fullname);
    }

    public function test_throw_exception_if_password_is_invalid_backend(): void
    {
        $employeeData = [
            'id' => 10,
            'badgenumber' => null,
            'ssn' => null,
            'fullname' => null,
            'text_password' => '000937',
            'department_id' => null,
        ];

        $repository = new Employee();

        $this->expectException(InvalidPasswordException::class);
        
        $user = $repository->updateEmployee($employeeData);
    }

    public function test_delete_employee_based_on_id_backend(): void
    {
        $employeeId = 10;

        $repository = new Employee();

        $repository->deleteEmployee($employeeId);

        $this->assertDatabaseMissing('userinfo', ['USERID' => $employeeId]);
    }
}
