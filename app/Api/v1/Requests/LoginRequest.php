<?php

namespace App\Api\v1\Requests;

use App\Services\Contracts\LoginContract;

class LoginRequest extends BaseRequest implements LoginContract {
    const SCROLLS_ID = 'scrolls_id';
    const EMAIL      = 'email';
    const PASSWORD   = 'password';

    public function rules() {
        return [
            self::SCROLLS_ID => 'required',
            self::EMAIL      => 'required|email',
            self::PASSWORD   => 'required'
        ];
    }

    public function getScrollsId() {
        return $this->get(self::SCROLLS_ID);
    }

    public function getEmail() {
        return $this->get(self::EMAIL);
    }

    public function getPassword() {
        return $this->get(self::PASSWORD);
    }
}
