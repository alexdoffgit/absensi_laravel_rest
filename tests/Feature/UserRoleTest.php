<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Repository\Employee;
use Database\Seeders\DepartmentSeeder;
use Database\Seeders\DeptSeqSeeder;
use Database\Seeders\UserSeeder;

class UserRoleTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        $this->seed([
            UserSeeder::class,
            DepartmentSeeder::class,
            DeptSeqSeeder::class
        ]);
    }

    /**
     * A basic feature test example.
     */
    public function test_return_the_correct_roles(): void
    {
        // arrange
        $userHR = 3;
        $usersManager = [54, 215, 117];
        $userStaff = 971;
        // act
        $k = new Employee();
        $roleHR = $k->getRoles($userHR);
        $rolesManager = [];
        foreach ($usersManager as $value1) {
            $rolesManager[] = $k->getRoles($value1);
        }
        $roleStaff = $k->getRoles($userStaff);
        // assert
        $this->assertEquals('hr', $roleHR);
        foreach ($rolesManager as $value2) {
            $this->assertEquals('manager', $value2);
        }
        $this->assertEquals('staff', $roleStaff);
    }
}
