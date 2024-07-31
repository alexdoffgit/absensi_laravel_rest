<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SchclassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $schclassSQLFileInfo = database_path('seeders/schclass.sql');
        DB::unprepared(file_get_contents($schclassSQLFileInfo));
        $this->command->info('schclass seeded');
    }
}
