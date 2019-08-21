<?php

namespace App;

use Illuminate\Support\Str;

class Helpers {

    public static function generatePassword($length = 11) {
        return 'a' . Str::lower(Str::random($length));
    }

    public static function generateTeamId($domain_id, $val = 0) {
        $lastId = Team::whereDomainId($domain_id)
            ->latest()->first();

        if ($lastId){
            $val = $lastId->id + 1;
        }
        return 'SCROLLS' . $domain_id . $val;
    }
}
