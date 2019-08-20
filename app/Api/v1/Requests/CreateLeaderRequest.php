<?php

namespace App\Api\v1\Requests;

use App\Services\Contracts\CreateLeaderContract;

class CreateLeaderRequest extends BaseRequest implements CreateLeaderContract {

    const FIRST_NAME = 'first_name';
    const LAST_NAME = 'last_name';
    const MOB_NO = 'mob_no';
    const COLLEGE = 'college';
    const HOSTEL_ACCOMODATION = 'hostel_accomodation';
    const EMAIL = 'email';
    const PASSWORD = 'password';
    const TEAM_NAME = 'team_name';
    const DOMAIN_ID = 'domain_id';
//    const TOPIC_ID = 'topic_id';
    const MEMBER1_NAME = 'member1_name';
    const MEMBER2_NAME = 'member2_name';
    const MEMBER1_EMAIL = 'member1_email';
    const MEMBER2_EMAIL = 'member2_email';

    public function rules() {
        return [
            self::FIRST_NAME => 'required|string',
            self::LAST_NAME => 'required|string',
            self::MOB_NO => 'required',
            self::COLLEGE => 'required|string',
            self::HOSTEL_ACCOMODATION => 'required|boolean',
            self::EMAIL => 'required|email',
            self::PASSWORD => 'required|min:11',
            self::TEAM_NAME => 'required|string',
            self::DOMAIN_ID => 'required|exists:domains,id',
//            self::TOPIC_ID => 'required|exists:topics,id',
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

    public function getTeamName() {
        return $this->get(self::TEAM_NAME);
    }

    public function getDomainId() {
        return $this->get(self::DOMAIN_ID);
    }

//    public function getTopicId() {
//        return $this->get(self::TOPIC_ID);
//    }

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
