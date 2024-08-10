<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CheckinoutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $checkinoutSQLFilePath = database_path('seeders/checkinout.sql');
        DB::unprepared(file_get_contents($checkinoutSQLFilePath));
    }
}
