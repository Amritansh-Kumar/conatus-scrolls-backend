<?php

namespace App\Api\v1\Transformers\Traits;

use App\Member;

trait MemberDetailTrait {
    public function getAttributes(Member $member) {
        return [
            'email'   => $member->email,
            'team_id' => $member->team_id,
        ];
    }
}
