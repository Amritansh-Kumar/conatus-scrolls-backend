<?php

namespace App\Api\v1\Requests;

use App\Services\Contracts\UpdateUserContract;

class UpdateUserRequest extends BaseRequest implements UpdateUserContract {

    const HOSTEL_ACCOMODATION = 'hostel_accomodation';
    const MOB_NO              = 'mob_no';

    public function rules() {
        return [
            self::MOB_NO              => 'string',
            self::HOSTEL_ACCOMODATION => 'boolean',
        ];
    }


    public function hasHostelAccomodation() {
        return $this->has(self::HOSTEL_ACCOMODATION);
    }


    public function getHostelAccomodation() {
        return $this->get(self::HOSTEL_ACCOMODATION);
    }

    public function getMobNo() {
        return $this->get(self::MOB_NO);
    }

    public function hasMobNo() {
        return $this->has(self::MOB_NO);
    }
}
