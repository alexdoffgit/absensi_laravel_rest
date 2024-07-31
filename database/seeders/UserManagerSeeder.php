<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = $this->createUserManagerData();

        DB::table('user_managers')->insert($data);
    }

    private function createUserManagerData()
    {
        $data = [
            [
                'user_id' => 9,
                'head_manager_id' => 10,
            ],
            [
                'user_id' => 10,
                'head_manager_id' => 7
            ],
        ];

        return $data;
    }
}
