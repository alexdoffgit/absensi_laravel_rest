<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $deptartmentSQLFilePath = database_path('seeders/departments.sql');
        DB::unprepared(file_get_contents($deptartmentSQLFilePath));
    }
}
