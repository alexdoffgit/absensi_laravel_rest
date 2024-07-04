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

        return empty($userinfoTable) ? null :  $userinfoTable->USERID;
    }

    // TODO: not use plain text to store password
    // TODO: rehash the password in db
    public function register($username, $textPassword)
    {
        $id = DB::table('userinfo')->insertGetId(['Name' => $username, 'PASSWORD' => $textPassword]);
        return $id;
    }
}
