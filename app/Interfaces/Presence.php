<?php

namespace App\Interfaces;

use App\Options\PresenceOption;

interface Presence
{
    public function getEmployeePresences(PresenceOption $option);
}
