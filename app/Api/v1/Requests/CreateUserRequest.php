<?php

namespace App\Api\v1\Requests;

use App\Services\Contracts\CreateUserContract;

class CreateUserRequest extends Request implements CreateUserContract {

    const NAME = 'name';
    const MOB_NO = 'mob_no';
    const COLLEGE = 'college';
    const STATUS = 'status';
    const HOSTEL_ACCOMODATION = 'hostel_accomodation';
    const EMAIL = 'email';
    const PASSWORD = 'password';
    const TEAM_NAME = 'team_name';
    const DOMAIN = 'domain';
    const TOPIC = 'topic';
    const MEMBER1_NAME = 'member1_name';
    const MEMBER2_NAME = 'member2_name';
    const MEMBER1_EMAIL = 'member1_email';
    const MEMBER2_EMAIL = 'member2_email';

    public function rules() {
        return [
            self::NAME => 'required',
            self::MOB_NO => 'required',
            self::COLLEGE => 'required',
            self::STATUS => 'required',
            self::HOSTEL_ACCOMODATION => 'required',
            self::EMAIL => 'required|email',
            self::PASSWORD => 'required|min:6',
            self::TEAM_NAME => 'required',
            self::DOMAIN => 'required',
            self::TOPIC => 'required',
        ];
    }

    public function getName() {
        return $this->get(self::NAME);
    }

    public function getMobNo() {
        return $this->get(self::MOB_NO);
    }

    public function getCollege() {
        return $this->get(self::COLLEGE);
    }

    public function getStatus() {
        return $this->get(self::STATUS);
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

    public function getTeamName() {
        return $this->get(self::TEAM_NAME);
    }

    public function getDomain() {
        return $this->get(self::DOMAIN);
    }

    public function getTopic() {
        return $this->get(self::TOPIC);
    }

    public function getMember1Name() {
        return $this->get(self::MEMBER1_NAME);
    }

    public function getMember2Name() {
        return $this->get(self::MEMBER2_NAME);
    }

    public function getMember1Email() {
        return $this->get(self::MEMBER1_EMAIL);
    }

    public function getMember2Email() {
        return $this->get(self::MEMBER2_EMAIL);
    }

    public function hasMember2Email() {
        return $this->has(self::MEMBER2_EMAIL);
    }

    public function hasMember2Name() {
        return $this->has(self::MEMBER2_NAME);
    }
}