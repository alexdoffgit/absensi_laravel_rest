<?php

namespace App\Repository;

use App\Interfaces\Authentication as IAuth;
use Illuminate\Support\Facades\DB;

class Authentication implements IAuth
{
    public function verifyUser($username, $textPassword)
    {
        $userinfoTable = DB::table('userinfo')
            ->select('USERID')
            ->where('Name', '=', $username)
            ->where('PASSWORD', '=', $textPassword)
            ->first();

        return empty($userinfoTable) ? null:  $userinfoTable->USERID;
    }
}
