<?php

namespace App\Database\Query\Grammars;

use Illuminate\Database\Query;

class MariaDBGrammar extends Query\Grammars\MariaDbGrammar {
    public function getDateFormat()
    {
        return 'Y-m-d H:i:s.u';
    }
}