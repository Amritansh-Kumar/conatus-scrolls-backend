<?php

namespace App;

use Illuminate\Support\Str;

class Helpers {

    public static function generatePassword($length = 6) {
        return 'a' . Str::lower(Str::random($length));
    }

    public static function generateTeamId($domain, $val = 0) {
        $val++;
        return 'SCROLLS' . $domain . $val;
    }
}