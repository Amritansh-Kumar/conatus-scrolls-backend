<?php

namespace App\Api\v1\Transformers\Traits;

use App\Team;
use App\User;

trait UserDetailTrait {
    public function getAttributes(User $user) {
        return [
          'first_name' => $user->first_name,
          'last_name' => $user->last_name,
          'mob_no' => $user->mob_no,
          'college' => $user->college,
          'domain_id' => $this->fetchDomainId($user),
          'hostel_accomodation' => (bool)$user->hostel_accomodation,
          'status'          => $user->status,
          'email' => $user->email,
          'team_id' => $user->team_id,
          'scrolls_id' => $user->scrolls_id,
        ];
    }

    public function fetchDomainId($user) {
        return Team::find($user->team_id)->domain_id;
    }
}
