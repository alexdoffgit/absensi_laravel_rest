<?php

namespace App\Interfaces;

interface Authentication
{
    /**
     * @param string $fullname
     * @param string $textPassword
     * @return bool
     */
    public function verifyUser($fullname, $textPassword);


    public function register($fullname, $textPassword);
}
