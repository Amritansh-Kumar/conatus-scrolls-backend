<?php

namespace App\Api\v1\Transformers;

use App\Api\v1\Transformers\Traits\MemberDetailTrait;
use App\Member;
use League\Fractal\TransformerAbstract;

class MemberTransformer extends TransformerAbstract {
    use MemberDetailTrait;

    public function transform(Member $member) {
        return $this->getAttributes($member);
    }
}