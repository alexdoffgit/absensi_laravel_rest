<?php

namespace App\Repository\Database;

use App\Interfaces\Authentication as IAuth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Authentication implements IAuth
{
    /**
     * @param string $fullname
     * @param string $textPassword
     * @return bool
     */
    public function verifyUser($fullname, $textPassword)
    {
        $userinfoTable = DB::table('userinfo')
            ->select(['password'])
            ->where('fullname', '=', $fullname)
            ->first();

        if (!empty($userinfoTable)) {
            if(Hash::check($textPassword, $userinfoTable->password)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    public function register($username, $textPassword)
    {
        $password = Hash::make($textPassword);
        $id = DB::table('userinfo')->insertGetId(['Name' => $username, 'PASSWORD' => $password]);
        return $id;
    }
}
