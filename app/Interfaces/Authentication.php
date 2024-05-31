<?php

namespace App\Interfaces;

interface Authentication
{
    public function verifyUser($username, $textPassword);
}
