<?php

namespace App\Api\v1\Requests;

use App\Services\Contracts\LoginContract;

class LoginRequest extends BaseRequest implements LoginContract {
    const TEAM_ID = 'team_id';
    const EMAIL = 'email';
    const PASSWORD = 'password';

    public function rules() {
        return [
            self::TEAM_ID => 'required',
            self::EMAIL => 'required|email',
            self::PASSWORD => 'required'
        ];
    }

    public function getTeamId() {
        return $this->get(self::TEAM_ID);
    }

    public function getEmail() {
        return $this->get(self::EMAIL);
    }

    public function getPassword() {
        return $this->get(self::PASSWORD);
    }
}