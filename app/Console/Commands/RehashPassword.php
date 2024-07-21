<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RehashPassword extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:rehash-password';

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
        $users = User::whereNotNull('password')
            ->get();
        foreach ($users as $key => $user) {
            if (!Hash::needsRehash($user->password)) {
                continue;
            } else {
                $user->password = Hash::make($user->password);
                $user->save();
    
                $this->info("Password rehashed for user: {$user->fullname}");
            }

        }

        $this->info('All plain text passwords have been rehashed.');
        return 0;
    }
}
