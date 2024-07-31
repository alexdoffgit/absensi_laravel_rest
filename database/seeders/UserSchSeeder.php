<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userSchSQLFilePath = database_path('seeders/user_sch.sql');
        DB::unprepared(file_get_contents($userSchSQLFilePath));
        $this->command->info('user sch seeded');
    }
}
