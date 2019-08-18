<?php

namespace App\Api\v1\Requests;

use App\Services\Contracts\UpdateUserContract;

class UpdateUserRequest extends BaseRequest implements UpdateUserContract {

    const HOSTEL_ACCOMODATION = 'hostel_accomodation';
    const DOMAIN_ID = 'domain_id';
    const TOPIC_ID = 'topic_id';

    public function hasHostelAccomodation() {
        return $this->has(self::HOSTEL_ACCOMODATION);
    }

    public function getHostelAccomodation() {
        return $this->get(self::HOSTEL_ACCOMODATION);
    }

    public function getDomainId() {
        return $this->get(self::DOMAIN_ID);
    }

    public function hasDomainId() {
        return $this->has(self::DOMAIN_ID);
    }

    public function getTopicId() {
        return $this->get(self::TOPIC_ID);
    }

    public function hasTopicId() {
        return $this->has(self::TOPIC_ID);
    }
}