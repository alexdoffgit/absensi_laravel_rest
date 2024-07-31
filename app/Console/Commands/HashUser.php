<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class HashUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:hash-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $fullname = 'SUHARJO';
        $userinfo = DB::table('userinfo')
            ->where('fullname', '=', $fullname)
            ->first();
        if (Hash::needsRehash($userinfo->password)) {
            DB::table('userinfo')
                ->where('fullname', '=', $fullname)
                ->update(['password' => Hash::make($userinfo->password)]);

            $this->info("Password rehashed for user: {$userinfo->fullname}");
        } else {
            $this->info('nothing to do, moving on...');
        }

        return 0;
    }
}
