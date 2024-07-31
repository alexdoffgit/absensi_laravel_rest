<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeptSeqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $deptseqSQLFilePath = database_path('seeders/deptseq.sql');
        DB::unprepared(file_get_contents($deptseqSQLFilePath));
        $this->command->info('deptseq seeded');
    }
}
