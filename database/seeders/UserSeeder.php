<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = $this->createUsers();
        DB::table('userinfo')
            ->insert($users);
    }

    private function createUsers()
    {
        $users = [
            [
                'USERID' => 1,
                'fullname' => 'BACHROAN',
                'password' => Hash::make('0000420'),
                'DEFAULTDEPTID' => 54
            ],
            [
                'USERID' => 2,
                'fullname' => 'PRASETYANTO',
                'password' => Hash::make('9900027'),
                'DEFAULTDEPTID' => 156
            ],
            [
                'USERID' => 3,
                'fullname' => 'SUYONO',
                'password' => Hash::make('0000272'),
                'DEFAULTDEPTID' => 89
            ],
            [
                'USERID' => 4,
                'fullname' => 'DJOKO PRAMONO',
                'password' => Hash::make('0000080'),
                'DEFAULTDEPTID' => 98
            ],
            [
                'USERID' => 5,
                'fullname' => 'SUDARSONO',
                'password' => Hash::make('0000428'),
                'DEFAULTDEPTID' => 42
            ],
            [
                'USERID' => 6,
                'fullname' => 'SUBAGIO',
                'password' => Hash::make('0000339'),
                'DEFAULTDEPTID' => 80
            ],
            [
                'USERID' => 7,
                'fullname' => 'SUHARJA WANASURIA',
                'password' => Hash::make('9900041'),
                'DEFAULTDEPTID' => 40
            ],
            [
                'USERID' => 8,
                'fullname' => 'PUPUT LESTARI',
                'password' => Hash::make('0876712'),
                'DEFAULTDEPTID' => 159
            ],
            [
                'USERID' => 9,
                'fullname' => 'SUHARJO',
                'password' => Hash::make('0000204'),
                'DEFAULTDEPTID' => 45
            ],
            [
                'USERID' => 10,
                'fullname' => 'TAUFIK NURKALIH',
                'password' => Hash::make('0009376'),
                'DEFAULTDEPTID' => 44
            ]
        ];

        return $users;
    }
}
