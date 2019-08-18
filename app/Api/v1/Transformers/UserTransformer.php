<?php

namespace App\Api\v1\Transformers;

use App\Api\v1\Transformers\Traits\UserDetailTrait;
use App\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract {
    use UserDetailTrait;

    public function transform(User $user) {
        return $this->getAttributes($user);
    }
}