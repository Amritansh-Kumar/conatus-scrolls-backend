<?php

namespace App\Api\v1\Requests;

use App\Services\Contracts\CreateMemberContract;

class CreateMemberRequest extends BaseRequest implements CreateMemberContract {

    const LAST_NAME           = 'last_name';
    const MOB_NO              = 'mob_no';
    const COLLEGE             = 'college';
    const HOSTEL_ACCOMODATION = 'hostel_accomodation';
    const PASSWORD            = 'password';

    public function rules() {
        return [
            self::LAST_NAME           => 'required|string',
            self::MOB_NO              => 'required',
            self::COLLEGE             => 'required|string',
            self::HOSTEL_ACCOMODATION => 'required|boolean',
            self::PASSWORD            => 'required|min:8',
        ];
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

    public function getPassword() {
        return $this->get(self::PASSWORD);
    }
}
