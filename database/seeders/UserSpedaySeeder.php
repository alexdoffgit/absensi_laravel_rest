<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSpedaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userSpedayFilePath = database_path('seeders/user_speday.sql');
        DB::unprepared(file_get_contents($userSpedayFilePath));
        $this->command->info('user speday seeded');
    }
}
