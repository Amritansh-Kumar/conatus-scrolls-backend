<?php

namespace App\Api\v1\Requests;

use App\Services\Contracts\CreateMemberContract;

class CreateMemberRequest extends BaseRequest implements CreateMemberContract {

    const FIRST_NAME = 'first_name';
    const LAST_NAME = 'last_name';
    const MOB_NO = 'mob_no';
    const COLLEGE = 'college';
    const HOSTEL_ACCOMODATION = 'hostel_accomodation';
    const EMAIL = 'email';
    const PASSWORD = 'password';
    const TEAM_ID = 'team_id';

    public function rules() {
        return [
            self::FIRST_NAME => 'required|string',
            self::LAST_NAME => 'required|string',
            self::MOB_NO => 'required',
            self::COLLEGE => 'required|string',
            self::HOSTEL_ACCOMODATION => 'required|boolean',
            self::EMAIL => 'required|email',
            self::PASSWORD => 'required|min:11',
            self::TEAM_ID => 'required'
        ];
    }

    public function getFirstName() {
        return $this->get(self::FIRST_NAME);
    }

    public function getLastName() {
        return $this->get(self::LAST_NAME);
    }

    public function getMobNo() {
        return $this->get(self::MOB_NO);
    }

    public function getCollege() {
        return $this->get(self::COLLEGE);
    }

    public function getHostelAccomodation() {
        return $this->get(self::HOSTEL_ACCOMODATION);
    }

    public function getEmail() {
        return $this->get(self::EMAIL);
    }

    public function getPassword() {
        return $this->get(self::PASSWORD);
    }

    public function getTeamId() {
        return $this->get(self::TEAM_ID);
    }
}