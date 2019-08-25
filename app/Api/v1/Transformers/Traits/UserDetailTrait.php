<?php

namespace App\Api\v1\Transformers\Traits;

use App\Team;
use App\User;

trait UserDetailTrait {
    public function getAttributes(User $user) {
        $team = $user->team;

        return [
            'first_name'          => $user->first_name,
            'last_name'           => $user->last_name,
            'email'               => $user->email,
            'team_id'             => $user->team_id,
            'college'             => $user->college,
            'domain_id'           => $team->domain_id,
            'topic_id'            => $team->topic_id,
            'team_name'           => $team->team_name,
            'hostel_accomodation' => (bool)$user->hostel_accomodation,
            'status'              => $user->status,
            'scrolls_id'          => $user->scrolls_id,
        ];
    }
}
