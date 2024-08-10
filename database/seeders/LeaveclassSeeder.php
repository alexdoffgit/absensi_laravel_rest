<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LeaveclassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $leaveclassSQLFilePath = database_path('seeders/leaveclass.sql');
        DB::unprepared(file_get_contents($leaveclassSQLFilePath));
    }
}
